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
        if ($request->tag_name != null && $request->tag_slug != null) {
            if ($this->term->slug($request->tag_slug)->first() == null) {
                $termRequest = array(
                    'name' => $request->tag_name,
                    'slug' => $request->tag_slug,
                    'term_group' => 0
                );
                $term = $this->term->create($termRequest);
                if ($term) {
                    if ($request->tag_description == null) {
                        $tag_description = '';
                    } else {
                        $tag_description = $request->tag_description;
                    }
                    $taxonomyRequest = array(
                        'taxonomy' => $this->tax,
                        'description' => $tag_description,
                        'parent' => 0,
                        'count' => 0
                    );
                    $term->taxonomy()->create($taxonomyRequest);
                    return redirect()->route('GET_TAG_ROUTE')->with('messages', 'success');
                } else {
                    return redirect()->route('GET_TAG_ROUTE')->with('messages', 'error');
                }
            } else {
                return redirect()->route('GET_TAG_ROUTE')->with('messages', 'error');
            }
        } else {
            return redirect()->route('GET_TAG_ROUTE')->with('messages', 'error');
        }
    }
}
