<?php

namespace App\Http\Controllers;

use App\Taxonomy;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Option;
use App\User;
use App\Course;
use App\Post;
use Illuminate\Support\Facades\Auth;


class OptionController extends Controller
{
    protected $option, $user, $course, $taxonomy, $post;

    public function __construct()
    {
        $this->post = new Post();
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
        $option_name = $request->option_name;
        $option_type = $request->option_type;

        $repeater = $request->repeater;

        if(!empty($repeater['column'])){
            $option_value = '['.json_encode($repeater).']';
        }

        if (!empty($option_label_parent) && !empty($option_slug_parent)) {
            for ($j = 0; $j < sizeof($option_label_parent['label']); $j++) {
                if ($option_label_parent['label'] !== null) {
                    $label = $option_label_parent['label'];
                }
            }
            for ($j = 0; $j < sizeof($option_slug_parent['slug']); $j++) {
                $slug = $option_slug_parent['slug'];
            }

            $pos = 0;
            $children = '';
            for ($k = 0; $k < sizeof($label); $k++) {
                $key = $slug[$k];
                $value = $label[$k];
                dump($key);
                dump($value);
                if (!is_array($key) && !is_array($value)) {
                    $pos = $k;
                    if ($value != null) {
                        $option_value_arr[$pos][$key] = $value;
                    }
                } else {

                }
            }

//            $option_value = json_encode($option_value_arr);
            return $option_value;
        }

        if (!empty($option_value_course) && sizeof($option_value_course) > 0) {
            $option_value = json_encode($option_value_course);
        }

        //option danh mục khoá học
        if (!empty($option_value_course_cat) && $option_value_course_cat > 0) {
            $option_value = json_encode($option_value_course_cat);
        }

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

        foreach ($request->option as $key => $value) {
            foreach ($value as $option_name => $option_value) {
                if(is_array($option_value)){
                    $option_value = ''.json_encode($option_value).'';
                }
                \App\Option::where('option_name', $option_name)
                    ->update(['option_value' => $option_value]);
            }
        }
        return redirect()->back()->with('messages', 'Cập nhật thành công!');
    }

    public
    function ajaxGetAllCourse()
    {
        return $this->course->get();
    }
}
