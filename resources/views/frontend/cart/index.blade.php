@extends('layouts.frontend.master')

@section('content')
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cart</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->
    <!-- shopping-cart-area start -->
    <div class="shopping-cart-wrapper pb-70">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <main id="primary" class="site-main">
                        <div class="shopping-cart">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="section-title">
                                        <h3>Shopping Cart</h3>
                                    </div>
                                    <form action="#">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <td>Image</td>
                                                        <td>Product Name</td>
                                                        <td>Quantity</td>
                                                        <td>Unit Price</td>
                                                        <td>Total</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($cartItems as $key => $cartItem)
                                                        <tr>
                                                            <td>
                                                                <a
                                                                    href="{{ route('product.detail', $cartItem->attributes->slug) }}">
                                                                    <img src="{{ asset($cartItem->attributes->image->image ?? '') }}"
                                                                        alt="Cart Product Image"
                                                                        title="{{ $cartItem->name }}"
                                                                        class="img-thumbnail"></a>
                                                            </td>
                                                            <td>
                                                                <a
                                                                    href="{{ route('product.detail', $cartItem->attributes->slug) }}">
                                                                    {{ $cartItem->name }}
                                                                </a>
                                                            </td>

                                                            <td>
                                                                <div class="input-group btn-block">
                                                                    <div class="product-qty me-3">

                                                                        <input mx="12" type="number"
                                                                            value="{{ intval($cartItem->quantity) }}"
                                                                            name="quantity">

                                                                        <span class="dec qtybtn"><i
                                                                                class="fa fa-minus"></i></span><span
                                                                            class="inc qtybtn"><i
                                                                                class="fa fa-plus"></i></span>
                                                                    </div>
                                                                    <span class="input-group-btn">
                                                                        <button
                                                                            onclick="updateQuantity({{ $cartItem->id }})"
                                                                            class="btn btn-primary"><i
                                                                                class="fa fa-refresh"></i></button>

                                                                        <button type="button"
                                                                            class="btn btn-danger pull-right"><i
                                                                                class="fa fa-times-circle"></i></button>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                            <td>৳{{ $cartItem->price }}</td>
                                                            <td>৳{{ Cart::get($cartItem->id)->getPriceSum() }}</td>
                                                        </tr>
                                                    @empty
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>

                                    <div class="cart-amount-wrapper">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-4 offset-md-8">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td><strong>Sub-Total:</strong></td>
                                                            <td><span>৳{{ Cart::getSubTotal() }}</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Shipping Charge:</strong></td>
                                                            <td><span>৳100</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Total:</strong></td>
                                                            <td><span
                                                                    class="color-primary">৳{{ Cart::getTotal() + 100 }}</span></span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="cart-button-wrapper d-flex justify-content-between mt-4">
                                        <div class="d-flex gap-4">
                                            <a href="{{ route('products') }}" class="btn btn-secondary">
                                                Continue
                                                Shopping</a>
                                            <form action="{{ route('cart.clear') }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-info" type="submit"><span>CLEAR CART</span></button>
                                            </form>
                                        </div>
                                        @if (Cart::getTotalQuantity() > 0)
                                            <a class="button" href="{{ route('checkout.index') }}"><span>Procced to
                                                    checkout</span></a>
                                        @endif
                                        <a href="{{ route('checkout.index') }}"
                                            class="btn btn-secondary dark align-self-end">Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end of shopping-cart -->
                    </main> <!-- end of #primary -->
                </div>
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div>
    <!-- shopping-cart-area end -->
@endsection

@push('js')
    <script>
        function updateQuantity(id) {
            event.preventDefault();
            console.log(id);
            document.getElementById('update-quantity-' + id).submit();
        }
    </script>
@endpush
