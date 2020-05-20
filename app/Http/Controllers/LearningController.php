<?php

namespace App\Http\Controllers;

use App\Course;
use App\Lesson;
use App\Post;
use App\SectionHeading;
use Illuminate\Http\Request;
use App\Http\Controllers\ThemeController;

class LearningController extends Controller
{

    private $theme_controller, $course, $lesson, $section_heading, $builder, $post, $video_type;

    public function __construct()
    {
        $this->theme_controller = new ThemeController();
        $this->course = new Course();
        $this->lesson = new Lesson();
        $this->section_heading = new SectionHeading();
        $this->post = new Post();
        $this->builder = [];
        $this->video_type = 'unknown';
    }

    function index($course, $lesson = null)
    {
        if ($this->course->slug($course)->first()) {
            $course_data = $this->course->slug($course)->first();
            if (isset($course_data->builder->meta_value)) {
                $this->builder = json_decode($course_data->builder->meta_value, true);
            }
            if (isset($lesson)) {
                if ($this->lesson->post_id($lesson)->first()) {
                    $lesson_data = $this->lesson->post_id($lesson)->first();
                    if (isset($lesson_data->course->meta_value) && $lesson_data->course->meta_value * 1 === $course_data->ID * 1) {
                        if ($lesson_data->video !== null) {
                            $this->video_type = $this->videoType($lesson_data->video->meta_value);
                        }
                        return view('themes.parent-theme.learning', [
                            'course' => $course_data,
                            'current_lesson' => $lesson_data,
                            'builder' => $this->courseBuilder($this->builder),
                            'titleWebsite' => $lesson_data->post_title,
                            'video_type' => $this->video_type
                        ]);
                    } else {
                        return 0;
                    }
                } else {
                    return 0;
                }
            } else {
                $titleWebsite = $this->theme_controller->getTitleWebsite($course);
                return view('themes.parent-theme.learning', ['course' => $course_data, 'lesson' => null, 'titleWebsite' => $titleWebsite]);
            }
        } else {
            return 0;
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
}
