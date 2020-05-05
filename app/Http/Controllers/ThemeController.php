<?php

namespace App\Http\Controllers;

use App\Post;
use App\Term;

class ThemeController extends Controller
{
    private $post, $term;

    /**
     * ThemeController constructor.
     */
    public function __construct()
    {
        $this->post = new Post();
        $this->term = new Term();
    }

    function index()
    {
        return view('themes.parent-theme.index');
    }

    function type($slug)
    {
        $post = $this->post->slug($slug)->first();
        $term = $this->term->slug($slug)->first();
        if ($post !== null) {
            $post_type = $post->post_type;
            if ($post_type === 'post') {
                $post_type = 'single';
            }
            return view('themes.parent-theme.' . $post_type, ['post' => $post]);
        } else if ($term !== null) {
            return view('themes.parent-theme.archive', ['term' => $term]);
        } else {
            return view('themes.parent-theme.404');
        }
    }
}
