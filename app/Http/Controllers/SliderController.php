<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Slider;

class SliderController extends Controller
{
    private $slider, $user;

    public function __construct()
    {
        $this->slider = new Slider();
        $this->user = new User();
    }

    public function getAllSlider()
    {
        $this->user->authorizeRoles('view_slider');
        $all_slider = $this->slider->get();
        return view('admin.slider.slider', ['all_slider' => $all_slider]);
    }

    public function addNewSlider(Request $request)
    {
        $this->user->authorizeRoles('add_slider');
        $page = $this->slider->create($this->slider->postRequest($request));
        return redirect()->back()->with('messages', 'Slider đã được tạo');
    }

    public function editSlider($id)
    {
        $this->user->authorizeRoles('update_slider');
        $slider = $this->slider->find($id);
        if(!empty($slider)){
            $post_content =  json_decode($slider->post_content);
        }else{
            $post_content = '';
        }
        return view('admin.slider.edit-slider', ['data' => $slider, 'data_content'=>$post_content]);
    }

    public function postEditSlider(Request $request, $id)
    {
        $slide = $this->slider->find($id);
        $slide->update($this->slider->postRequest($request, $id));
        return $slide;
    }
}
