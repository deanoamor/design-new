<?php

namespace App\Http\Controllers\Admin;

use App\Models\Posting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminUploadedHistoryController extends Controller
{
    public function getViewUploadedHistory()
    {
        $posting = Posting::with('Member')->orderBy('created_at', 'DESC')->paginate(10);

        $dateFilter = 'FIlter Date';

        return view('main/admin/admin-uploaded-history', compact('posting', 'dateFilter'));
    }

    public function filterDate(Request $request)
    {
        $originalDate = $request->created_at;
        $newDate = date("Y-m-d", strtotime($originalDate));

        $posting = Posting::where('created_at', 'like', "%" . $newDate . "%")->with('Member')->orderBy('created_at', 'DESC')->paginate(10);

        $dateFilter = $newDate;

        return view('main/admin/admin-uploaded-history', compact('posting', 'dateFilter'));
    }
}
