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
        $this->term->addTerm($request->category_name, $request->category_slug, $request->category_description, $request->category_parent, $this->tax);
        return redirect()->route('GET_CATEGORY_ROUTE');
    }

    function getEditCategory($id)
    {
        $responses = array(
            'title' => 'Lỗi',
            'sub_title' => '',
            'description' => 'Bạn đang muốn sửa một thứ không tồn tại. Có thể nó đã bị xóa?'
        );
        $categoryData = $this->taxonomy->category()->where('term_id', $id)->first();
        if ($categoryData == null) {
            return view('admin.errors.admin-error', ['error_responses' => $responses]);
        } else {
            return view('admin.taxonomy.category.category-edit', ['categoryData' => $categoryData, 'categories' => $this->taxonomy->fetchCategoryTree(0, '', '', $this->tax)]);
        }
    }

    function updateCategory(Request $request, $id)
    {
        $this->term->updateTerm($request->category_name, $request->category_slug, $request->category_description, $request->category_parent, $this->tax, $id);
        return redirect()->route('GET_CATEGORY_EDIT_ROUTE', [$id])->with('update', 'Chuyên mục đã được cập nhật.');
    }

    function deleteCategory($id)
    {
        $this->term->deleteTerm($id);
        return redirect()->route('GET_CATEGORY_ROUTE')->with('update', 'Chuyên mục đã được cập nhật.');
    }
}
