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

    function getEditCourseCategory($id)
    {
        $responses = array(
            'title' => 'Lỗi',
            'sub_title' => '',
            'description' => 'Bạn đang muốn sửa một thứ không tồn tại. Có thể nó đã bị xóa?'
        );
        $categoryData = $this->taxonomy->name('course_cat')->where('term_id', $id)->first();
        if ($categoryData == null) {
            return view('admin.errors.admin-error', ['error_responses' => $responses]);
        } else {
            return view('admin.course.course-category.course-cat-edit', ['categoryData' => $categoryData, 'categories' => $this->taxonomy->fetchCategoryTree(0, '', '', $this->tax)]);
        }
    }

    function updateCourseCategory(Request $request, $id)
    {
        $this->term->updateTerm($request->category_name, $request->category_slug, $request->category_description, $request->category_parent, $this->tax, $id);
        return redirect()->route('GET_COURSE_CAT_EDIT_ROUTE', [$id])->with('update', 'Chuyên mục đã được cập nhật.');
    }

    function deleteCourseCategory($id)
    {
        $responses = array(
            'title' => 'Lỗi',
            'sub_title' => '',
            'description' => 'Thao tác không hợp lệ.'
        );
        if ($this->taxonomy->deleteTermTaxonomyInObject($id)) {
            if ($this->term->deleteTerm($id)) {
                return redirect()->route('GET_COURSE_CATEGORY_ROUTE')->with('update', 'Chuyên mục đã được cập nhật.');
            } else {
                return view('admin.errors.admin-error', ['error_responses' => $responses]);
            }
        } else {
            return view('admin.errors.admin-error', ['error_responses' => $responses]);
        }
    }

}
