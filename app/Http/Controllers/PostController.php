<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    private $term, $post_type, $post, $user;

    /**
     * PostController constructor.
     */
    public function __construct()
    {
        $this->post_type = 'post';
        $this->term = new Term();
        $this->post = new Post();
        $this->user = new User();
    }

    /**
     * @param null $status
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function index($status = null)
    {
        $posts = array();
        if (!isset($status)) {
            $posts = $this->post->type($this->post_type)->not_status('trash')->latest()->get();
        } else if ($status === 'publish') {
            $posts = $this->post->type($this->post_type)->status('publish')->latest()->get();
        } else if ($status === 'draft') {
            $posts = $this->post->type($this->post_type)->status('draft')->latest()->get();
        } else if ($status === 'pending') {
            $posts = $this->post->type($this->post_type)->status('pending')->latest()->get();
        } else if ($status === 'trash') {
            $posts = $this->post->type($this->post_type)->status('trash')->latest()->get();
        }
        return view('admin.post.post-all', ['postData' => $posts, 'count' => $this->count_post()]);
    }

    /**
     * @return array
     */
    function count_post()
    {
        $all = $this->post->type($this->post_type)->not_status('trash')->latest()->get();
        $trash = $this->post->type($this->post_type)->status('trash')->latest()->get();
        $pending = $this->post->type($this->post_type)->status('pending')->latest()->get();
        $draft = $this->post->type($this->post_type)->status('draft')->latest()->get();
        $publish = $this->post->type($this->post_type)->status('publish')->latest()->get();
        return array(
            'all' => count($all),
            'publish' => count($publish),
            'draft' => count($draft),
            'pending' => count($pending),
            'trash' => count($trash)
        );
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function getPostEditor()
    {
        $this->user->authorizeRoles('add_post');
        return view('admin.post.post-new', ['post_type' => $this->post_type]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function getEditPost($id)
    {
        $responses = array(
            'title' => 'Lỗi',
            'sub_title' => '',
            'description' => 'Bạn đang muốn sửa một thứ không tồn tại. Có thể nó đã bị xóa?'
        );
        $postData = $this->post->post_id($id)->type($this->post_type)->first();
        if ($postData == null) {
            return view('admin.errors.admin-error', ['error_responses' => $responses]);
        } else {
            return view('admin.post.post-edit', ['postData' => $postData]);
        }
    }

    function getActionTrashPost($id)
    {
        $responses = array(
            'title' => 'Lỗi',
            'sub_title' => '',
            'description' => 'Bạn đang muốn sửa một thứ không tồn tại. Có thể nó đã bị xóa?'
        );
        $postData = $this->post->post_id($id)->type($this->post_type)->first();
        if ($postData == null) {
            return view('admin.errors.admin-error', ['error_responses' => $responses]);
        } else {
            $this->post->post_id($id)->update(array(
                    'post_status' => 'trash'
                )
            );
            return redirect()->back();
        }
    }

    function getActionRestorePost($id)
    {
        $responses = array(
            'title' => 'Lỗi',
            'sub_title' => '',
            'description' => 'Bạn đang muốn sửa một thứ không tồn tại. Có thể nó đã bị xóa?'
        );
        $postData = $this->post->post_id($id)->type($this->post_type)->first();
        if ($postData == null) {
            return view('admin.errors.admin-error', ['error_responses' => $responses]);
        } else {
            $this->post->post_id($id)->update(array(
                    'post_status' => 'draft'
                )
            );
            return redirect()->back();
        }
    }

    function getActionDeletePost($id)
    {
        $responses = array(
            'title' => 'Lỗi',
            'sub_title' => '',
            'description' => 'Bạn đang muốn sửa một thứ không tồn tại. Có thể nó đã bị xóa?'
        );
        $postData = $this->post->post_id($id)->type($this->post_type)->first();
        if ($postData == null) {
            return view('admin.errors.admin-error', ['error_responses' => $responses]);
        } else {
            $this->post->post_id($id)->delete();
            return redirect()->back();
        }
    }

    /**
     * @param $str
     * @return string|string[]|null
     */
    function toSlug($str)
    {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
    }

    /**
     * @param $request
     * @param string $id
     * @return array
     */
    function postRequest($request, $id = '')
    {
        $post_content = '';
        $excerpt = '';
        if (isset($request->post_content)) {
            $post_content = $request->post_content;
        }

        if (isset($request->excerpt)) {
            $excerpt = $request->excerpt;
        }
        $user_id = Auth::user()->id;
        if ($id !== '') {
            $post_name = $request->post_name;
        } else {
            $post_name = $this->post->slugGenerator($this->toSlug($request->post_title));
        }
        return array(
            'post_author' => $user_id,
            'post_content' => $post_content,
            'post_title' => $request->post_title,
            'post_excerpt' => $excerpt,
            'post_status' => $request->post_status,
            'post_name' => $post_name,
            'post_type' => $this->post_type
        );
    }

    /**
     * @param $request
     * @return array
     */
    function taxonomyRequest($request)
    {
        $tags = explode(',', $request->post_tag);
        $tagData = array();
        $catData = array();
        if (empty($request->post_category)) {
            $cats = array("1");
        } else {
            $cats = $request->post_category;
        }
        foreach ($tags as $key => $tag) {
            if ($tag !== '') {
                $tagCheck = $this->term->slug($this->toSlug($tag))->first();
                if ($tagCheck == null) {
                    $termRequest = array(
                        'name' => $tag,
                        'slug' => $this->toSlug($tag),
                        'term_group' => 0
                    );
                    $term = $this->term->create($termRequest);
                    if ($term) {
                        $tagData[$key]['term_taxonomy_id'] = $term->term_id;
                        $taxonomyRequest = array(
                            'taxonomy' => 'post_tag',
                            'description' => '',
                            'parent' => 0,
                            'count' => 0
                        );
                        $term->taxonomy()->create($taxonomyRequest);
                    }
                } else {
                    $tagData[$key]['term_taxonomy_id'] = $tagCheck->term_id;
                }
            }
        }
        foreach ($cats as $key => $term_id) {
            $catData[$key]['term_taxonomy_id'] = $term_id;
        }
        return array_merge($catData, $tagData);
    }

    /**
     * @param $request
     * @return array
     */
    function thumbnailRequest($request)
    {
        return array(
            'meta_key' => 'thumbnail_id',
            'meta_value' => $request->thumbnail_id,
        );
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function createPost(Request $request)
    {
        $post = $this->post->create($this->postRequest($request));
        $post->taxonomies()->attach($this->taxonomyRequest($request));
        if (isset($request->thumbnail_id)) {
            $post->meta()->create($this->thumbnailRequest($request));
        }
        return redirect()->route('GET_EDIT_POST_ROUTE', [$post])->with('create', 'Bài viết đã được tạo.');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    function updatePost(Request $request, $id)
    {
        $post = $this->post->find($id);
        $post->update($this->postRequest($request, $id));
        $cats = array();
        foreach ($this->taxonomyRequest($request) as $term_id) {
            array_push($cats, $term_id['term_taxonomy_id']);
        }
        $post->taxonomies()->wherePivot('object_id', $id)->sync($cats);
        if ($post->thumbnail === null) {
            if (isset($request->thumbnail_id)) {
                $post->meta()->create($this->thumbnailRequest($request));
            }
        } else {
            if (isset($request->thumbnail_id)) {
                $post->meta()->update($this->thumbnailRequest($request));
            } else {
                $thumbnail = $post->meta()->find($post->thumbnail->meta_id);
                $thumbnail->delete();
            }
        }
        return redirect()->route('GET_EDIT_POST_ROUTE', [$id])->with('update', 'Bài viết đã được cập nhật.');
    }
}
