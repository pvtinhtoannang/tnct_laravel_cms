<?php

namespace App\Http\Controllers;

use App\Term;
use App\Taxonomy;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $term, $tax, $taxonomy;

    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        $this->tax = 'category';
        $this->term = new Term();
        $this->taxonomy = new Taxonomy();
    }

    /**
     * @param int $parent
     * @param string $spacing
     * @param string $user_tree_array
     * @return array|string
     */
    function fetchCategoryTree($parent = 0, $spacing = '', $user_tree_array = '')
    {
        $get_term = $this->taxonomy->parent_id($parent)->category()->get();
        if (!is_array($user_tree_array))
            $user_tree_array = array();
        if (!empty($get_term)) {
            foreach ($get_term as $term) {
                $user_tree_array[] = array(
                    "term_taxonomy_id" => $term->term_taxonomy_id,
                    "term_id" => $term->term_id,
                    "name" => $spacing . $term->term->name,
                    "slug" => $term->term->slug,
                    "description" => $term->description
                );
                $user_tree_array = $this->fetchCategoryTree($term->term_id, $spacing . '— ', $user_tree_array);
            }
        }
        return $user_tree_array;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function getCategory()
    {
        return view('admin.taxonomy.category.category', ['categories' => $this->fetchCategoryTree()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function addCategory(Request $request)
    {
        if ($request->category_name != null && $request->category_slug != null) {
            if ($this->term->slug($request->category_slug)->first() == null) {
                $termRequest = array(
                    'name' => $request->category_name,
                    'slug' => $request->category_slug,
                    'term_group' => 0
                );
                $term = $this->term->create($termRequest);
                if ($term) {
                    if ($request->category_description == null) {
                        $category_description = '';
                    } else {
                        $category_description = $request->category_description;
                    }
                    $taxonomyRequest = array(
                        'taxonomy' => $this->tax,
                        'description' => $category_description,
                        'parent' => $request->category_parent,
                        'count' => 0
                    );
                    $term->taxonomy()->create($taxonomyRequest);
                    return redirect()->route('GET_CATEGORY_ROUTE')->with('messages', 'success')->withInput();
                } else {
                    return redirect()->route('GET_CATEGORY_ROUTE')->with('messages', 'error')->withInput();
                }
            } else {
                return redirect()->route('GET_CATEGORY_ROUTE')->with('messages', 'error')->withInput();
            }
        } else {
            return redirect()->route('GET_CATEGORY_ROUTE')->with('messages', 'error')->withInput();
        }
    }
}
