<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cart;
use App\Models\Report;
use App\Models\Posting;
use App\Models\Feedback;
use App\Models\Like_history;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AdminDetailDesignController extends Controller
{
    public function getViewDetailDesign($id)
    {
        $posting = Posting::where('id', $id)->with('Member')->first();

        $feedback = Feedback::where('postings_id', $id)->with('Member')->with('Posting')->get();

        return view('main/admin/admin-detail-design', compact('posting', 'feedback'));
    }

    public function deletePosting(Request $request)
    {
        $id = $request->id;

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
            foreach ($reports as $report) {
                if ($report->image_prove_name) {
                    Storage::delete('public/report/' . $report->image_prove_name);
                }
            }

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
        return redirect()->route('admin.home');
    }
}
