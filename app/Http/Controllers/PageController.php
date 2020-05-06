<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    private $post_type, $page;

    /**
     * PageController constructor.
     */
    public function __construct()
    {
        $this->post_type = 'page';
        $this->page = new Page();
    }

    /**
     * @param null $status
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function index($status = null)
    {
        $pages = $this->page->latest()->get();
        $pages = array();
        if (!isset($status)) {
            $pages = $this->page->not_status('trash')->latest()->get();
        } else if ($status === 'publish') {
            $pages = $this->page->status('publish')->latest()->get();
        } else if ($status === 'draft') {
            $pages = $this->page->status('draft')->latest()->get();
        } else if ($status === 'pending') {
            $pages = $this->page->status('pending')->latest()->get();
        } else if ($status === 'trash') {
            $pages = $this->page->status('trash')->latest()->get();
        }
        return view('admin.page.page-all', ['pages' => $pages, 'count' => $this->page->count_post($this->post_type)]);
    }

    function getActionTrashPage($id)
    {
        $responses = array(
            'title' => 'Lỗi',
            'sub_title' => '',
            'description' => 'Bạn đang muốn sửa một thứ không tồn tại. Có thể nó đã bị xóa?'
        );
        $postData = $this->page->post_id($id)->first();
        if ($postData == null) {
            return view('admin.errors.admin-error', ['error_responses' => $responses]);
        } else {
            $this->page->post_id($id)->update(array(
                    'post_status' => 'trash'
                )
            );
            return redirect()->back();
        }
    }

    function getActionRestorePage($id)
    {
        $responses = array(
            'title' => 'Lỗi',
            'sub_title' => '',
            'description' => 'Bạn đang muốn sửa một thứ không tồn tại. Có thể nó đã bị xóa?'
        );
        $postData = $this->page->post_id($id)->first();
        if ($postData == null) {
            return view('admin.errors.admin-error', ['error_responses' => $responses]);
        } else {
            $this->page->post_id($id)->update(array(
                    'post_status' => 'draft'
                )
            );
            return redirect()->back();
        }
    }

    function getActionDeletePage($id)
    {
        $responses = array(
            'title' => 'Lỗi',
            'sub_title' => '',
            'description' => 'Bạn đang muốn sửa một thứ không tồn tại. Có thể nó đã bị xóa?'
        );
        $postData = $this->page->post_id($id)->first();
        if ($postData == null) {
            return view('admin.errors.admin-error', ['error_responses' => $responses]);
        } else {
            $this->page->post_id($id)->delete();
            return redirect()->back();
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function getPageEditor()
    {
        return view('admin.page.page-new', ['post_type' => $this->post_type]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function getEditPage($id)
    {
        $responses = array(
            'title' => 'Lỗi',
            'sub_title' => '',
            'description' => 'Bạn đang muốn sửa một thứ không tồn tại. Có thể nó đã bị xóa?'
        );
        $postData = $this->page->post_id($id)->first();
        if ($postData == null) {
            return view('admin.errors.admin-error', ['error_responses' => $responses]);
        } else {
            return view('admin.page.page-edit', ['postData' => $postData]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function createPage(Request $request)
    {
        $page = $this->page->create($this->page->postRequest($request));
        if (isset($request->thumbnail_id)) {
            $page->meta()->create($this->page->thumbnailRequest($request));
        }
        return redirect()->route('GET_EDIT_PAGE_ROUTE', $page)->with('create', 'Trang đã được tạo.');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    function updatePage(Request $request, $id)
    {
        $page = $this->page->find($id);
        $page->update($this->page->postRequest($request, $id));
        if ($page->thumbnail === null) {
            if (isset($request->thumbnail_id)) {
                $page->meta()->create($this->page->thumbnailRequest($request));
            }
        } else {
            if (isset($request->thumbnail_id)) {
                $page->meta()->update($this->page->thumbnailRequest($request));
            } else {
                $thumbnail = $page->meta()->find($page->thumbnail->meta_id);
                $thumbnail->delete();
            }
        }
        return redirect()->route('GET_EDIT_PAGE_ROUTE', [$id])->with('update', 'Trang đã được cập nhật.');
    }
}
