<?php

namespace App\Http\Controllers;

use App\Taxonomy;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Option;
use App\User;
use App\Course;
use Illuminate\Support\Facades\Auth;


class OptionController extends Controller
{
    protected $option, $user, $course, $taxonomy;

    public function __construct()
    {
        $this->option = new Option();
        $this->user = new User();
        $this->course = new Course();
        $this->taxonomy = new Taxonomy();
    }

    public function getOptionGeneral()
    {
        $this->user->authorizeRoles('option_general');
        $option = $this->option->getAllOption();
        $allCourse = $this->course->get();
        $category_course = $this->taxonomy->name('course_cat')->get();
        return view('admin.settings.options', ['options' => $option, 'allCourse' => $allCourse, 'categoryCourse' => $category_course]);
    }

    public function postAddOptionGeneral(Request $request)
    {
        $option_label = $request->option_label;
        $option_value_text = $request->option_value;
        $option_value_course = $request->option_value_course;
        $option_value_course_cat = $request->option_value_course_cat;
        $option_label_parent = $request->option_label_parent;
        $option_slug_parent = $request->option_slug_parent;
        return $option_label_parent;
        $option_repeat_text_content = $request->option_repeat_text_content;
        $option_repeat_text_slug = $request->option_repeat_text_slug;
        $option_name = $request->option_name;
        $option_type = $request->option_type;
        $checkNullRepeatText = '';
        $option_value = '';
        foreach ($option_label_parent as $value) {
            if ($value != null) {
                $checkNullRepeatText = 1;
                break;
            } else {
                $checkNullRepeatText = 0;
            }
        }
        if (!empty($option_label_parent) && !empty($option_slug_parent) && $checkNullRepeatText !== 0) {
            $arrParent = [];
            if (sizeof($option_label_parent) === sizeof($option_slug_parent)) {
                for ($i = 0; $i < sizeof($option_label_parent); $i++) {
//                    $arr[$i]['slug'] = $option_slug_parent[$i];
//                    $arr[$i]['label'] = $option_label_parent[$i];
                }
            }
            $option_value = json_encode($arr);
        }


        if (!empty($option_repeat_text_content) && !empty($option_repeat_text_slug) && $checkNullRepeatText !== 0) {
            $arr = [];
            if (sizeof($option_repeat_text_content) === sizeof($option_repeat_text_slug)) {
                for ($i = 0; $i < sizeof($option_repeat_text_content); $i++) {
                    $arr[$i]['slug'] = $option_repeat_text_slug[$i];
                    $arr[$i]['content'] = $option_repeat_text_content[$i];
                }
            }

            $option_value = json_encode($arr);
        }
        if (!empty($option_value_text)) {
            $option_value = $option_value_text;
        }

        if (!empty($option_value_course)) {
            $option_value = json_encode($option_value_course);
        }

        if (!empty($option_value_course_cat)) {
            $option_value = json_encode($option_value_course_cat);
        }



        return $option_value.'</br>.ádasdha';
        if (!empty($option_label) && !empty($option_value) && !empty($option_name) && !empty($option_type)) {
            if ($this->option->addNewOption($option_name, $option_value, $option_type, $option_label)) {
                return redirect()->back()->with('messages', 'Cập nhật thành công!');
            } else {
                return redirect()->back()->with('messages', 'Cập nhật không thành công!');
            }
        }
    }

    public function postUpdateOptionGeneral(Request $request)
    {
        foreach ($request->option as $value) {
            foreach ($value as $option_name => $option_value) {
                \App\Option::where('option_name', $option_name)
                    ->update(['option_value' => $option_value]);
            }
        }
        return redirect()->back()->with('messages', 'Cập nhật thành công!');
    }

    public function ajaxGetAllCourse()
    {
        return $this->course->get();
    }
}
