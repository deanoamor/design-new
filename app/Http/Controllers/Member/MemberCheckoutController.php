<?php

namespace App\Http\Controllers\Member;

use App\Models\Admin;
use App\Models\Member;
use App\Models\Posting;
use App\Models\Copy_posting;
use Illuminate\Http\Request;
use App\Models\Transaction_history;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class MemberCheckoutController extends Controller
{
    public function getViewCheckoutWithoutCart($id)
    {
        $posting = Posting::where('id', $id)->with('Member')->first();

        return view('main/member/checkout/member-checkout-without-cart', compact('posting'));
    }

    public function createTransactionWithoutCart(Request $request)
    {
        $postingId = $request->id;

        $posting = Posting::where('id', $postingId)->with('Member')->first();

        $memberMy = Member::where('users_id', Auth::user()->id)->first();

        $adminOne = Admin::first();

        if ($posting->price <= $memberMy->wallet) {

            $renameimageName = 'copy_posting_image_' . $memberMy->id . $posting->image_name;

            $renameFileName = 'copy_posting_file_' . $memberMy->id . $posting->file_name;

            //copy image 
            Storage::copy('public/design/' . $posting->image_name, 'public/copy/copy_design/' . $renameimageName);

            //copy file
            Storage::copy('public/file/' . $posting->file_name, 'public/copy/copy_file/' . $renameFileName);

            $copyPosting = Copy_posting::create([
                'members_id' => $posting->Member->id,
                'member_name' => $posting->Member->username,
                'postings_id' => $posting->id,
                'image_name' => $renameimageName,
                'image_url' => 'storage/copy/copy_design/' . $renameimageName,
                'file_name' =>  $renameFileName,
                'file_url' => 'storage/copy/copy_file/' . $renameFileName,
                'title' => $posting->title,
                'description' => $posting->description,
                'price' => $posting->price,
                'status' => $posting->status,
                'type' => $posting->type,
                'is_free' => $posting->is_free,
                'download' => $posting->download,
                'like' => $posting->like,
                'feedback' => $posting->feedback,
                'date' => $posting->created_at
            ]);


            //find fee that will get by admin
            $adminFee = (5 / 100) * $posting->price;

            //send total admin fee to admin
            $adminTotal = $adminOne->wallet + $adminFee;

            //find total after minus with admin
            $totalFee = $posting->price - $adminFee;

            //find total money that will paid by login member
            $memberMyPay = $memberMy->wallet - $posting->price;

            //find total money that will get by member that have posting
            $memberPostFee = $posting->Member->wallet + $totalFee;

            //create transaction_history
            Transaction_history::create([
                'members_id' => $memberMy->id,
                'copy_postings_id' => $copyPosting->id,
                'design_members_id' => $posting->Member->id,
                'real_postings_id' => $posting->id,
                'status' => 'Berhasil',
                'total' => $posting->price,
                'admin_fee' => $adminFee
            ]);

            //update wallet member login
            Member::where('users_id', Auth::user()->id)->update(['wallet' => $memberMyPay]);

            //update wallet member that have posting
            Member::where('id', $posting->Member->id)->update(['wallet' => $memberPostFee]);

            //update to all admin wallet
            Admin::query()->update(['wallet' => $adminTotal]);

            //count transaction hisotry that have real_postings_id same with posting->id
            $transactionHistoryCount = Transaction_history::where('real_postings_id', $postingId)->count();

            //update download column in posting
            Posting::where('id', $postingId)->update(['download' => $transactionHistoryCount]);

            //find cart that already buy
            $cart = Cart::where('members_id', $memberMy->id)->where('postings_id', $posting->id)->first();

            //check if cart exist
            if ($cart) {
                Cart::where('id', $cart->id)->delete();
            }

            //send alert success
            Alert::success('Success buy design', 'Design was successfully paid');

            //return back to detail design page
            return redirect()->route('member.home');
        } else {
            //send alert success
            Alert::error('not enough money', 'please top up your money first');

            //return back to detail design page
            return redirect()->route('member.checkout.without-cart', $posting->id);
        }
    }
}
