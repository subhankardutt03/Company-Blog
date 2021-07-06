<?php

namespace App\Http\Controllers;

use App\Models\HomeAbout;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function allAbout()
    {
        $about = HomeAbout::latest()->get();
        return view('admin.about.index', compact('about'));
    }

    public function addAbout()
    {
        return view('admin.about.create');
    }

    public function storeAbout(Request $request)
    {
        $validated = $request->validate(
            [
                'title' => 'required|unique:home_abouts',
                'short_desc' => 'required',
                'long_desc' => 'required',
            ],
            [
                'title.required' => 'please Enter Slider Title',
                'short_desc.required' => 'Please Enter short Description',
                'long_desc.required' => 'Please Enter Long Description',
            ]
        );

        HomeAbout::insert([
            'title' => $request->title,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('all.about')->with('success', 'About page has been added Successfully');
    }

    public function editAbout($id)
    {
        $about = HomeAbout::find($id);
        return view('admin.about.edit', compact('about'));
    }

    public function updateAbout(Request $request, $id)
    {

        HomeAbout::find($id)->update([
            'title' => $request->title,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc
        ]);

        return redirect()->route('all.about')->with('success', 'About has been updated successfully');
    }

    public function deleteAbout($id)
    {
        HomeAbout::find($id)->delete();
        return redirect()->route('all.about')->with('success', 'About record has been deleted successfully');
    }
}