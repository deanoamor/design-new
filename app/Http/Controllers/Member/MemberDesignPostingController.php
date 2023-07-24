<?php

namespace App\Http\Controllers\Member;

use App\Models\Cart;
use App\Models\Member;
use App\Models\Report;
use App\Models\Posting;
use App\Models\Feedback;
use App\Models\Like_history;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction_history;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class MemberDesignPostingController extends Controller
{

    public function getViewPosting()
    {
        return view('main/member/design-posting/member-create-design-posting');
    }

    public function createPosting(Request $request)
    {
        //image
        $image = $request->file('image_url');
        $imageName = $image->getClientOriginalName();
        Storage::putFileAs(
            'public/design',
            $image,
            $imageName
        );
        $imageUrl = 'storage/design/' . $imageName;

        //file
        $file = $request->file('file_url');
        $fileName = $file->getClientOriginalName();
        Storage::putFileAS(
            'public/file',
            $file,
            $fileName
        );
        $fileUrl = 'storage/file/' . $fileName;

        $member = Member::where('users_id', Auth::user()->id)->first();

        if ($request->is_free == 1) {
            $setPrice = 0;
        } else {
            $setPrice = $request->price;
        }

        $posting = Posting::create([
            'members_id' => $member->id,
            'image_name' => $imageName,
            'image_url' => $imageUrl,
            'file_name' => $fileName,
            'file_url' => $fileUrl,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $setPrice,
            'status' => 'Active',
            'type' => $request->type,
            'is_free' => $request->is_free,
            'download' => 0,
            'like' => 0,
            'feedback' => 0,
        ]);

        //send alert success
        Alert::success('Success upload design', 'Design was successfully upload');

        //return back to detail design page
        return redirect()->route('member.detail-design', $posting->id);
    }

    public function getViewEditPosting($id)
    {
        $posting = Posting::where('id', $id)->with('Member')->first();

        return view('main/member/design-posting/member-edit-design-posting', compact('posting'));
    }

    public function updatePosting(Request $request)
    {
        $postingId = $request->id;
        $posting = posting::where('id', $postingId)->first();

        //image
        if (empty($request->file('image_url'))) {
            $imageName = $posting->image_name;
            $imageUrl = $posting->image_url;
        } else {
            Storage::delete('public/design/' . $posting->image_name);

            $image = $request->file('image_url');
            $imageName = $image->getClientOriginalName();
            Storage::putFileAs(
                'public/design',
                $image,
                $imageName
            );
            $imageUrl = 'storage/design/' . $imageName;
        }

        //file
        //image
        if (empty($request->file('file_url'))) {
            $fileName = $posting->file_name;
            $fileUrl = $posting->file_url;
        } else {
            Storage::delete('public/file/' . $posting->file_name);

            $file = $request->file('file_url');
            $fileName = $file->getClientOriginalName();
            Storage::putFileAS(
                'public/file',
                $file,
                $fileName
            );
            $fileUrl = 'storage/file/' . $fileName;
        }

        $member = Member::where('users_id', Auth::user()->id)->first();

        if ($request->is_free == 1) {
            $setPrice = 0;
        } else {
            $setPrice = $request->price;
        }

        $posting->update([
            'members_id' => $member->id,
            'image_name' => $imageName,
            'image_url' => $imageUrl,
            'file_name' => $fileName,
            'file_url' => $fileUrl,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $setPrice,
            'status' => 'Active',
            'type' => $request->type,
            'is_free' => $request->is_free,
        ]);

        //send alert success
        Alert::success('Success update design', 'Design was successfully updated');

        //return back to detail design page
        return redirect()->route('member.detail-design', $postingId);
    }

    public function deletePosting($id)
    {
        //find feedback that have posting id and delete all
        $feedbacks = Feedback::where('postings_id', $id)->get();
        if ($feedbacks) {
            $feedbacks->each->delete();
        }

        //find like that have posting id and delete all
        $likes = Like_history::where('postings_id', $id)->get();
        if ($likes) {
            $likes->each->delete();
        }

        //find report that have posting id and delete all
        $reports = Report::where('postings_id', $id)->get();
        if ($reports) {
            $reports->each->delete();
        }

        //find cart that have posting id and delete all
        $carts = Cart::where('postings_id', $id)->get();
        if ($carts) {
            $carts->each->delete();
        }

        //find posting
        $posting = Posting::where('id', $id)->first();

        Storage::delete('public/file/' . $posting->file_name);
        Storage::delete('public/design/' . $posting->image_name);
        $posting->delete();

        //send alert success
        Alert::success('Success delete design', 'Design was successfully deleted');

        //return back to home
        return redirect()->route('member.home');
    }
}
