<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    private $post_type, $course, $post_controller;


    /**
     * CourseController constructor.
     */
    public function __construct()
    {
        $this->post_type = 'course';
        $this->course = new Course();
        $this->post_controller = new PostController();
    }

    /**
     * @param null $status
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function index($status = null)
    {
        $courses = array();
        if (!isset($status)) {
            $courses = $this->course->type($this->post_type)->not_status('trash')->latest()->get();
        } else if ($status === 'publish') {
            $courses = $this->course->type($this->post_type)->status('publish')->latest()->get();
        } else if ($status === 'draft') {
            $courses = $this->course->type($this->post_type)->status('draft')->latest()->get();
        } else if ($status === 'pending') {
            $courses = $this->course->type($this->post_type)->status('pending')->latest()->get();
        } else if ($status === 'trash') {
            $courses = $this->course->type($this->post_type)->status('trash')->latest()->get();
        }
        return view('admin.course.course.courses', ['postData' => $courses, 'count' => $this->course->count_post($this->post_type)]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function getCourseEditor()
    {
        return view('admin.course.course.course-editor', ['post_type' => $this->post_type]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function createCourse(Request $request)
    {
        $course = $this->course->create($this->course->postRequest($request));
        $course->taxonomies()->attach($this->course->taxonomyRequest($request));
        if (isset($request->thumbnail_id)) {
            $course->meta()->create($this->course->thumbnailRequest($request));
        }
        if (isset($request->course_price)) {
            $course->meta()->create($this->course->postMeta('course_price', $request->course_price));
        }
        return redirect()->route('GET_EDIT_COURSE_ROUTE', [$course])->with('create', 'Bài viết đã được tạo.');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function getEditCourse($id)
    {
        $responses = array(
            'title' => 'Lỗi',
            'sub_title' => '',
            'description' => 'Bạn đang muốn sửa một thứ không tồn tại. Có thể nó đã bị xóa?'
        );
        $postData = $this->course->post_id($id)->type($this->post_type)->first();
        if ($postData == null) {
            return view('admin.errors.admin-error', ['error_responses' => $responses]);
        } else {
            return view('admin.course.course.course-edit', ['postData' => $postData]);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    function updateCourse(Request $request, $id)
    {
        $this->course->updatePost($id, $request);
        return redirect()->route('POST_EDIT_COURSE_ROUTE', [$id])->with('update', 'Khoá học đã được cập nhật.');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    function getActionTrashCourse($id)
    {
        $responses = array(
            'title' => 'Lỗi',
            'sub_title' => '',
            'description' => 'Bạn đang muốn sửa một thứ không tồn tại. Có thể nó đã bị xóa?'
        );
        $postData = $this->course->post_id($id)->type($this->post_type)->first();
        if ($postData == null) {
            return view('admin.errors.admin-error', ['error_responses' => $responses]);
        } else {
            $this->course->post_id($id)->update(array(
                    'post_status' => 'trash'
                )
            );
            return redirect()->back();
        }
    }

    function getActionRestoreCourse($id)
    {
        $responses = array(
            'title' => 'Lỗi',
            'sub_title' => '',
            'description' => 'Bạn đang muốn sửa một thứ không tồn tại. Có thể nó đã bị xóa?'
        );
        $postData = $this->course->post_id($id)->type($this->post_type)->first();
        if ($postData == null) {
            return view('admin.errors.admin-error', ['error_responses' => $responses]);
        } else {
            $this->course->post_id($id)->update(array(
                    'post_status' => 'draft'
                )
            );
            return redirect()->back();
        }
    }

    function getActionDeleteCourse($id)
    {
        $responses = array(
            'title' => 'Lỗi',
            'sub_title' => '',
            'description' => 'Bạn đang muốn sửa một thứ không tồn tại. Có thể nó đã bị xóa?'
        );
        $postData = $this->course->post_id($id)->type($this->post_type)->first();
        if ($postData == null) {
            return view('admin.errors.admin-error', ['error_responses' => $responses]);
        } else {
            $this->course->post_id($id)->delete();
            return redirect()->back();
        }
    }
}
