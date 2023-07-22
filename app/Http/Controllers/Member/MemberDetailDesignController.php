<?php

namespace App\Http\Controllers\Member;

use App\Models\Cart;
use App\Models\Member;
use App\Models\Posting;
use App\Models\Feedback;
use App\Models\Like_history;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class MemberDetailDesignController extends Controller
{
    public function getViewDetailDesign($id)
    {
        $member = Member::where('users_id', Auth::user()->id)->first();

        $posting = Posting::where('id', $id)->with('Member')->first();

        $feedback = Feedback::where('postings_id', $id)->with('Member')->with('Posting')->get();

        $like = Like_history::where('members_id', $member->id)->where('postings_id', $id)->first();

        $cart = Cart::where('members_id', $member->id)->where('postings_id', $id)->first();

        $loginId = $member->id;

        return view('main/member/member-detail-design', compact('posting', 'feedback', 'like', 'loginId', 'cart'));
    }

    public function createFeedback(Request $request)
    {
        //get posting id
        $id = $request->id;

        //find posting that have posting id
        $postingId = Posting::where('id', $id)->first();

        ///get id member that login now
        $member = Member::where('users_id', Auth::user()->id)->first();

        //validation
        $request->validate([
            'text' => 'required',
        ]);

        //feedback create
        Feedback::create([
            'postings_id' => $postingId->id,
            'members_id' => $member->id,
            'text' => $request->text,
        ]);

        //count feedback that connect with posting
        $feedbackCount = Feedback::where('postings_id', $id)->count();

        //update feedback column in posting
        Posting::where('id', $id)->update(['feedback' => $feedbackCount]);

        //return back to detail design page
        return redirect()->route('member.detail-design', $id);
    }

    public function deleteFeedback(Request $request)
    {
        //get feedback id
        $id = $request->id;

        //find feedback that want to delete
        $feedback = Feedback::where('id', $id)->first();

        //delete feedback
        Feedback::where('id', $id)->delete();

        //count feedback that connect with posting
        $feedbackCount = Feedback::where('postings_id', $feedback->postings_id)->count();

        //update feedback column in posting
        Posting::where('id', $feedback->postings_id)->update(['feedback' => $feedbackCount]);

        //return back to detail design page
        return redirect()->route('member.detail-design', $feedback->postings_id);
    }

    public function createLike($id)
    {
        //get id member that login now
        $member = Member::where('users_id', Auth::user()->id)->first();

        //find exisiting like history
        $like = Like_history::where('postings_id', $id)->where('members_id', $member->id)->first();

        //check if like found
        if ($like) {
            $like->delete();
        } else {
            Like_history::create([
                'members_id' => $member->id,
                'postings_id' => $id,
            ]);
        }

        //count like that connect with posting
        $likeCount = Like_history::where('postings_id', $id)->count();

        //update like column in posting
        Posting::where('id', $id)->update(['like' => $likeCount]);

        //return back to detail design page
        return redirect()->route('member.detail-design', $id);
    }

    public function createReport(Request $request)
    {
        //get id member that login now
        $member = Member::where('users_id', Auth::user()->id)->first();

        //get posting id
        $postingId = $request->id;

        //check if user send report with image
        if ($request->file('image_prove_url')) {
            //image
            $image = $request->file('image_prove_url');
            $imageName = $image->getClientOriginalName();
            Storage::putFileAs(
                'public/report',
                $image,
                $imageName
            );

            $imageUrl = 'storage/report/' . $imageName;
        } else {
            $imageName = null;
            $imageUrl = null;
        }

        //create report
        Report::create([
            'members_id' => $member->id,
            'postings_id' => $postingId,
            'image_prove_name' => $imageName,
            'image_prove_url' => $imageUrl,
            'text' => $request->text,
        ]);

        //send alert success
        Alert::success('Success send report', 'The report was successfully send');

        //return back to detail design page
        return redirect()->route('member.detail-design', $postingId);
    }
}
