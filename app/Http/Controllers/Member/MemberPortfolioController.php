<?php

namespace App\Http\Controllers\Member;

use App\Models\Member;
use App\Models\Posting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MemberPortfolioController extends Controller
{
    public function getViewPortfolio()
    {
        $member = Member::where('users_id', Auth::user()->id)->first();
        $posting = Posting::where('members_id', $member->id)->with('Member')->get();

        return view('main/member/member-portfolio', compact('posting'));
    }
}
