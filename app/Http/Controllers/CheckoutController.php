<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout()
    {

        return view('frontend.cart.checkout');
    }

    public function checkoutStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:11',
            'address' => 'required|string|max:255',
            'payment_method' => 'required',
        ]);

        $user = User::where('id', Auth::user()->id)->first();
        if ($user->phone == null && $user->address == null) {
            $user->update([
                'phone' => $request->phone,
                'address' => $request->address
            ]);
        }

        if ($request->payment_method == 'cash') {


            $totalPrice = \Cart::getTotal() + 100; /* shipping charge 100taka */
            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $totalPrice,
                'payment_method' => $request->payment_method,
                'payment_status' => 'Awaiting Payment',
                'order_note' => $request->order_note,
                'shipping_address' => $request->address
            ]);


            $cartItems = \Cart::getContent();
            foreach (\Cart::getContent() as $cart) {
                $order->products()->attach($cart->id, [
                    'quantity' => $cart->quantity,
                    'price' => $cart->price,
                ]);
            }

            \Cart::clear();

            notyf()->success('Your order has been placed successfully.');
            return to_route('home');
        }
    }
}
