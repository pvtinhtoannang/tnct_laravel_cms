<?php

namespace App\Http\Controllers;

use App\Attachment;
use App\Course;
use App\Lesson;
use App\SectionHeading;
use App\Post;
use App\Term;
use Illuminate\Http\Request;

class AdminAjaxController extends Controller
{
    private $term, $post, $attachment, $section_heading, $course, $lesson;

    /**
     * AdminAjaxController constructor.
     */
    public function __construct()
    {
        $this->term = new Term();
        $this->post = new Post();
        $this->section_heading = new SectionHeading();
        $this->attachment = new Attachment();
        $this->course = new Course();
        $this->lesson = new Lesson();
    }

    /**
     * @return int
     */
    public function index()
    {
        return 0;
    }

    /**
     * @param Request $request
     */
    function slugGenerator(Request $request)
    {
        echo json_encode($this->term->slugGenerator($request->slug));
        exit;
    }

    /**
     * @param Request $request
     */
    function postNameGenerator(Request $request)
    {
        echo json_encode($this->post->slugGenerator($request->post_name));
        exit;
    }

    function getAttachment()
    {
        echo json_encode($this->attachment->latest()->get());
        exit;
    }

    function createSectionHeading(Request $request)
    {
        $section_heading = $this->section_heading->create($this->post->postRequest((object)$request->post_data));
        $section_heading->meta()->create([
            'meta_key' => 'course_id',
            'meta_value' => $request->course
        ]);
        return $section_heading;
    }

    function updateSectionHeading(Request $request)
    {
        $section_heading = $this->section_heading->updateSectionHeading($request->id, (object)$request->post_data);
        return $section_heading;
    }

    function createLesson(Request $request)
    {
        $lesson = $this->lesson->create($this->post->postRequest((object)$request->post_data));
        $lesson->meta()->create([
            'meta_key' => 'course_id',
            'meta_value' => $request->course
        ]);
        return $lesson;
    }

    function updateLesson(Request $request)
    {
        $lesson = $this->lesson->updateLesson($request->id, (object)$request->post_data);
        return $lesson;
    }

    function saveCourseBuilder(Request $request)
    {
        $course = $this->course->find($request->course);
        $course_builder = $course->builder;
//        $course_builder_admin = $course->builder_admin;


        if ($course_builder) {
            $course_builder->update([
                'meta_key' => 'course_builder',
                'meta_value' => json_encode($request->position)
            ]);
        } else {
            $course->meta()->create([
                'meta_key' => 'course_builder',
                'meta_value' => json_encode($request->position)
            ]);
        }
//        if ($course_builder_admin) {
//            $course_builder_admin->update([
//                'meta_key' => 'course_builder_admin',
//                'meta_value' => json_encode($request->positionAdmin)
//            ]);
//
//        } else {
//            $course->meta()->create([
//                'meta_key' => 'course_builder_admin',
//                'meta_value' => json_encode($request->positionAdmin)
//            ]);
//        }
    }

    function deleteSectionHeading(Request $request)
    {
        $section_heading = $this->section_heading->find($request->id);
        $section_heading_meta = $section_heading->meta()->where('meta_key', 'course_id')->first();
        $section_heading_meta->delete();
        $section_heading->delete();
        return $section_heading;
    }

    function deleteLesson(Request $request)
    {
        $lesson = $this->lesson->find($request->id);
        $lesson_meta = $lesson->meta()->where('meta_key', 'course_id')->first();
        $lesson_meta->delete();
        $lesson->delete();
        return $lesson;
    }
}
