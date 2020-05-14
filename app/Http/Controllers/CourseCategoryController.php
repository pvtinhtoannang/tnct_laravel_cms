<?php

namespace App\Http\Controllers;

use App\Taxonomy;
use App\Term;
use Illuminate\Http\Request;

class CourseCategoryController extends Controller
{
    private $term, $tax, $taxonomy;

    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        $this->tax = 'course_cat';
        $this->term = new Term();
        $this->taxonomy = new Taxonomy();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function getCourseCategory()
    {
        return view('admin.course.course-category.course-cat', ['categories' => $this->taxonomy->fetchCategoryTree(0, '', '', $this->tax)]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function addCourseCategory(Request $request)
    {
        $this->term->addTerm($request->category_name, $request->category_slug, $request->category_description, $request->category_parent, $this->tax);
        return redirect()->route('GET_COURSE_CATEGORY_ROUTE');
    }

}
