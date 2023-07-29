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

    public function searchMember(Request $request)
    {
        $searchMember = $request->search;

        $member = Member::where('username', 'like', "%" . $searchMember . "%")->with('User')->orderBy('created_at', 'DESC')->paginate(10);

        return view('main/admin/admin-member/admin-member', compact('member'));
    }

    public function setStatus($id)
    {
        $member = Member::where('id', $id)->first();

        if ($member->status == 'Active') {
            Member::where('id', $id)->update(['status' => 'Not Active']);
        } else {
            Member::where('id', $id)->update(['status' => 'Active']);
        }

        return redirect()->route('admin.member');
    }
}
