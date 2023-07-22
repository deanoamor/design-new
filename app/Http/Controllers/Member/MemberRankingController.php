<?php

namespace App\Http\Controllers\Member;

use App\Models\Posting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberRankingController extends Controller
{
    public function getViewRanking()
    {
        $postingLike = Posting::with('Member')->orderBy('like', 'desc')->paginate(4);
        $postingDownload = Posting::with('Member')->orderBy('download', 'desc')->paginate(4);

        return view('main/member/member-ranking', compact('postingLike', 'postingDownload'));
    }
}
