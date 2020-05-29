<?php

namespace App\Http\Controllers;

use App\Course;
use App\Option;
use App\PermissionPost;
use App\Post;
use App\Taxonomy;
use App\Term;
use App\User;
use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
{
    private $post, $term, $option, $user, $permission_post, $course, $taxonomy;

    /**
     * ThemeController constructor.
     */
    public function __construct()
    {
        $this->post = new Post();
        $this->term = new Term();
        $this->option = new Option();
        $this->user = new User();
        $this->course = new  Course();
        $this->permission_post = new PermissionPost();
        $this->taxonomy = new Taxonomy();
    }

    public function getTitleWebsite($slug)
    {
        $titleWebsiteBySessionKey = session('getTitleWebsite');
        $post = $this->post->slug($slug)->first();
        $term = $this->term->slug($slug)->first();
        if ($slug === '' || $slug === '/') {
            $title = $this->option->getField('blogname') . ' - ' . $this->option->getField('blogdescription');
        } else if (!empty($post->post_name)) {
            $title = $post->post_title . ' - ' . $this->option->getField('blogname');
        } elseif (!empty($term->slug)) {
            $title = $term->name . ' - ' . $this->option->getField('blogname');
        } elseif (!empty($titleWebsiteBySessionKey)) {
            $title = $titleWebsiteBySessionKey . ' - ' . $this->option->getField('blogname');
        } elseif ($slug === 'reset-password') {
            $title = 'Mật khẩu mới';
        } elseif ($slug === 'gio-hang') {
            $title = 'Giỏ hàng';
        } elseif ($slug === 'tai-khoan') {
            $title = 'Tài khoản';
        } elseif ($slug === 'thanh-toan') {
            $title = 'Thanh toán';
        } elseif ($slug === 'khoa-hoc') {
            $title = 'Khoá học của tôi';
        } else {
            $title = 'Không tìm thấy trang - 404 Not Found';
        }
        return $title;
    }

    function index()
    {
        $listCourseCat = $this->taxonomy->name('course_cat')->get();
        $titleWebsite = $this->getTitleWebsite('/');
        return view('themes.parent-theme.index', ['titleWebsite' => $titleWebsite, 'listCourseCat' => $listCourseCat]);
    }

    function type($slug)
    {
        global $post, $term;
        $titleWebsite = $this->getTitleWebsite($slug);
        $post = $this->post->slug($slug)->first();
        $term = $this->term->slug($slug)->first();
        if ($post !== null && $post->post_status === 'publish') {
            $post_type = $post->post_type;
            $posts = array();
            if ($post_type === 'post') {
                $post_type = 'single';
            } else if ($post_type === 'course') {
                $post = $this->course->find($post->ID);
                $builder = [];
                if (isset($post->builder->meta_value)) {
                    $builder = json_decode($post->builder->meta_value, true);
                }

                return view('themes.parent-theme.' . $post_type, [
                    'post' => $post,

                    'builder' => $this->courseBuilder($builder),
                    'titleWebsite' => $titleWebsite]
                );
            }
            if($slug === 'khoa-hoc'){
                $posts = $this->post->type('course')->paginate(9);
            }

            return view('themes.parent-theme.' . $post_type, ['post' => $post,  'posts' => $posts, 'titleWebsite' => $titleWebsite]);
        } else if ($term !== null) {
            $posts = $term->taxonomy->posts()->paginate(9);
            return view('themes.parent-theme.archive', ['term' => $term, 'posts' => $posts, 'titleWebsite' => $titleWebsite]);
        } else {
            return response()->view('themes.parent-theme.404', ['titleWebsite' => $titleWebsite], 404);
        }
    }

    function courseBuilder($builderObj)
    {
        $sections = [];
        $lessons = [];
        foreach ($builderObj as $item) {
            if ($item['type'] === 'section_heading') {
                array_push($sections, $item);
            }
            if ($item['type'] === 'lesson') {
                array_push($lessons, $item);
            }
        }

        foreach ($sections as $i => $section) {
            $sections[$i]['lessons'] = [];
            foreach ($lessons as $x => $lesson) {
                if ($section['ID'] === $lesson['section']) {
                    $builder = $sections[$i]['lessons'];
                    array_push($builder, $lessons[$x]);
                    $sections[$i]['lessons'] = $builder;
                }
            }
        }
        return $sections;
    }
}
