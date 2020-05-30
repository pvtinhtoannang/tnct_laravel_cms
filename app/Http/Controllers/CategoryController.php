<?php

namespace App\Http\Controllers;

use App\Post;
use App\Term;
use App\Taxonomy;
use App\TermRelationships;
use App\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $term, $tax, $taxonomy, $post, $user;

    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        $this->tax = 'category';
        $this->term = new Term();
        $this->taxonomy = new Taxonomy();
        $this->post = new Post();
        $this->user = new User();
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
        $this->user->authorizeRoles('add_category_post');
        $this->term->addTerm($request->category_name, $request->category_slug, $request->category_description, $request->category_parent, $this->tax);
        return redirect()->route('GET_CATEGORY_ROUTE');
    }

    function getEditCategory($id)
    {
        $this->user->authorizeRoles('edit_category_post');
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
        $this->user->authorizeRoles('edit_category_post');
        $this->term->updateTerm($request->category_name, $request->category_slug, $request->category_description, $request->category_parent, $this->tax, $id);
        return redirect()->route('GET_CATEGORY_EDIT_ROUTE', [$id])->with('update', 'Chuyên mục đã được cập nhật.');
    }

    function deleteCategory($id)
    {
        $responses = array(
            'title' => 'Lỗi',
            'sub_title' => '',
            'description' => 'Thao tác không hợp lệ.'
        );
        $this->user->authorizeRoles('delete_category_post');
        if ($this->taxonomy->deleteTermTaxonomyInObject($id)) {
            if ($this->term->deleteTerm($id)) {
                return redirect()->route('GET_CATEGORY_ROUTE')->with('update', 'Chuyên mục đã được cập nhật.');
            } else {
                return view('admin.errors.admin-error', ['error_responses' => $responses]);
            }
        } else {
            return view('admin.errors.admin-error', ['error_responses' => $responses]);
        }
    }
}
