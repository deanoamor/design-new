<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminMemberController extends Controller
{
    public function getViewMember()
    {
        $member = Member::with('User')->orderBy('created_at', 'DESC')->paginate(10);

        return view('main/admin/admin-member/admin-member', compact('member'));
    }
}
