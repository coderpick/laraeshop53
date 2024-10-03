<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        if (\Cart::getTotalQuantity() <= 0) {
            notyf()->warning('Your Cart is Empty');
            return redirect()->route('cart.index');
        } else {
            $condition = new \Darryldecode\Cart\CartCondition(array(
                'name' => 'Cash on Delivery 100 tk',
                'type' => 'shaping',
                'target' => 'total', // this condition will be applied to cart's total when getTotal() is called.
                'value' => '+100',
                'order' => 1 // the order of calculation of cart base conditions. The bigger the later to be applied.
            ));
            \Cart::condition($condition);
            return view('checkout');
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'address' => 'required|string',
            'mobile' => 'required|numeric',
            'city' => 'required|string',
            'zip_code' => 'required',
        ]);
        $user = User::findOrFail(Auth::id());
        $user->address = $request->address;
        $user->mobile = $request->mobile;
        $user->city = $request->city;
        $user->zip_code = $request->zip_code;
        $user->save();
        //        Create order
        $order = new Order();
        $order->user_id = Auth::id();
        $order->user_id = Auth::id();
        $order->total = \Cart::getTotal();
        $order->save();
        foreach (\Cart::getContent() as $cart) {
            $order->products()->attach($cart->id, ['quantity' => $cart->quantity]);
        }
        \Cart::clear();
        notyf()->success('Your Order Successfully Placed');
        return redirect()->route('home');
    }
}
