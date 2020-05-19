<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    private $post_type, $lesson, $post_controller;

    /**
     * LessonController constructor.
     */
    public function __construct()
    {
        $this->post_type = 'lesson';
        $this->lesson = new Lesson();
        $this->post_controller = new PostController();
    }

    /**
     * @param null $status
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function index($status = null)
    {
        $lessons = array();
        if (!isset($status)) {
            $lessons = $this->lesson->type($this->post_type)->not_status('trash')->latest()->get();
        } else if ($status === 'publish') {
            $lessons = $this->lesson->type($this->post_type)->status('publish')->latest()->get();
        } else if ($status === 'draft') {
            $lessons = $this->lesson->type($this->post_type)->status('draft')->latest()->get();
        } else if ($status === 'pending') {
            $lessons = $this->lesson->type($this->post_type)->status('pending')->latest()->get();
        } else if ($status === 'trash') {
            $lessons = $this->lesson->type($this->post_type)->status('trash')->latest()->get();
        }
        return view('admin.lesson.lesson.lessons', ['postData' => $lessons, 'count' => $this->lesson->count_post($this->post_type)]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function getLessonEditor()
    {
        return view('admin.lesson.lesson.lesson-editor', ['post_type' => $this->post_type]);
    }


    function createLesson(Request $request)
    {
        $lesson = $this->lesson->create($this->lesson->postRequest($request));
        if (isset($request->course)) {
            $lesson->meta()->create([
                'meta_key' => 'course_id',
                'meta_value' => $request->course
            ]);
        }
        return redirect()->route('GET_EDIT_LESSON_ROUTE', [$lesson])->with('create', 'Bài học đã được tạo.');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function getEditLesson($id)
    {
        $responses = array(
            'title' => 'Lỗi',
            'sub_title' => '',
            'description' => 'Bạn đang muốn sửa một thứ không tồn tại. Có thể nó đã bị xóa?'
        );
        $postData = $this->lesson->post_id($id)->type($this->post_type)->first();
        if ($postData == null) {
            return view('admin.errors.admin-error', ['error_responses' => $responses]);
        } else {
            return view('admin.lesson.lesson.lesson-edit', ['postData' => $postData]);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    function updateLesson(Request $request, $id)
    {
        $this->lesson->updatePost($id, $request);
        return redirect()->route('GET_EDIT_LESSON_ROUTE', [$id])->with('update', 'Bài viết đã được cập nhật.');
    }

    /**
     * @param $status
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    function updateStatus($status, $id)
    {
        $responses = array(
            'title' => 'Lỗi',
            'sub_title' => '',
            'description' => 'Bạn đang muốn sửa một thứ không tồn tại. Có thể nó đã bị xóa?'
        );
        if ($status !== '') {
            if ($status === 'restore') {
                $status = 'draft';
            } else if ($status === 'trash') {
                $status = 'trash';
            } else if ($status === 'delete') {
                $this->lesson->post_id($id)->delete();
            } else {
                return view('admin.errors.admin-error', ['error_responses' => $responses]);
            }
            $this->lesson->updateStatus($id, $this->post_type, $status);
            return redirect()->back();
        } else {
            return view('admin.errors.admin-error', ['error_responses' => $responses]);
        }
    }
}