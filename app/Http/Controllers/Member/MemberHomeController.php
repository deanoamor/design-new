<?php

namespace App\Http\Controllers\Member;

use App\Models\Posting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberHomeController extends Controller
{
    public function getViewHome()
    {
        $postingIllustration = Posting::Where('type', "illustration")->with('Member')->orderBy('like', 'desc')->paginate(4);
        $postingWebDesign = Posting::Where('type', "WebDesign")->with('Member')->orderBy('like', 'desc')->paginate(4);

        return view('main/member/member-home', compact('postingIllustration', 'postingWebDesign'));
    }

    public function searchDesignHome(Request $request)
    {
        $search = $request->search;
        $posting = Posting::where('title', 'like', "%" . $search . "%")->with('Member')->get();

        return view('main/member/member-home-search')->with('posting', $posting);
    }
}
