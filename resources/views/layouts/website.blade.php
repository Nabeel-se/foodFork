<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no, minimal-ui"/>

    <!-- fonts -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Questrial|Raleway:700,900" rel="stylesheet"> -->

    <link href="{{ URL::to('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('css/bootstrap.extension.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('css/swiper.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('css/sumoselect.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('css/custom.css') }}" rel="stylesheet" type="text/css" />

    @stack("styles")

    <!-- <link rel="shortcut icon" href="img/favicon.ico" /> -->
  	<title>Food4Fork</title>
</head>
<body>

    <!-- LOADER -->
    <div id="loader-wrapper"></div>

    <div id="content-block">
        <!-- HEADER -->
        <header>
            <div class="header-top">
                <div class="content-margins">
                    <div class="row">
                        <div class="col-md-5 hidden-xs hidden-sm">
                            <div class="entry coolvetica-font">✨ Share recipes, plan meals, shop smarter</div>
                        </div>
                        <div class="col-md-7 col-md-text-right">
                            <div class="entry hidden-sm">
                                <a class="title header-top-icons"><i class="fa fa-facebook-square"></i></a>
                                <a class="title header-top-icons"><i class="fa fa-instagram"></i></a>
                                <a class="title header-top-icons"><i class="fa fa-youtube-play"></i></a>

                            </div>
                            <div class="hamburger-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom">
                <div class="content-margins">
                    <div class="row vertical-aligned-columns">
                        <div class="col-xs-3 col-sm-1">
                            <a id="logo" href=""><img src="{{ URL::to('img/web-img/logo-1.png') }}" alt="" /></a>
                        </div>
                        <div class="col-xs-9 col-sm-11 text-right">
                            <div class="nav-wrapper">
                                <div class="nav-close-layer"></div>
                                <nav>
                                    <ul>
                                        <li class="active">
                                            <a href="{{ route('home') }}">Home</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('features') }}">Features</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('recipes') }}">Recipes</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('planner') }}">Planner</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('reviews') }}">Reviews</a>
                                        </li>
                                        <li>
                                            <a class="" href="{{ route('contact') }}">Contact</a>
                                        </li>
                                        @if (!auth()->check())
                                            <li>
                                                <a class="header-btn-1" href="{{ route('login') }}">Login</a>
                                            </li>
                                            <li>
                                                <a class="header-btn-2" href="{{ route('register') }}">Get Started</a>
                                            </li>
                                        @else
                                            <li>
                                                <a class="header-btn-1" href="{{ route('dashboard') }}">Dashboard</a>
                                            </li>
                                            <li>
                                                <a class="header-btn-1" href="{{ route('logout') }}">Logout</a>
                                            </li>
                                        @endif
                                    </ul>
                                    <div class="navigation-title">
                                        Navigation
                                        <div class="hamburger-icon active">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                            <!-- <div class="header-bottom-icon toggle-search"><i class="fa fa-search" aria-hidden="true"></i></div>
                            <div class="header-bottom-icon visible-rd"><i class="fa fa-heart-o" aria-hidden="true"></i></div>
                            <div class="header-bottom-icon visible-rd">
                                <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                <span class="cart-label">5</span>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>

        </header>

        @yield("content")
        <!-- FOOTER -->
        <footer>
            <div class="container">
                <div class="footer-top">
                    <div class="row">
                        <div class="col-xs-6 col-md-3 col-xs-b30 col-md-b0">
                            <img src="{{ URL::to('img/web-img/logo-footer.png') }}" height="50" alt="" />
                            <div class="empty-space col-xs-b20"></div>
                            <div class="simple-article size-2 footer-desc manrope-font fulltransparent">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper.</div>
                            <div class="empty-space col-xs-b20"></div>
                             <div class="follow">
                                <a class="entry" href="#"><i class="fa fa-facebook"></i></a>
                                <a class="entry" href="#"><i class="fa fa-instagram"></i></a>
                                <a class="entry" href="#"><i class="fa fa-youtube-play"></i></a>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-offset-1 col-md-2 col-xs-b30 col-md-b0">
                            <h4 class="h4 text-dark coolvetica-font lowercase">Quick Links</h4>
                            <div class="empty-space col-xs-b20"></div>
                            <div class="footer-column-links">
                                <div class="">
                                    <a href="{{ URL::to('/') }}">Home</a>
                                    <a href="{{ URL::to('/features') }}">Features</a>
                                    <a href="{{ URL::to('/recipes') }}">Recipes</a>
                                    <a href="{{ URL::to('/planner') }}">Planner</a>
                                    <a href="{{ URL::to('/reviews') }}">Reviews</a>
                                    <a href="{{ URL::to('/contact') }}">Contact</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-2 col-xs-b30 col-md-b0">
                            <h4 class="h4 text-dark coolvetica-font lowercase letter-sp-1">Connect with us</h4>
                            <div class="empty-space col-xs-b20"></div>
                            <div class="footer-column-links">
                                <div class="">
                                    <a href="{{ URL::to('/why-food4fork') }}">Why Food4Fork</a>
                                    <a href="{{ URL::to('/partner-with-us') }}">Partner With Us</a>
                                    <a href="{{ URL::to('/faq') }}">FAQ</a>
                                    <a href="{{ URL::to('/blog') }}">Blog</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-2 col-xs-b30 col-md-b0">
                            <h4 class="h4 text-dark coolvetica-font lowercase letter-sp-1">Support</h4>
                            <div class="empty-space col-xs-b20"></div>
                            <div class="footer-column-links">
                                <div class="">
                                    <a href="{{ URL::to('/account') }}">Account</a>
                                    <a href="{{ URL::to('/terms') }}">Terms & Conditions</a>
                                    <a href="{{ URL::to('/feedback') }}">Feedback</a>
                                    <a href="{{ URL::to('/contact') }}">Contact Us</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-2 col-xs-b30 col-md-b0">
                            <h4 class="h4 text-dark coolvetica-font lowercase letter-sp-1">Get in Touch</h4>
                            <div class="empty-space col-xs-b20"></div>
                            <div class="footer-column-links">
                                <div class="">
                                    <a href="{{ URL::to('/contact') }}">Question or feedback? We’d love to hear from you</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center col-xs-b20 col-lg-b0">
                            <div class="copyright manrope-font text-white letter-sp-1">Copyright Food4Fork Food4Fork — From recipe to fork. 2026, All Right Reserved.</div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <div class="popup-wrapper">
        <div class="bg-layer"></div>

        <div class="popup-content" data-rel="1">
            <div class="layer-close"></div>
            <div class="popup-container size-1">
                <div class="popup-align">
                    <h3 class="h3 text-center">Log in</h3>
                    <div class="empty-space col-xs-b30"></div>
                    <input class="simple-input" type="text" value="" placeholder="Your email" />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" type="password" value="" placeholder="Enter password" />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <div class="row">
                        <div class="col-sm-6 col-xs-b10 col-sm-b0">
                            <div class="empty-space col-sm-b5"></div>
                            <a class="simple-link">Forgot password?</a>
                            <div class="empty-space col-xs-b5"></div>
                            <a class="simple-link">register now</a>
                        </div>
                        <div class="col-sm-6 text-right">
                            <a class="button size-2 style-3" href="#">
                                <span class="button-wrapper">
                                    <span class="icon"><img src="{{ URL::to('img/icon-4.png') }}" alt="" /></span>
                                    <span class="text">submit</span>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="popup-or">
                        <span>or</span>
                    </div>
                    <div class="row m5">
                        <div class="col-sm-4 col-xs-b10 col-sm-b0">
                            <a class="button facebook-button size-2 style-4 block" href="#">
                                <span class="button-wrapper">
                                    <span class="icon"><img src="{{ URL::to('img/icon-4.png') }}" alt="" /></span>
                                    <span class="text">facebook</span>
                                </span>
                            </a>
                        </div>
                        <div class="col-sm-4 col-xs-b10 col-sm-b0">
                            <a class="button twitter-button size-2 style-4 block" href="#">
                                <span class="button-wrapper">
                                    <span class="icon"><img src="{{ URL::to('img/icon-4.png') }}" alt="" /></span>
                                    <span class="text">twitter</span>
                                </span>
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a class="button google-button size-2 style-4 block" href="#">
                                <span class="button-wrapper">
                                    <span class="icon"><img src="{{ URL::to('img/icon-4.png') }}" alt="" /></span>
                                    <span class="text">google+</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="button-close"></div>
            </div>
        </div>

        <div class="popup-content" data-rel="2">
            <div class="layer-close"></div>
            <div class="popup-container size-1">
                <div class="popup-align">
                    <h3 class="h3 text-center">register</h3>
                    <div class="empty-space col-xs-b30"></div>
                    <input class="simple-input" type="text" value="" placeholder="Your name" />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" type="text" value="" placeholder="Your email" />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" type="password" value="" placeholder="Enter password" />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" type="password" value="" placeholder="Repeat password" />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <div class="row">
                        <div class="col-sm-7 col-xs-b10 col-sm-b0">
                            <div class="empty-space col-sm-b15"></div>
                            <label class="checkbox-entry">
                                <input type="checkbox" /><span><a href="#">Privacy policy agreement</a></span>
                            </label>
                        </div>
                        <div class="col-sm-5 text-right">
                            <a class="button size-2 style-3" href="#">
                                <span class="button-wrapper">
                                    <span class="icon"><img src="{{ URL::to('img/icon-4.png') }}" alt="" /></span>
                                    <span class="text">submit</span>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="popup-or">
                        <span>or</span>
                    </div>
                    <div class="row m5">
                        <div class="col-sm-4 col-xs-b10 col-sm-b0">
                            <a class="button facebook-button size-2 style-4 block" href="#">
                                <span class="button-wrapper">
                                    <span class="icon"><img src="{{ URL::to('img/icon-4.png') }}" alt="" /></span>
                                    <span class="text">facebook</span>
                                </span>
                            </a>
                        </div>
                        <div class="col-sm-4 col-xs-b10 col-sm-b0">
                            <a class="button twitter-button size-2 style-4 block" href="#">
                                <span class="button-wrapper">
                                    <span class="icon"><img src="{{ URL::to('img/icon-4.png') }}" alt="" /></span>
                                    <span class="text">twitter</span>
                                </span>
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a class="button google-button size-2 style-4 block" href="#">
                                <span class="button-wrapper">
                                    <span class="icon"><img src="{{ URL::to('img/icon-4.png') }}" alt="" /></span>
                                    <span class="text">google+</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="button-close"></div>
            </div>
        </div>

        <div class="popup-content" data-rel="3">
            <div class="layer-close"></div>
            <div class="popup-container size-2">
                <div class="popup-align">
                    <div class="row">
                        <div class="col-sm-6 col-xs-b30 col-sm-b0">

                            <div class="main-product-slider-wrapper swipers-couple-wrapper">
                                <div class="swiper-container swiper-control-top">
                                   <div class="swiper-button-prev hidden"></div>
                                   <div class="swiper-button-next hidden"></div>
                                   <div class="swiper-wrapper">
                                       <div class="swiper-slide">
                                            <div class="swiper-lazy-preloader"></div>
                                            <div class="product-big-preview-entry swiper-lazy" data-background="{{ URL::to('img/product-preview-4.jpg') }}"></div>
                                       </div>
                                       <div class="swiper-slide">
                                            <div class="swiper-lazy-preloader"></div>
                                            <div class="product-big-preview-entry swiper-lazy" data-background="{{ URL::to('img/product-preview-5.jpg') }}"></div>
                                       </div>
                                       <div class="swiper-slide">
                                            <div class="swiper-lazy-preloader"></div>
                                            <div class="product-big-preview-entry swiper-lazy" data-background="{{ URL::to('img/product-preview-6.jpg') }}"></div>
                                       </div>
                                       <div class="swiper-slide">
                                            <div class="swiper-lazy-preloader"></div>
                                            <div class="product-big-preview-entry swiper-lazy" data-background="{{ URL::to('img/product-preview-7.jpg') }}"></div>
                                       </div>
                                       <div class="swiper-slide">
                                            <div class="swiper-lazy-preloader"></div>
                                            <div class="product-big-preview-entry swiper-lazy" data-background="{{ URL::to('img/product-preview-8.jpg') }}"></div>
                                       </div>
                                       <div class="swiper-slide">
                                            <div class="swiper-lazy-preloader"></div>
                                            <div class="product-big-preview-entry swiper-lazy" data-background="{{ URL::to('img/product-preview-9.jpg') }}"></div>
                                       </div>
                                       <div class="swiper-slide">
                                            <div class="swiper-lazy-preloader"></div>
                                            <div class="product-big-preview-entry swiper-lazy" data-background="{{ URL::to('img/product-preview-10.jpg') }}"></div>
                                       </div>
                                   </div>
                                </div>

                                <div class="empty-space col-xs-b30 col-sm-b60"></div>

                                <div class="swiper-container swiper-control-bottom" data-breakpoints="1" data-xs-slides="3" data-sm-slides="3" data-md-slides="4" data-lt-slides="5" data-slides-per-view="5" data-center="1" data-click="1">
                                   <div class="swiper-button-prev hidden"></div>
                                   <div class="swiper-button-next hidden"></div>
                                   <div class="swiper-wrapper">
                                       <div class="swiper-slide">
                                            <div class="product-small-preview-entry">
                                                <img src="{{ URL::to('img/product-preview-4_.jpg') }}" alt="" />
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="product-small-preview-entry">
                                                <img src="{{ URL::to('img/product-preview-5_.jpg') }}" alt="" />
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="product-small-preview-entry">
                                                <img src="{{ URL::to('img/product-preview-6_.jpg') }}" alt="" />
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="product-small-preview-entry">
                                                <img src="{{ URL::to('img/product-preview-7_.jpg') }}" alt="" />
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="product-small-preview-entry">
                                                <img src="{{ URL::to('img/product-preview-8_.jpg') }}" alt="" />
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="product-small-preview-entry">
                                                <img src="{{ URL::to('img/product-preview-9_.jpg') }}" alt="" />
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="product-small-preview-entry">
                                                <img src="{{ URL::to('img/product-preview-10_.jpg') }}" alt="" />
                                            </div>
                                       </div>

                                   </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="simple-article size-3 grey col-xs-b5">SMART WATCHES</div>
                            <div class="h3 col-xs-b25">watch 42mm smartwatch</div>
                            <div class="row col-xs-b25">
                                <div class="col-sm-6">
                                    <div class="simple-article size-5 grey">PRICE: <span class="color">$225.00</span></div>
                                </div>
                                <div class="col-sm-6 col-sm-text-right">
                                    <div class="rate-wrapper align-inline">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    </div>
                                    <div class="simple-article size-2 align-inline">128 Reviews</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="simple-article size-3 col-xs-b5">ITEM NO.: <span class="grey">127-#5238</span></div>
                                </div>
                                <div class="col-sm-6 col-sm-text-right">
                                    <div class="simple-article size-3 col-xs-b20">AVAILABLE.: <span class="grey">YES</span></div>
                                </div>
                            </div>
                            <div class="simple-article size-3 col-xs-b30">Vivamus in tempor eros. Phasellus rhoncus in nunc sit amet mattis. Integer in ipsum vestibulum, molestie arcu ac, efficitur tellus. Phasellus id vulputate erat.</div>
                            <div class="row col-xs-b40">
                                <div class="col-sm-3">
                                    <div class="h6 detail-data-title size-1">size:</div>
                                </div>
                                <div class="col-sm-9">
                                    <select class="SlectBox">
                                        <option disabled="disabled" selected="selected">Choose size</option>
                                        <option value="volvo">Volvo</option>
                                        <option value="saab">Saab</option>
                                        <option value="mercedes">Mercedes</option>
                                        <option value="audi">Audi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row col-xs-b40">
                                <div class="col-sm-3">
                                    <div class="h6 detail-data-title">color:</div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="color-selection size-1">
                                        <div class="entry active" style="color: #a7f050;"></div>
                                        <div class="entry" style="color: #50e3f0;"></div>
                                        <div class="entry" style="color: #eee;"></div>
                                        <div class="entry" style="color: #4d900c;"></div>
                                        <div class="entry" style="color: #edb82c;"></div>
                                        <div class="entry" style="color: #7d3f99;"></div>
                                        <div class="entry" style="color: #3481c7;"></div>
                                        <div class="entry" style="color: #bf584b;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row col-xs-b40">
                                <div class="col-sm-3">
                                    <div class="h6 detail-data-title size-1">quantity:</div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="quantity-select">
                                        <span class="minus"></span>
                                        <span class="number">1</span>
                                        <span class="plus"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row m5 col-xs-b40">
                                <div class="col-sm-6 col-xs-b10 col-sm-b0">
                                    <a class="button size-2 style-2 block" href="#">
                                        <span class="button-wrapper">
                                            <span class="icon"><img src="img/icon-2.png" alt=""></span>
                                            <span class="text">add to cart</span>
                                        </span>
                                    </a>
                                </div>
                                <div class="col-sm-6">
                                    <a class="button size-2 style-1 block noshadow" href="#">
                                    <span class="button-wrapper">
                                        <span class="icon"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                                        <span class="text">add to favourites</span>
                                    </span>
                                </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="h6 detail-data-title size-2">share:</div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="follow light">
                                        <a class="entry" href="#"><i class="fa fa-facebook"></i></a>
                                        <a class="entry" href="#"><i class="fa fa-twitter"></i></a>
                                        <a class="entry" href="#"><i class="fa fa-linkedin"></i></a>
                                        <a class="entry" href="#"><i class="fa fa-google-plus"></i></a>
                                        <a class="entry" href="#"><i class="fa fa-pinterest-p"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="button-close"></div>
            </div>
        </div>

    </div>

    <script src="{{ URL::to('js/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ URL::to('js/swiper.jquery.min.js') }}"></script>
    <script src="{{ URL::to('js/global.js') }}"></script>

    <!-- styled select -->
    <script src="{{ URL::to('js/jquery.sumoselect.min.js') }}"></script>

    <!-- counter -->
    <script src="{{ URL::to('js/jquery.classycountdown.js') }}"></script>
    <script src="{{ URL::to('js/jquery.knob.js') }}"></script>
    <script src="{{ URL::to('js/jquery.throttle.js') }}"></script>

    @stack("scripts")

</body>
</html>
