<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction_history;

class AdminMemberTransactionHistoryController extends Controller
{
    public function getViewMemberTransactionHistory($id)
    {
        $member = Member::where('id', $id)->with('User')->first();

        $transactionHistory = Transaction_history::where('members_id', $member->id)->with('Copy_posting')->orderBy('created_at', 'DESC')->paginate(10);

        $dateFilter = 'FIlter Date';

        return view('main/admin/admin-member/admin-member-transaction-history', compact('member', 'transactionHistory', 'dateFilter'));
    }

    public function filterDate($id, Request $request)
    {
        $member = Member::where('id', $id)->with('User')->first();

        $originalDate = $request->created_at;
        $newDate = date("Y-m-d", strtotime($originalDate));

        $transactionHistory = Transaction_history::where('members_id', $id)->where('created_at', 'like', "%" . $newDate . "%")->with('Copy_posting')->orderBy('created_at', 'DESC')->paginate(10);

        $dateFilter = $newDate;

        return view('main/admin/admin-member/admin-member-transaction-history', compact('member', 'transactionHistory', 'dateFilter'));
    }
}
