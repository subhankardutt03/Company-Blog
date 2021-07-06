<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    public function allSlider()
    {
        $sliders = Slider::latest()->paginate(5);
        return view('admin.slider.index', compact('sliders'));
    }

    public function addSlider()
    {
        return view('admin.slider.create');
    }

    public function storeSlider(Request $request)
    {

        $validated = $request->validate(
            [
                'title' => 'required|unique:sliders',
                'image' => 'required|mimes:png,jpg,jpeg',
            ],
            [
                'title.required' => 'please Enter Slider Title',
                'image.mimes' => 'Please choose PNG or JPG or JPEG',
            ]
        );

        $slider_image = $request->file('image');

        // $name_generate = hexdec(uniqid());
        // $image_extension = strtolower($brand_image->getClientOriginalExtension());
        // $image_name = $name_generate . "." . $image_extension;
        // $upload_location = 'images/brand/';
        // $final_image = $upload_location . $image_name;
        // $brand_image->move($upload_location, $image_name);

        // for using Intervention 

        $name_generate = hexdec(uniqid()) . "." . $slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920, 1088)->save('images/slider/' . $name_generate);
        $final_image = 'images/slider/' . $name_generate;

        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $final_image,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('all.slider')->with('success', 'Slider has been added successfully');
    }

    public function editSlider($id)
    {
        $sliders = Slider::find($id);
        return view('admin.slider.edit', compact('sliders'));
    }

    public function updateSlider(Request $request, $id)
    {

        // $validated = $request->validate(
        //     [
        //         'title' => 'required',
        //         'image' => 'mimes:png,jpg,jpeg',
        //     ],
        //     [
        //         'title.required' => 'please Enter Slider Title',
        //         'image.mimes' => 'Please choose PNG or JPG or JPEG',
        //     ]
        // );


        $old_image = $request->old_image;

        $slider_image = $request->file('image');

        if ($slider_image) {

            $name_generate = hexdec(uniqid());
            $image_extension = strtolower($slider_image->getClientOriginalExtension());
            $image_name = $name_generate . "." . $image_extension;
            $upload_location = 'images/slider/';
            $final_image = $upload_location . $image_name;
            $slider_image->move($upload_location, $image_name);

            unlink($old_image);
            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $final_image,
                'created_at' => Carbon::now(),

            ]);
            return redirect()->route('all.slider')->with('success', 'Slider has been Updated Successfully');
        } else {

            Slider::find($id)->update([
                'title' => $request->title,
            ]);
            return redirect()->route('all.slider')->with('success', 'Slider has been Updated Successfully');
        }
    }

    public function deleteSlider($id)
    {

        $sliders = Slider::find($id);
        $old_image = $sliders->image;
        unlink($old_image);

        Slider::find($id)->delete();
        return redirect()->route('all.slider')->with('success', 'Slider has been Deleted Successfully');
    }
}