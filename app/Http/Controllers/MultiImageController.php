<?php

namespace App\Http\Controllers;

use App\Models\MultiImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class MultiImageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function allImages()
    {
        $images = MultiImage::all();
        return view('admin.multiImage.index', compact('images'));
    }

    public function addImages(Request $request)
    {
        $brand_image = $request->file('image');

        // $name_generate = hexdec(uniqid());
        // $image_extension = strtolower($brand_image->getClientOriginalExtension());
        // $image_name = $name_generate . "." . $image_extension;
        // $upload_location = 'images/multiImage/';
        // $final_image = $upload_location . $image_name;
        // $brand_image->move($upload_location, $image_name);

        // for using Intervention 

        foreach ($brand_image as $image) {

            $name_generate = hexdec(uniqid()) . "." . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 200)->save('images/multiImage/' . $name_generate);
            $final_image = 'images/multiImage/' . $name_generate;

            MultiImage::insert([
                'image' => $final_image,
                'created_at' => Carbon::now(),
            ]);
        }
        return back()->with('success', 'Multi Images has been added successfully');
    }
}