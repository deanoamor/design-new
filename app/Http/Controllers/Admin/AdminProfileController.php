<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AdminProfileController extends Controller
{
    public function getViewProfile()
    {
        $admin = Admin::with('User')->where('users_id', Auth::user()->id)->first();

        return view('main/admin/admin-profile', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        $adminId = $request->id;
        $admin = Admin::where('id', $adminId)->first();
        $user = User::where('id', Auth::user()->id)->first();

        //image
        if (empty($request->file('image_url'))) {
            $imageName = $admin->image_name;
            $imageUrl = $admin->image_url;
        } else {
            if ($admin->image_name) {
                Storage::delete('public/admin/' . $admin->image_name);
            }

            $image = $request->file('image_url');
            $imageName = $image->getClientOriginalName();
            Storage::putFileAs(
                'public/admin',
                $image,
                $imageName
            );
            $imageUrl = 'storage/admin/' . $imageName;
        }

        $admin->update([
            'image_name' => $imageName,
            'image_url' => $imageUrl,
            'username' => $request->username,
            'no_hp' =>  $request->no_hp,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        //send alert success
        Alert::success('Success update', 'profile was successfully updated');

        //return back to profile
        return redirect()->route('admin.profile');
    }
}
