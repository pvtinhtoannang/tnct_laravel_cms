<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Term;
use Illuminate\Http\Request;

class TagController extends Controller
{
    private $term, $tag, $tax;

    /**
     * TagController constructor.
     */
    public function __construct()
    {
        $this->tax = 'post_tag';
        $this->term = new Term();
        $this->tag = new Tag();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function getTag()
    {
        $tags = $this->tag->get();
        return view('admin.taxonomy.tag.tag', ['tags' => $tags]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function addTag(Request $request)
    {
        $this->term->addCategory($request->tag_name, $request->tag_slug, $request->tag_description, 0, $this->tax);
        return redirect()->route('GET_TAG_ROUTE');
    }
}
