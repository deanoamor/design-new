<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Member;
use App\Models\Report;
use App\Models\Posting;
use Illuminate\Http\Request;
use App\Models\Transaction_history;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AdminHomeController extends Controller
{
    public function getViewAdminHome()
    {
        $memberCount = Member::count();

        $postingCount = Posting::count();

        $transactionCount = Transaction_history::count();

        $admin = Admin::first();

        $report = Report::with('Posting')->with(['Member' => function ($query) {
            $query->with('User');
        }])->get();

        return view('main/admin/admin-home', compact('memberCount', 'postingCount', 'transactionCount', 'admin', 'report'));
    }

    public function deleteReport($id)
    {
        $report = Report::where('id', $id)->first();

        if ($report->image_prove_name) {
            Storage::delete('public/report/' . $report->image_prove_name);
        }

        $report->delete();

        //send alert success
        Alert::success('Success delete report', 'Report was successfully deleted');

        //return back to home
        return redirect()->route('admin.home');
    }
}
