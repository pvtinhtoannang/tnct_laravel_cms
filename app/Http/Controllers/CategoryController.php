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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function getCategory()
    {
        return view('admin.taxonomy.category.category', ['categories' => $this->taxonomy->fetchCategoryTree(0, '', '', $this->tax)]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function addCategory(Request $request)
    {
        $this->term->addCategory($request->category_name, $request->category_slug, $request->category_description, $request->category_parent, $this->tax);
        return redirect()->route('GET_CATEGORY_ROUTE');
    }
}
