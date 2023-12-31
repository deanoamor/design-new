<?php

namespace App\Http\Controllers\Member;

use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class MemberProfileController extends Controller
{
    public function getViewProfile()
    {
        $member = Member::with('User')->where('users_id', Auth::user()->id)->first();

        return view('main/member/member-profile', compact('member'));
    }

    public function updateProfile(Request $request)
    {
        $memberId = $request->id;
        $member = Member::where('id', $memberId)->first();
        $user = User::where('id', Auth::user()->id)->first();

        $email = User::where('email', $request->email)->first();

        //validation
        $request->validate([
            'email' => 'email:rfc,dns',
        ]);

        if ($request->no_hp) {
            $request->validate([
                'no_hp' => 'numeric',
            ]);
        }

        if ($user->email != $request->email) {
            if ($email) {
                //send alert success
                Alert::error('Email cant be the same', 'There is a user who has the same email as your new email');

                //return back to profile
                return redirect()->route('member.profile');
            }
        }

        //image
        if (empty($request->file('image_url'))) {
            $imageName = $member->image_name;
            $imageUrl = $member->image_url;
        } else {

            //validation
            $request->validate([
                'image_url' => 'required|mimes:png|max:10024',
            ]);

            Storage::delete('public/profile/' . $member->image_name);

            $image = $request->file('image_url');
            $imageName = $image->getClientOriginalName();
            Storage::putFileAs(
                'public/profile',
                $image,
                $imageName
            );
            $imageUrl = 'storage/profile/' . $imageName;
        }

        $member->update([
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
        return redirect()->route('member.profile');
    }

    public function updateWallet(Request $request)
    {
        //get id member
        $memberId = $request->id;

        //find member 
        $member = Member::where('id', $memberId)->first();

        //get wallet from form
        $wallet = $request->wallet;

        //validation
        $request->validate([
            'wallet' => 'numeric'
        ]);

        //calculated exisitng wallet with new wallet
        $walletAccu = $member->wallet + $wallet;

        //update wallet in member 
        Member::where('id', $memberId)->update(['wallet' => $walletAccu]);

        //send alert success
        Alert::success('Success top up', 'wallet was successfully top up');

        //return back to profile
        return redirect()->route('member.profile');
    }
}
