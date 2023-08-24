<?php

namespace App\Http\Controllers\Member;

use App\Models\Posting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberIllustrationController extends Controller
{
    public function getViewIllustration()
    {
        $posting = Posting::Where('type', "illustration")->with('Member')->orderBy('created_at', 'desc')->get();

        return view('main/member/member-illustration', compact('posting'));
    }

    public function searchDesignIllustration(Request $request)
    {
        $search = $request->search;
        $posting = Posting::Where('type', "illustration")->where('title', 'like', "%" . $search . "%")->with('Member')->orderBy('created_at', 'desc')->get();

        return view('main/member/member-illustration', compact('posting'));
    }
}
