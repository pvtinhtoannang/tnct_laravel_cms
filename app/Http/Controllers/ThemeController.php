<?php

namespace App\Http\Controllers;

use App\Option;
use App\Post;
use App\Term;

class ThemeController extends Controller
{
    private $post, $term, $option;

    /**
     * ThemeController constructor.
     */
    public function __construct()
    {
        $this->post = new Post();
        $this->term = new Term();
        $this->option = new Option();
    }

    public function getTitleWebsite($slug)
    {

        $post = $this->post->slug($slug)->first();
        $term = $this->term->slug($slug)->first();
        if ($slug === '' || $slug === '/') {
            $title = $this->option->getField('blogname') . ' - ' . $this->option->getField('blogdescription');
        } else if (!empty($post->post_name)) {
            $title = $post->post_title . ' - ' . $this->option->getField('blogname');
        } elseif (!empty($term->slug)) {
            $title = $term->name . ' - ' . $this->option->getField('blogname');
        } else {
            $title = 'Không tìm thấy trang - 404 Not Found';
        }
        return $title;
    }

    function index()
    {
        $titleWebsite = $this->getTitleWebsite('/');
        return view('themes.parent-theme.index', ['titleWebsite' => $titleWebsite]);
    }

    function type($slug)
    {
        global $post;
        $titleWebsite = $this->getTitleWebsite($slug);
        $post = $this->post->slug($slug)->first();
        $term = $this->term->slug($slug)->first();
        if ($post !== null) {
            $post_type = $post->post_type;
            if ($post_type === 'post') {
                $post_type = 'single';
            }
            return view('themes.parent-theme.' . $post_type, ['post' => $post, 'titleWebsite' => $titleWebsite]);
        } else if ($term !== null) {
            return view('themes.parent-theme.archive', ['term' => $term, 'titleWebsite' => $titleWebsite]);
        } else {
            return response()->view('themes.parent-theme.404', ['titleWebsite' => $titleWebsite], 404); 
        }
    }
}
