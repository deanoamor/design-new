<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction_history;
use Illuminate\Http\Request;

class AdminTransactionHistoryController extends Controller
{
    public function getViewTransactionHistory()
    {
        $transactionHistory = Transaction_history::with('Member')->with('Copy_posting')->orderBy('created_at', 'DESC')->paginate(10);

        $dateFilter = 'FIlter Date';

        return view('main/admin/admin-transaction-history', compact('transactionHistory', 'dateFilter'));
    }

    public function filterDate(Request $request)
    {
        $originalDate = $request->created_at;
        $newDate = date("Y-m-d", strtotime($originalDate));

        $transactionHistory = Transaction_history::where('created_at', 'like', "%" . $newDate . "%")->with('Member')->with('Copy_posting')->orderBy('created_at', 'DESC')->paginate(10);

        $dateFilter = $newDate;

        return view('main/admin/admin-transaction-history', compact('transactionHistory', 'dateFilter'));
    }
}
