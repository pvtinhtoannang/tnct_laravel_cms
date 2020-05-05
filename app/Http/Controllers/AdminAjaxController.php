<?php

namespace App\Http\Controllers;

use App\Attachment;
use App\Post;
use App\Term;
use Illuminate\Http\Request;

class AdminAjaxController extends Controller
{
    private $term, $post, $attachment;

    /**
     * AdminAjaxController constructor.
     */
    public function __construct()
    {
        $this->term = new Term();
        $this->post = new Post();
        $this->attachment = new Attachment();
    }

    /**
     * @return int
     */
    public function index()
    {
        return 0;
    }

    /**
     * @param Request $request
     */
    function slugGenerator(Request $request)
    {
        echo json_encode($this->term->slugGenerator($request->slug));
        exit;
    }

    /**
     * @param Request $request
     */
    function postNameGenerator(Request $request)
    {
        echo json_encode($this->post->slugGenerator($request->post_name));
        exit;
    }

    function getAttachment()
    {
        echo json_encode($this->attachment->latest()->get());
        exit;
    }
}
