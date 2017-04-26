<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
// use PDF;
use App\Address;
// use App\Order;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except' => ['invoice']]);
        $this->middleware('auth.admin', ['only' => ['adminEdit']]);
    }

    public function index()
    {
        return view('account');
        // return view('account.home');
    }

    public function updateEmail()
    {
        $validator = Validator::make(request()->all(), ['email' => 'required|email|max:255|unique:users,email,'.Auth::user()->id.',id',]);

        if($validator->fails())
            return Response::json(['error' => true,'message' => $validator->messages()->all(),'code' => 400], 400);

        Auth::user()->update(['email' => request('email')]);
    }

    public function updatePassword()
    {
        $validator = Validator::make(request()->all(), ['New_Password' => 'required|min:6']);
        if($validator->fails())
            return Response::json(['error' => true,'message' => $validator->messages()->all(),'code' => 400], 400);

        if(Auth::user()->password != '') {
            if(!Hash::check(request('Old_Password'), Auth::user()->password))
                return Response::json(['error' => true,'message' => 'Incorrect old password','code' => 400], 400);
        }

        Auth::user()->update([
            'password' => bcrypt(request('New_Password'))
        ]);
    }

    // public function editProfile()
    // {
    //     return view('account.edit');
    // }
    //
    // public function adminEditProfile()
    // {
    //     return view('admin.account');
    // }
    //
    // public function updateProfile(Request $request)
    // {
    //     $this->validate($request, [
    //         'name' => 'required|max:255',
    //         'email' => 'required|email|max:255|unique:users,email,'.Auth::user()->id.',id',
    //     ]);
    //
    //     if($request->phone != null) {
    //         if(strlen($request->phone) == 7)
    //             $this->validate($request, ['phone' => 'regex:/^[3][0-9]{6}$/']);
    //         else
    //             $this->validate($request, ['phone' => 'regex:/^[0][1][0-9]{8}$/']);
    //     }
    //
    //     Auth::user()->update($request->all());
    //
    //     if(Auth::user()->role == 1)
    //         return redirect('/account');
    //     else
    //         return redirect('/admin');
    // }
    //
    //
    // public function updatePassword(Request $request)
    // {
    //     $this->validate($request, [
    //         'password' => 'required|min:6|confirmed',
    //     ]);
    //
    //     Auth::user()->update([
    //         'password' => bcrypt($request->password)
    //     ]);
    //
    //     if(Auth::user()->role == 1)
    //         return redirect('/account');
    //     else
    //         return redirect('/admin');
    // }
    //
    // public function editAddress()
    // {
    //     return view('account.address');
    // }
    //
    // public function switchAddress($addressType)
    // {
    //   return response()->json(Auth::user()->primaryAddress($addressType));
    // }
    //
    // public function saveAddress(Request $request)
    // {
    //     $this->validate($request, [
    //         'name' => 'required|max:255',
    //         'phone' => 'required',
    //         'address_line_1' => 'required',
    //         'postcode' => 'required|regex:/^[0-9]{5}$/',
    //         'city' => 'required',
    //         'state' => 'required',
    //     ]);
    //
    //     if(strlen($request->phone) == 7)
    //         $this->validate($request, ['phone' => 'regex:/^[3][0-9]{6}$/']);
    //     else
    //         $this->validate($request, ['phone' => 'regex:/^[0][1][0-9]{8}$/']);
    //
    //     // if user has not fill in phone number before
    //     if(Auth::user()->phone == null){
    //         Auth::user()->phone = $request->phone;
    //         Auth::user()->save();
    //     }
    //
    //     // if user has not added any address before
    //     if(Auth::user()->address->count() == 0){
    //         $address = new Address($request->all());
    //         if($request->type == 'delivery')
    //             $address->primaryForBilling = 0;
    //
    //         if($request->type == 'billing')
    //             $address->primaryForDelivery = 0;
    //
    //         Auth::user()->address()->save($address);
    //     }
    //     else {
    //         if($request->type == 'delivery' && Auth::user()->primaryAddress('delivery') == null){
    //           $address = new Address($request->all());
    //           $address->primaryForBilling = 0;
    //           Auth::user()->address()->save($address);
    //         }
    //
    //         if($request->type == 'billing' && Auth::user()->primaryAddress('billing') == null){
    //           $address = new Address($request->all());
    //           $address->primaryForDelivery = 0;
    //           Auth::user()->address()->save($address);
    //         }
    //
    //         if(Auth::user()->primaryAddress('delivery') != null && Auth::user()->primaryAddress('billing') != null){
    //           if(Auth::user()->address->count() == 1){
    //             $address = Auth::user()->address->first();
    //             $newAddress = new Address($request->all());
    //             if($request->type == 'delivery')
    //                 $address->primaryForDelivery = 0;
    //                 $newAddress->primaryForBilling = 0;
    //
    //             if($request->type == 'billing'){
    //                 $address->primaryForBilling = 0;
    //                 $newAddress->primaryForDelivery = 0;
    //             }
    //
    //             $address->save();
    //             Auth::user()->address()->save($newAddress);
    //
    //           }
    //           else {
    //             $address = Auth::user()->primaryAddress($request->type)->update($request->all());
    //           }
    //         }
    //     }
    //
    //     return redirect('/account');
    // }

    // public function order()
    // {
    //     $orders = Auth::user()->order;
    //     return view('account.order', compact('orders'));
    // }
    //
    // public function invoice($hashOrderCode)
    // {
    //     $orders = Order::all();
    //
    //     foreach($orders as $order) {
    //         if(hash('crc32b', $order->orderCode()) === $hashOrderCode){
    //             $data = ['order' => $order];
    //             $pdf = PDF::loadView('admin.order.invoice', $data);
    //             return $pdf->stream();
    //         }
    //     }
    //     return redirect('/');
    // }
}
