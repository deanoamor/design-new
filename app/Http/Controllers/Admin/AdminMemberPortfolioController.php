<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use App\Models\Posting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminMemberPortfolioController extends Controller
{
    public function getViewMemberPortfolio($id)
    {
        $member = Member::where('id', $id)->with('User')->first();

        $posting = Posting::where('members_id', $member->id)->with('Member')->paginate(10);

        $dateFilter = 'FIlter Date';

        return view('main/admin/admin-member/admin-member-portfolio', compact('member', 'posting', 'dateFilter'));
    }

    public function filterDate($id, Request $request)
    {
        $member = Member::where('id', $id)->with('User')->first();

        $originalDate = $request->created_at;
        $newDate = date("Y-m-d", strtotime($originalDate));

        $posting = Posting::where('members_id', $id)->where('created_at', 'like', "%" . $newDate . "%")->orderBy('created_at', 'DESC')->paginate(10);

        $dateFilter = $newDate;

        return view('main/admin/admin-member/admin-member-portfolio', compact('member', 'posting', 'dateFilter'));
    }
}
