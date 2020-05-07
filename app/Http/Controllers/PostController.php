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
        return view('admin.post.post-all', ['postData' => $posts, 'count' => $this->post->count_post($this->post_type)]);
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
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function createPost(Request $request)
    {
        $post = $this->post->create($this->post->postRequest($request));
        $post->taxonomies()->attach($this->post->taxonomyRequest($request));
        if (isset($request->thumbnail_id)) {
            $post->meta()->create($this->post->thumbnailRequest($request));
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
        $this->post->updatePost($id, $request);
        return redirect()->route('GET_EDIT_POST_ROUTE', [$id])->with('update', 'Bài viết đã được cập nhật.');
    }
}
