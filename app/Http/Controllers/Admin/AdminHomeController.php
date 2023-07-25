<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Member;
use App\Models\Posting;
use App\Models\Report;
use App\Models\Transaction_history;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function getViewAdminHome()
    {
        $memberCount = Member::count();

        $postingCount = Posting::count();

        $transactionCount = Transaction_history::count();

        $admin = Admin::first();

        $report = Report::with(['Member' => function ($query) {
            $query->with('User');
        }])->get();

        return view('main/admin/admin-home', compact('memberCount', 'postingCount', 'transactionCount', 'admin', 'report'));
    }
}
