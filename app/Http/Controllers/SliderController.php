<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;

class SliderController extends Controller
{
    private $slider;

    public function __construct()
    {
        $this->slider = new Slider();
    }

    public function getAllSlider()
    {
        $all_slider = $this->slider->get();
        return view('admin.slider.slider', ['all_slider' => $all_slider]);
    }

    public function addNewSlider(Request $request)
    {
        $page = $this->slider->create($this->slider->postRequest($request));
        return redirect()->back()->with('messages', 'Slider đã được tạo');
    }

    public function editSlider($id)
    {
        $slider = $this->slider->find($id);
        $post_content =  json_decode($slider->post_content);
        return view('admin.slider.edit-slider', ['data' => $slider, 'data_content'=>$post_content]);
    }

    public function postEditSlider(Request $request, $id)
    {
        $slide = $this->slider->find($id);
        $slide->update($this->slider->postRequest($request, $id));
        return $slide;
    }
}
