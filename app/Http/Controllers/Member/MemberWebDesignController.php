<?php

namespace App\Http\Controllers\Member;

use App\Models\Posting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberWebDesignController extends Controller
{
    public function getViewWebDesign()
    {
        $posting = Posting::Where('type', "webDesign")->with('Member')->orderBy('created_at', 'desc')->get();

        return view('main/member/member-web-design', compact('posting'));
    }

    public function searchDesignWebDesign(Request $request)
    {
        $search = $request->search;
        $posting = Posting::Where('type', "webDesign")->where('title', 'like', "%" . $search . "%")->with('Member')->orderBy('created_at', 'desc')->get();

        return view('main/member/member-web-design', compact('posting'));
    }
}
