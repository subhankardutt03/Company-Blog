<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChangeProfileController extends Controller
{
    public function editProfile()
    {
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);
            if ($user) {
                return view('admin.body.change_profile', compact('user'));
            }
        }
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if ($user) {
            // $old_image = $request->old_image;

            // $profile_image = $request->file('profile_photo');

            // if ($profile_image) {

            //     $name_generate = hexdec(uniqid());
            //     $image_extension = strtolower($profile_image->getClientOriginalExtension());
            //     $image_name = $name_generate . "." . $image_extension;
            //     $upload_location = 'profile-photos/';
            //     $final_image = $upload_location . $image_name;
            //     $profile_image->move($upload_location, $image_name);

            //     unlink($old_image);
            $user->name = $request['name'];
            $user->email = $request['email'];
            // $user->profile_photo_path = $final_image;
            $user->save();
            return redirect()->back()->with('success', 'Profile has been Updated Successfully');
            // } else {
            //     $user->name = $request['name'];
            //     $user->email = $request['email'];
            //     $user->save();
            //     return redirect()->back()->with('success', 'Profile has been Updated Successfully');
            // }
        } else {
            return redirect()->back();
        }
    }
}