@extends('layouts.frontend.master')


@section('content')
    <!-- slider area start -->
    @include('frontend.slider')
    <!-- slider area end -->

    {{-- product section add below --}}


    <div class="feature-style-one pt-70 pb-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="feature-inner fix">
                        <div class="col">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <img src="{{ asset('assets/frontend/img/icon/wrapper1.png') }}" alt="">
                                </div>
                                <div class="feature-content">
                                    <h4>free shipping</h4>
                                    <p>free shipping on all us order</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <img src="{{ asset('assets/frontend/img/icon/wrapper2.png') }}" alt="">
                                </div>
                                <div class="feature-content">
                                    <h4>Support 24/7</h4>
                                    <p>Contact us 24 hours a day</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <img src="{{ asset('assets/frontend/img/icon/wrapper3.png') }}" alt="">
                                </div>
                                <div class="feature-content">
                                    <h4>100% Money Back</h4>
                                    <p>You have 30 days to Return</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <img src="{{ asset('assets/frontend/img/icon/wrapper4.png') }}" alt="">
                                </div>
                                <div class="feature-content">
                                    <h4>90 Days Return</h4>
                                    <p>If goods have problems</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <img src="{{ asset('assets/frontend/img/icon/wrapper5.png') }}" alt="">
                                </div>
                                <div class="feature-content">
                                    <h4>Payment Secure</h4>
                                    <p>We ensure secure payment</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- product wrapper area start -->
    <div class="product-wrapper fix pt-15 pb-55">
        <div class="container-fluid">
            <div class="section-title product-spacing">
                <h3><span>New</span> arivals</h3>
            </div>
            <div class="product-gallary-wrapper">
                <div class="product-gallary-active owl-carousel owl-arrow-style product-spacing">
                    @forelse ($newProducts as $key => $newProduct)
                        <div class="product-item">
                            <div class="product-thumb">
                                <a href="product-details.html">
                                    @forelse ($newProduct->productImages as $key => $image)
                                        <img src="{{ asset($image->image) }}"
                                            class="{{ $key == 0 ? 'pri-img' : 'sec-img' }}" alt="">
                                    @empty
                                    @endforelse
                                </a>
                                <div class="box-label">
                                    <div class="label-product label_new">
                                        <span>new</span>
                                    </div>
                                    @if ($newProduct->discount > 0)
                                        <div class="label-product label_sale">
                                            <span>-{{ $newProduct->discount }}%</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="action-links">
                                    <a href="#" title="Wishlist"><i class="lnr lnr-heart"></i></a>
                                    <a href="#" title="Compare"><i class="lnr lnr-sync"></i></a>
                                    <a href="#" title="Quick view" data-bs-target="#quickk_view"
                                        data-bs-toggle="modal"><i class="lnr lnr-magnifier"></i></a>
                                </div>
                            </div>
                            <div class="product-caption">
                                <div class="manufacture-product">
                                    <p><a href="shop-grid-left-sidebar.html">
                                            {{ $newProduct->brand->name ?? '' }}
                                        </a></p>
                                </div>
                                <div class="product-name">
                                    <h4><a href="product-details.html">
                                            {{ $newProduct->name }}
                                        </a></h4>
                                </div>
                                <div class="ratings">
                                    <span class="yellow"><i class="lnr lnr-star"></i></span>
                                    <span class="yellow"><i class="lnr lnr-star"></i></span>
                                    <span class="yellow"><i class="lnr lnr-star"></i></span>
                                    <span class="yellow"><i class="lnr lnr-star"></i></span>
                                    <span class="yellow"><i class="lnr lnr-star"></i></span>
                                </div>
                                <div class="price-box">
                                    @if ($newProduct->discount > 0)
                                        <span class="regular-price"><span
                                                class="special-price">£{{ $newProduct->discount_price }}</span></span>
                                        <span class="old-price"><del>£ {{ $newProduct->price }}</del></span>
                                    @else
                                        <span class="old-price">£ {{ $newProduct->price }}</span>
                                    @endif

                                </div>
                                <button class="btn-cart" type="button">add to cart</button>
                            </div>
                        </div>
                        <!-- </div> end single item -->
                    @empty
                        No new product found
                    @endforelse


                </div>
            </div>

        </div>
    </div>

    <!-- product wrapper area start -->

    <!-- home banner statics area -->
    <div class="banner-statics">
        <div class="container-fluid">
            <div class="single-banner-statics">
                <a href="shop-grid-left-sidebar.html"><img src="assets/frontend/img/banner/img-bottom-sinrato1.jpg"
                        alt=""></a>
            </div>
        </div>
    </div>
    <!-- home banner statics area end -->


    <!-- product wrapper area start -->
    <div class="product-wrapper fix pt-15 pb-55">
        <div class="container-fluid">
            <div class="section-title product-spacing">
                <h3><span>Feature</span> Products</h3>
            </div>
            <div class="product-gallary-wrapper">
                <div class="product-gallary-active owl-carousel owl-arrow-style product-spacing">
                    @forelse ($featuredProducts as $key => $featuredProduct)
                        <div class="product-item">
                            <div class="product-thumb">
                                <a href="product-details.html">
                                    @forelse ($featuredProduct->productImages as $key => $image)
                                        <img src="{{ asset($image->image) }}"
                                            class="{{ $key == 0 ? 'pri-img' : 'sec-img' }}" alt="">
                                    @empty
                                    @endforelse
                                </a>
                                <div class="box-label">
                                    <div class="label-product label_new">
                                        <span>new</span>
                                    </div>
                                    @if ($featuredProduct->discount > 0)
                                        <div class="label-product label_sale">
                                            <span>-{{ $featuredProduct->discount }}%</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="action-links">
                                    <a href="#" title="Wishlist"><i class="lnr lnr-heart"></i></a>
                                    <a href="#" title="Compare"><i class="lnr lnr-sync"></i></a>
                                    <a href="#" title="Quick view" data-bs-target="#quickk_view"
                                        data-bs-toggle="modal"><i class="lnr lnr-magnifier"></i></a>
                                </div>
                            </div>
                            <div class="product-caption">
                                <div class="manufacture-product">
                                    <p><a href="shop-grid-left-sidebar.html">
                                            {{ $featuredProduct->brand->name ?? '' }}
                                        </a></p>
                                </div>
                                <div class="product-name">
                                    <h4><a href="product-details.html">
                                            {{ $featuredProduct->name }}
                                        </a></h4>
                                </div>
                                <div class="ratings">
                                    <span class="yellow"><i class="lnr lnr-star"></i></span>
                                    <span class="yellow"><i class="lnr lnr-star"></i></span>
                                    <span class="yellow"><i class="lnr lnr-star"></i></span>
                                    <span class="yellow"><i class="lnr lnr-star"></i></span>
                                    <span class="yellow"><i class="lnr lnr-star"></i></span>
                                </div>
                                <div class="price-box">
                                    @if ($featuredProduct->discount > 0)
                                        <span class="regular-price"><span
                                                class="special-price">£{{ $featuredProduct->discount_price }}</span></span>
                                        <span class="old-price"><del>£ {{ $featuredProduct->price }}</del></span>
                                    @else
                                        <span class="old-price">£ {{ $featuredProduct->price }}</span>
                                    @endif

                                </div>
                                <button class="btn-cart" type="button">add to cart</button>
                            </div>
                        </div>
                        <!-- </div> end single item -->
                    @empty
                        feature products not available
                    @endforelse


                </div>
            </div>

        </div>
    </div>

    <!-- product wrapper area start -->

    <!-- brand area start -->
    <div class="brand-area-home2 pt-30 pb-70">
        <div class="container-fluid">
            <div class="brand2-slider-wrapper">
                <div class="brand2-slider-active">
                    @forelse ($brands as $brand)
                        <div class="single-brand-logo">
                            <a href="#" class="brand-logo-carousel"><img src="{{ asset($brand->image) }}"
                                    alt=""></a>
                        </div>
                    @empty
                        No brand found
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <!-- brand area end -->
@endsection

@push('page_css')
    <style>
        .brand-logo-carousel img {
            width: 185px;
            display: flex;
            gap: 10px border: 1px solid #cfcfcf;
            border-radius: 6px;
        }
    </style>
@endpush
