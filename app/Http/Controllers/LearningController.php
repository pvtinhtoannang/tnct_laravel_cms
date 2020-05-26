<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Controllers\ThemeController;
use App\Lesson;
use App\PermissionPost;
use App\Post;
use App\SectionHeading;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LearningController extends Controller
{

    private $theme_controller, $course, $lesson, $section_heading, $builder, $post, $video_type, $user, $permission_post, $activity, $file_type;

    public function __construct()
    {
        $this->theme_controller = new ThemeController();
        $this->course = new Course();
        $this->lesson = new Lesson();
        $this->section_heading = new SectionHeading();
        $this->post = new Post();
        $this->builder = [];
        $this->video_type = 'unknown';
        $this->file_type = 'host';
        $this->user = new User();
        $this->activity = [];
        $this->permission_post = new PermissionPost();
    }

    function index($course, $lesson = null)
    {
        if ($this->course->slug($course)->first()) {

            $course_data = $this->course->slug($course)->first();
            if (isset($course_data->builder->meta_value)) {
                $this->builder = json_decode($course_data->builder->meta_value, true);
            }
            if ($this->user->checkPermissionForPost($course_data->ID) === 1) {
                $this->activity = $this->permission_post->getPermissionPostActivity(Auth::user()->id, $course_data->ID);
                if (isset($lesson)) {
                    if ($this->lesson->post_id($lesson)->first()) {
                        $lesson_data = $this->lesson->post_id($lesson)->first();
                        if (isset($lesson_data->course->meta_value) && $lesson_data->course->meta_value * 1 === $course_data->ID * 1) {
                            if ($lesson_data->video !== null) {
                                $this->video_type = $this->videoType($lesson_data->video->meta_value);
                            } if ($lesson_data->file !== null) {
                                $this->file_type = $this->fileType($lesson_data->file->meta_value);
                            }
                            return view('themes.parent-theme.learning', [
                                'course' => $course_data,
                                'current_lesson' => $lesson_data,
                                'builder' => $this->courseBuilder($this->builder),
                                'titleWebsite' => $lesson_data->post_title,
                                'video_type' => $this->video_type,
                                'file_type' => $this->file_type,
                                'activity' => json_decode($this->activity)
                            ]);
                        } else {
                            return 0;
                        }
                    } else {
                        return 0;
                    }
                } else {
                    if (isset($course_data->builder->meta_value)) {
                        $lesson_id = '';
                        $this->builder = json_decode($course_data->builder->meta_value, true);
                        foreach ($this->builder as $lesson) {
                            if ($lesson['type'] === 'lesson') {
                                $lesson_id = $lesson['ID'];
                                break;
                            }
                        }
                        return redirect()->route('GET_LEARNING_ROUTE', $course_data->post_name . '/' . $lesson_id);
                    } else {
                        return 0;
                    }
                }
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    function courseBuilder($builderObj)
    {
        $sections = [];
        $lessons = [];
        foreach ($builderObj as $item) {
            if ($item['type'] === 'section_heading') {
                array_push($sections, $item);
            }
            if ($item['type'] === 'lesson') {
                array_push($lessons, $item);
            }
        }

        foreach ($sections as $i => $section) {
            $sections[$i]['post_data'] = $this->section_heading->find($section['ID']);
            $sections[$i]['lessons'] = [];
            foreach ($lessons as $x => $lesson) {
                $lessons[$x]['post_data'] = $this->lesson->find($lesson['ID']);
                if ($section['ID'] === $lesson['section']) {
                    $builder = $sections[$i]['lessons'];
                    array_push($builder, $lessons[$x]);
                    $sections[$i]['lessons'] = $builder;
                }
            }
        }
        return $sections;
    }

    function videoType($url)
    {
        if (strpos($url, 'youtube') > 0) {
            return 'youtube';
        } elseif (strpos($url, 'vimeo') > 0) {
            return 'vimeo';
        } elseif (strpos($url, 'drive') > 0) {
            return 'drive';
        } else {
            return 'unknown';
        }
    }
    function fileType($url)
    {
        if (strpos($url, 'drive') > 0) {
            return 'drive';
        } else {
            return 'host';
        }
    }

    public function updateActivity(Request $request)
    {
        if ($this->user->updateInforRegisterPostForUser(Auth::user()->id, $request->post_id, json_encode($request->activity))) {
            return true;
        } else {
            return false;
        }
    }

    public function readFileDrive($fileUrl){
        $titleWebsite = new ThemeController();
        if ($file = $this->lesson->post_id($fileUrl)->first()) {
            $fileUrlReturn = $file->file->meta_value;
        }
        return view('themes.child-theme.components.drive-content', [ 'fileUrl'=>$fileUrlReturn]);
    }
}
