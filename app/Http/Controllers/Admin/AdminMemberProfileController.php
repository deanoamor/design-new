<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use App\Models\Posting;
use Illuminate\Http\Request;
use App\Models\Transaction_history;
use App\Http\Controllers\Controller;

class AdminMemberProfileController extends Controller
{
    public function getViewMemberProfile($id)
    {
        $member = Member::where('id', $id)->with('User')->first();

        $postingCount = Posting::where('members_id', $member->id)->count();

        $transactionHistoryCount = Transaction_history::where('members_id', $member->id)->count();

        return view('main/admin/admin-member/admin-member-profile', compact('member', 'postingCount', 'transactionHistoryCount'));
    }
}
