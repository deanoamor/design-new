<?php

namespace App\Http\Controllers\Member;

use App\Models\Cart;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class MemberCartController extends Controller
{
    public function getViewCart()
    {
        $member = Member::where('users_id', Auth::user()->id)->first();

        $cart = Cart::where('members_id', $member->id)->with('Member')->with(['Posting' => function ($query) {
            $query->with('Member');
        }])->orderBy('created_at', 'DESC')->get();

        return view('main/member/member-cart', compact('cart', 'member'));
    }

    public function addToCart($id)
    {
        //get id member that login now
        $member = Member::where('users_id', Auth::user()->id)->first();

        //create cart or add to cart
        Cart::create([
            'members_id' => $member->id,
            'postings_id' => $id,
            'status' => 'Active',
            'is_select' => 0,
            'total' => 0
        ]);

        //send alert success
        Alert::success('Success add to cart', 'This design was successfully added to your cart');

        //return back to detail design page
        return redirect()->route('member.detail-design', $id);
    }

    public function deleteCart(Request $request)
    {
        $id = $request->id;

        Cart::where('id', $id)->delete();

        //send alert success
        Alert::success('Success remove cart', 'the cart was successfully remove from your list cart');

        //return back to cart
        return redirect()->route('member.cart');
    }

    public function setSelect(Request $request)
    {
        $cartId = $request->id;

        $cart =  Cart::where('id', $cartId)->first();

        if ($cart->is_select == 1) {
            Cart::where('id', $cartId)->update([
                'is_select' => 0,
            ]);
        } else {
            Cart::where('id', $cartId)->update([
                'is_select' => 1,
            ]);
        }

        //return back to checkout page
        return redirect()->route('member.cart');
    }
}
