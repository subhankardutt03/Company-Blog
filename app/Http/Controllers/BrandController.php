<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function allBrand()
    {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    public function addBrand(Request $request)
    {

        $validated = $request->validate(
            [
                'brand_name' => 'required|unique:brands|min:4',
                'brand_image' => 'required|mimes:png,jpg,jpeg',
            ],
            [
                'brand_name.required' => 'please Enter Brand name',
                'brand_name.min' => 'please Enter minimum 4 character',
                'brand_image.required' => 'Please Enter brand Image',
                'brand_image.mimes' => 'Please choose PNG or JPG or JPEG',
            ]
        );

        $brand_image = $request->file('brand_image');
        // $name_generate = hexdec(uniqid());
        // $image_extension = strtolower($brand_image->getClientOriginalExtension());
        // $image_name = $name_generate . "." . $image_extension;
        // $upload_location = 'images/brand/';
        // $final_image = $upload_location . $image_name;
        // $brand_image->move($upload_location, $image_name);

        // for using Intervention 

        $name_generate = hexdec(uniqid()) . "." . $brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300, 200)->save('images/brand/' . $name_generate);
        $final_image = 'images/brand/' . $name_generate;

        $brands = new Brand();
        $brands->brand_name = $request->brand_name;
        $brands->brand_image = $final_image;
        $brands->save();

        return back()->with('success', 'Brand has been added successfully');
    }

    public function editBrand($id)
    {

        $brands = Brand::find($id);
        return view('admin.brand.edit', compact('brands'));
    }

    public function updateBrand(Request $request, $id)
    {

        $validated = $request->validate(
            [
                'brand_name' => 'required|min:4',
            ],
            [
                'brand_name.required' => 'please Enter Brand name',
                'brand_name.min' => 'please Enter minimum 4 character',
                'brand_image.mimes' => 'Please choose PNG or JPG or JPEG',
            ]
        );

        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image');

        if ($brand_image) {

            $name_generate = hexdec(uniqid());
            $image_extension = strtolower($brand_image->getClientOriginalExtension());
            $image_name = $name_generate . "." . $image_extension;
            $upload_location = 'images/brand/';
            $final_image = $upload_location . $image_name;
            $brand_image->move($upload_location, $image_name);

            unlink($old_image);
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $final_image,
                'created_at' => Carbon::now(),

            ]);
            return redirect()->route('all.brand')->with('success', 'Brand has been Updated Successfully');
        } else {

            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
            ]);
            return redirect()->route('all.brand')->with('success', 'Brand has been Updated Successfully');
        }
    }

    public function deleteBrand($id)
    {
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);

        Brand::find($id)->delete();
        return redirect()->route('all.brand')->with('success', 'Brand has been Deleted Successfully');
    }
}