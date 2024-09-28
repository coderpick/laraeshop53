<header class="header-pos">
    <div class="header-top black-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="header-top-left">
                        <ul>
                            <li><span>Email: </span>support@sinrato.com</li>
                            <li>Free Shipping for all Order of $99</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="box box-right">
                        <ul class="d-flex">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link text-warning" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link text-warning"
                                            href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item">
                                    <a class="nav-link text-warning" href="#" role="button" aria-haspopup="true"
                                        aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>
                                    <span class="text-warning">|</span>
                                    <a class="nav-link text-warning" href="#" role="button" aria-haspopup="true"
                                        aria-expanded="false" v-pre>
                                        Dashboard
                                    </a>
                                    <span class="text-warning">|</span>

                                    <a class="nav-link text-warning" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-sm-4 col-12">
                    <div class="logo">
                        <a href="{{ route('home') }}"><img
                                src="{{ asset('assets/frontend/img/logo/logo-sinrato.png') }}" alt="brand-logo"></a>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-12 order-sm-last">
                    <div class="header-middle-inner">
                        <form action="" class="w-100">

                            <input type="text" class="top-cat-field" placeholder="Search entire store here">
                            <input type="button" class="top-search-btn" value="Search">
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8 col-12 col-sm-8 order-lg-last">
                    <div class="mini-cart-option">
                        <ul>
                            <li class="compare">
                                <a class="ha-toggle" href="compare.html"><span class="lnr lnr-sync"></span>Product
                                    compare</a>
                            </li>
                            <li class="wishlist">
                                <a class="ha-toggle" href="wishlist.html"><span class="lnr lnr-heart"></span><span
                                        class="count">1</span>wishlist</a>
                            </li>
                            <li class="my-cart">
                                <button type="button" class="ha-toggle"><span class="lnr lnr-cart"></span><span
                                        class="count">2</span>my cart</button>
                                <ul class="mini-cart-drop-down ha-dropdown">
                                    <li class="mb-30">
                                        <div class="cart-img">
                                            <a href="product-details.html"><img alt=""
                                                    src="assets/img/cart/cart-1.jpg"></a>
                                        </div>
                                        <div class="cart-info">
                                            <h4><a href="product-details.html">Koss Porta Pro On Ear Headphones </a>
                                            </h4>
                                            <span> <span>1 x </span>£165.00</span>
                                        </div>
                                        <div class="del-icon">
                                            <i class="fa fa-times-circle"></i>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="subtotal-text">Sub-total: </div>
                                        <div class="subtotal-price">£48.94</div>
                                    </li>
                                    <li>
                                        <div class="subtotal-text">Eco Tax (-2.00): </div>
                                        <div class="subtotal-price">£1.51</div>
                                    </li>
                                    <li>
                                        <div class="subtotal-text">Vat (20%): </div>
                                        <div class="subtotal-price">£9.79</div>
                                    </li>
                                    <li>
                                        <div class="subtotal-text">Total: </div>
                                        <div class="subtotal-price"><span>£60.24</span></div>
                                    </li>
                                    <li class="mt-30">
                                        <a class="cart-button" href="cart.html">view cart</a>
                                    </li>
                                    <li>
                                        <a class="cart-button" href="checkout.html">checkout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="header-top-menu theme-bg sticker">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="top-main-menu">
                        <div class="categories-menu-bar">
                            <div class="categories-menu-btn ha-toggle">
                                <div class="left">
                                    <i class="lnr lnr-text-align-left"></i>
                                    <span>Browse categories</span>
                                </div>
                                <div class="right">
                                    <i class="lnr lnr-chevron-down"></i>
                                </div>
                            </div>
                            <nav class="categorie-menus ha-dropdown">
                                <ul id="menu2">
                                    @forelse ($categories as $key=> $category)
                                        <li>
                                            <a href="{{ route('category.product', $category->slug) }}">{!! $category->name !!}
                                                @if ($category->subCategories->count() > 0)
                                                    <span class="lnr lnr-chevron-right"></span>
                                                @endif
                                            </a>
                                            @if ($category->subCategories->count() > 0)
                                                <ul class="cat-submenu">
                                                    @foreach ($category->subCategories as $subCategory)
                                                        <li><a
                                                                href="{{ route('category.product', $subCategory->slug) }}">{!! $subCategory->name !!}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @empty
                                    @endforelse
                                </ul>
                            </nav>
                        </div>
                        <div class="main-menu">
                            <nav id="mobile-menu" style="display: block;">
                                <ul>
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    <li><a href="{{ route('products') }}">Shop</a></li>
                                    <li><a href="">CONTACT US</a></li>
                                </ul>
                            </nav>
                        </div> <!-- </div> end main menu -->
                        <div class="header-call-action">
                            <p><span class="lnr lnr-phone"></span>Hotline : <strong>1-001-234-5678</strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-block d-lg-none">
                    <div class="mobile-menu"></div>
                </div>
            </div>
        </div>
    </div>
</header>
