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
        $option_name = $request->option_name;
        $option_type = $request->option_type;
        $checkNullRepeatText = '';
        $option_value = '';

        $arrParent = [];

        if (!empty($option_label_parent) && !empty($option_slug_parent)) {
            foreach ($option_slug_parent as $k => $item) {
                foreach ($item as $i => $value) {
                    if (!is_array($value)) {
                        $parentIndex = $i;
                        $arrParent[$i]['slug'] = $value;
                    }
                    if (is_array($value)) {
                        $arrParent[$parentIndex]['children']['slug'][] = $value;
                    }
                }
            }

            foreach ($option_label_parent as $k => $item) {
                foreach ($item as $i => $value) {
                    if (!is_array($value)) {
                        $parentIndex = $i;
                        $arrParent[$i]['label'] = $value;
                    }
                    if (is_array($value)) {
                        $arrParent[$parentIndex]['children']['label'][] = $value;
                    }
                }
            }
            $option_value = json_encode($arrParent);
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

        foreach ($request->option as $value) {

            if (array_key_exists('option_label_parent', $value) || array_key_exists('option_slug_parent', $value)) {
                $option_label_parent = $value['option_label_parent'];
                $option_slug_parent = $value['option_slug_parent'];
                $option_name = $option_slug_parent[0];
                $arrParent = [];
                if (!empty($option_label_parent) && !empty($option_slug_parent)) {
                    $parentIndex = 0;
                    foreach ($option_slug_parent as $k => $item) {
                        if (!is_array($item)) {
                            $parentIndex = $k;
                            $arrParent[$k]['slug'] = $item;
                        }
                        if (is_array($item)) {
                            $arrParent[$parentIndex]['children']['slug'][] = $item;
                        }
                    }
                    $parentIndex = 0;
                    foreach ($option_label_parent as $k => $item) {
                        if (!is_array($item)) {
                            $parentIndex = $k;
                            $arrParent[$k]['label'] = $item;
                        }
                        if (is_array($item)) {
                            $arrParent[$parentIndex]['children']['label'][] = $item;
                        }
                    }
                }

                $option_value = json_encode($arrParent);
                \App\Option::where('option_name', $option_name)
                    ->update(['option_value' => $option_value]);
            } else {
                foreach ($value as $option_name => $option_value) {
                    \App\Option::where('option_name', $option_name)
                        ->update(['option_value' => $option_value]);
                }
            }
        }
        return redirect()->back()->with('messages', 'Cập nhật thành công!');
    }

    public function ajaxGetAllCourse()
    {
        return $this->course->get();
    }
}
