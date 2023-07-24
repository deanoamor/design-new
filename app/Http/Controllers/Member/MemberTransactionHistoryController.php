<?php

namespace App\Http\Controllers\Member;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Copy_posting;
use App\Models\Transaction_history;
use Illuminate\Support\Facades\Auth;

class MemberTransactionHistoryController extends Controller
{
    public function getViewTransactionHistory()
    {
        $member = Member::where('users_id', Auth::user()->id)->first();

        $transactionHistory = Transaction_history::where('members_id', $member->id)->with('Copy_posting')->get();

        return view('main/member/member-transaction-history', compact('transactionHistory'));
    }

    public function downloadFile($id)
    {

        $copyPosting = Copy_posting::where('id', $id)->first();

        $file = public_path() . "/$copyPosting->file_url";
        return Response()->download($file, $copyPosting->file_name);

        //return back to transaction history
        return redirect()->route('member.transaction-history');
    }
}
