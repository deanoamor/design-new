<?php

namespace App\Http\Controllers\Member;

use App\Models\Posting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberCheckoutController extends Controller
{
    public function getViewCheckoutWithoutCart($id)
    {
        $posting = Posting::where('id', $id)->with('Member')->first();

        return view('main/member/checkout/member-checkout-without-cart', compact('posting'));
    }
}
