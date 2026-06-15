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
                                            <a href="./">Home</a>
                                        </li>
                                        <li>
                                            <a href="#">Features</a>
                                        </li>
                                        <li>
                                            <a href="#">Recipes</a>
                                        </li>
                                        <li>
                                            <a href="#">Planner</a>
                                        </li>
                                        <li>
                                            <a href="#">Reviews</a>
                                        </li>
                                        <li>
                                            <a class="" href="#">Contact</a>
                                        </li>
                                        <li>
                                            <a class="header-btn-1" href="#">Login</a>
                                        </li>
                                        <li>
                                            <a class="header-btn-2" href="#">Get Started</a>
                                        </li>
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

        <div class="header-empty-space"></div>
        <!-- Banner Area -->
        <div class="slider-wrapper">
            <div class="swiper-container" data-parallax="1" data-auto-height="1">
               <div class="swiper-wrapper">
                   <div class="swiper-slide" style="background-image: url({{ URL::to('img/web-img/banner-2.png') }});">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="cell-view page-height">
                                        <div class="col-xs-b40 col-sm-b80"></div>
                                        <div data-swiper-parallax-x="-600">
                                            <div class="simple-article banner-sub-heading coolvetica-font transparent size-3">Welcome To Food4Fork</div>
                                            <div class="col-xs-b5"></div>
                                        </div>
                                        <div data-swiper-parallax-x="-500">
                                            <h1 class="h1 text-dark coolvetica-font banner-heading">Bring More <span class="gradient-text-1">Flavour</span> to every week</h1>
                                            <div class="col-xs-b10 col-sm-b10"></div>
                                        </div>
                                        <div data-swiper-parallax-x="-400">
                                            <div class="simple-article size-4 transparent">
                                                <p class="manrope-font text-dark">Food4Fork turns recipe inspiration into a beautiful weekly routine. Save dishes you love, build a colorful meal plan, and generate one tidy grocery list in seconds.</p>
                                            </div>
                                            <div class="col-xs-b30"></div>
                                        </div>
                                        <div data-swiper-parallax-x="-300">
                                            <div class="buttons-wrapper">
                                                <a class="button size-2 style-3" href="#">
                                                    <span class="button-wrapper">
                                                        <span class="icon"><img src="img/icon-4.png" alt=""></span>
                                                        <span class="text coolvetica-font">Start Free</span>
                                                    </span>
                                                </a>
                                                <a class="button size-2 style-2" href="#">
                                                    <span class="button-wrapper">
                                                        <span class="icon"><img src="img/icon-1.png" alt=""></span>
                                                        <span class="text coolvetica-font">Browse Recipes</span>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-xs-b40 col-sm-b80"></div>
                                    </div>
                                    <img src="./img/web-img/banner-leafs.png" class="banner-leafs img-fluid" alt="" />
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{ URL::to('img/web-img/banner-img-1.png') }}" class="img-fluid" alt="" />
                                </div>
                            </div>
                            <div class="empty-space col-xs-b80 col-sm-b0"></div>
                        </div>
                   </div>
                   <div class="swiper-slide" style="background-image: url({{ URL::to('img/web-img/banner-2.png') }});">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="cell-view page-height">
                                        <div class="col-xs-b40 col-sm-b80"></div>
                                        <div data-swiper-parallax-x="-600">
                                            <div class="simple-article banner-sub-heading coolvetica-font transparent size-3">Welcome To Food4Fork</div>
                                            <div class="col-xs-b5"></div>
                                        </div>
                                        <div data-swiper-parallax-x="-500">
                                            <h1 class="h1 text-dark coolvetica-font banner-heading">Bring More <span class="gradient-text-1">Flavour</span> to every week</h1>
                                            <div class="col-xs-b10 col-sm-b10"></div>
                                        </div>
                                        <div data-swiper-parallax-x="-400">
                                            <div class="simple-article size-4 transparent">
                                                <p class="manrope-font text-dark">In feugiat molestie tortor a malesuada. Etiam a venenatis ipsum. Proin pharetra elit at feugiat commodo vel placerat tincidunt sapien nec</p>
                                            </div>
                                            <div class="col-xs-b30"></div>
                                        </div>
                                        <div data-swiper-parallax-x="-300">
                                            <div class="buttons-wrapper">
                                                <a class="button size-2 style-1" href="#">
                                                    <span class="button-wrapper">
                                                        <span class="icon"><img src="{{ URL::to('img/icon-1.png') }}" alt=""></span>
                                                        <span class="text">Learn More</span>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-xs-b40 col-sm-b80"></div>
                                    </div>
                                    <img src="{{ URL::to('img/web-img/banner-leafs.png') }}" class="banner-leafs img-fluid" alt="" />
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{ URL::to('img/web-img/banner-img-1.png') }}" class="img-fluid" alt="" />
                                </div>
                            </div>
                            <div class="empty-space col-xs-b80 col-sm-b0"></div>
                        </div>
                   </div>
               </div>
               <div class="swiper-pagination swiper-pagination-white"></div>
            </div>
        </div>

        <div class="empty-space col-xs-b35 col-md-b70"></div>

        <!-- Why People Love It -->
        <div class="container">
            <div class="row vertical-aligned-columns">
                <div class="col-md-6">
                    <div class="simple-article uppercase banner-sub-heading col-sm-b20 coolvetica-font transparent size-3">Why people love it</div>
                    <h1 class="h1 text-semi-dark coolvetica-font sub-heading ">Designed to  <span class="gradient-text-1">feel fresh,</span> simple, and motivating.</h1>
                </div>
                <div class="col-md-5 col-md-offset-1">
                    <div class="simple-article size-4 transparent">
                        <p class="manrope-font text-dark">In feugiat molestie tortor a malesuada. Etiam a venenatis ipsum. Proin pharetra elit at feugiat commodo vel placerat tincidunt sapien nec</p>
                    </div>
                </div>
            </div>
            <div class="empty-space col-xs-b35 col-md-b50"></div>
            <div class="row vertical-aligned-columns">
                <div class="col-md-4">
                    <div class="card card-design-1">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <img src="./img/web-img/icon-1.png" alt="">
                                <div class="simple-article size-3">
                                    <h4 class="coolvetica-font lowercase mb-3">Smart grocery lists</h4>
                                    <p class="manrope-font">Map out your week in minutes and spot busy nights before they become stressful.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-design-1">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <img src="{{ URL::to('img/web-img/icon-2.png') }}" alt="">
                                <div class="simple-article size-3">
                                    <h4 class="coolvetica-font lowercase mb-3">Recipe discovery</h4>
                                    <p class="manrope-font">Find vibrant breakfast, lunch, dinner, and snack ideas with rich food photography and quick filters.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-design-1">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <img src="{{ URL::to('img/web-img/icon-3.png') }}" alt="">
                                <div class="simple-article size-3">
                                    <h4 class="coolvetica-font lowercase mb-3">Drag & drop planning</h4>
                                    <p class="manrope-font">Ingredients are combined automatically so your shop is cleaner, quicker, and easier to follow.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="empty-space col-xs-b35 col-md-b70"></div>

        <!-- Ideas Section -->
        <div class="bg-lemon">

            <div class="empty-space col-xs-b35 col-md-b70"></div>

            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3 text-center">
                        <div class="simple-article uppercase banner-sub-heading col-sm-b20 coolvetica-font transparent size-3">Popular recipes</div>
                        <h1 class="h1 text-dark coolvetica-font sub-heading ">Fresh  <span class="gradient-text-1">ideas </span> for every part of the day.</h1>
                    </div>
                </div>
                <div class="empty-space col-xs-b35 col-md-b50"></div>
                <!-- Card Area of Recipies -->
                <div class="row vertical-aligned-columns">
                    <div class="col-md-4">
                        <div class="card card-design-2">
                            <div class="card-header">
                                <img src="{{ URL::to('img/web-img/recipie-1.png') }}" class="img-fluid" alt="">
                            </div>
                            <div class="card-body">
                                <div class="row vertical-aligned-columns">
                                    <div class="col-md-6 mb-3">
                                        <div class="badges coolvetica-font">Lunch</div>
                                    </div>
                                    <div class="col-md-6 col-lg-text-right mb-3">
                                        <div class="simple-article size-4 letter-sp-1">
                                            <p class="text-dark coolvetica-font"><i class="fa fa-star"></i> 4.9 Reviews</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="simple-article size-3">
                                            <h3 class="coolvetica-font lowercase mb-3">Mediterranean Chickpea Bowl</h3>
                                            <p class="manrope-font">Chickpeas, cucumber, tomato, herbs, grains, and a bright lemon dressing.</p>
                                            <a href="" class="text-dark coolvetica-font text-underline">View Recipe</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-design-2">
                            <div class="card-header">
                                <img src="{{ URL::to('img/web-img/recipie-2.png') }}" class="img-fluid" alt="">
                            </div>
                            <div class="card-body">
                                <div class="row vertical-aligned-columns">
                                    <div class="col-md-6 mb-3">
                                        <div class="badges coolvetica-font">Dinner</div>
                                    </div>
                                    <div class="col-md-6 col-lg-text-right mb-3">
                                        <div class="simple-article size-4 letter-sp-1">
                                            <p class="text-dark coolvetica-font"><i class="fa fa-star"></i> 4.9 Reviews</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="simple-article size-3">
                                            <h3 class="coolvetica-font lowercase mb-3">Creamy Tomato Pasta</h3>
                                            <p class="manrope-font">Chickpeas, cucumber, tomato, herbs, grains, and a bright lemon dressing.</p>
                                            <a href="" class="text-dark coolvetica-font text-underline">View Recipe</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-design-2">
                            <div class="card-header">
                                <img src="{{ URL::to('img/web-img/recipie-3.png') }}" class="img-fluid" alt="">
                            </div>
                            <div class="card-body">
                                <div class="row vertical-aligned-columns">
                                    <div class="col-md-6 mb-3">
                                        <div class="badges coolvetica-font">Breakfast</div>
                                    </div>
                                    <div class="col-md-6 col-lg-text-right mb-3">
                                        <div class="simple-article size-4 letter-sp-1">
                                            <p class="text-dark coolvetica-font"><i class="fa fa-star"></i> 4.9 Reviews</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="simple-article size-3">
                                            <h3 class="coolvetica-font lowercase mb-3">Berry Oat Pancakes</h3>
                                            <p class="manrope-font">Chickpeas, cucumber, tomato, herbs, grains, and a bright lemon dressing.</p>
                                            <a href="" class="text-dark coolvetica-font text-underline">View Recipe</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-design-3" style="background:linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ URL::to('img/web-img/recipie-4.png') }}');">
                            <div class="card-body">
                                <div class="simple-article size-4">
                                    <div class="h2 light coolvetica-font letter-sp-1 lowercase sub-heading col-md-b10">Rainbow dinner <br> spread</div>
                                    <p class="manrope-font text-white">A more image-led design makes the page feel tastier and more modern.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-design-2">
                            <div class="card-header">
                                <img src="./img/web-img/recipie-5.png" class="img-fluid" alt="">
                            </div>
                            <div class="card-body">
                                <div class="row vertical-aligned-columns">
                                    <div class="col-md-6 mb-3">
                                        <div class="badges coolvetica-font">Fresh & ligh</div>
                                    </div>
                                    <div class="col-md-6 col-lg-text-right mb-3">
                                        <div class="simple-article size-4 letter-sp-1">
                                            <p class="text-dark coolvetica-font"><i class="fa fa-star"></i> 4.9 Reviews</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="simple-article size-3">
                                            <h3 class="coolvetica-font lowercase mb-3">Citrus Crunch Salad</h3>
                                            <p class="manrope-font">Chickpeas, cucumber, tomato, herbs, grains, and a bright lemon dressing.</p>
                                            <a href="" class="text-dark coolvetica-font text-underline">View Recipe</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="empty-space col-xs-b35 col-md-b70"></div>

        </div>

        <div class="empty-space col-xs-b35 col-md-b70"></div>

        <!-- Weekly Planning -->
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="simple-article uppercase banner-sub-heading col-sm-b20 coolvetica-font transparent size-3">Weekly planning</div>
                    <h1 class="h1 text-dark coolvetica-font sub-heading ">See the  <span class="gradient-text-2">week </span> at a glance.</h1>
                <div class="empty-space col-xs-b15 col-md-b30"></div>
                </div>
                <div class="col-md-12">
                    <div class="simple-article size-3">
                        <div class="table-responsive">
                            <table class="table chart-table">
                                <thead>
                                    <tr>
                                        <th class="coolvetica-font h5 fw-100 letter-sp-1"><i class="fa fa-calendar"></i> &nbsp; DAY</th>
                                        <th class="coolvetica-font h5 fw-100 letter-sp-1"><i class="fa fa-sun-o"></i> &nbsp; BREAKFAST</th>
                                        <th class="coolvetica-font h5 fw-100 letter-sp-1"><i class="fa fa-cutlery"></i> &nbsp; LUNCH</th>
                                        <th class="coolvetica-font h5 fw-100 letter-sp-1"><i class="fa fa-moon-o"></i> &nbsp; DINNER</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="coolvetica-font h5 fw-100 letter-sp-1"><i class="fa fa-calendar"></i> &nbsp; MONDAY</td>
                                        <td class="coolvetica-font h5 fw-100 letter-sp-1">
                                            <div class="d-flex vertical-aligned-columns align-items-center justify-content-center">
                                                <img src="{{ URL::to('img/web-img/recipie-2.png') }}" class="chart-table-img" alt=""> &nbsp; &nbsp; <p>Creamy Tomato <br> Pasta</p>
                                            </div>
                                        </td>
                                        <td class="coolvetica-font h5 fw-100 letter-sp-1">
                                            <div class="d-flex vertical-aligned-columns align-items-center justify-content-center">
                                                <img src="{{ URL::to('img/web-img/recipie-3.png') }}" class="chart-table-img" alt=""> &nbsp; &nbsp; <p>Berry Oat  <br> Pancakes</p>
                                            </div>
                                        </td>
                                        <td class="coolvetica-font h5 fw-100 letter-sp-1">
                                            <div class="d-flex vertical-aligned-columns align-items-center justify-content-center">
                                                <img src="{{ URL::to('img/web-img/recipie-5.png') }}" class="chart-table-img" alt=""> &nbsp; &nbsp; <p>Citrus Crunch <br> Salad</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="coolvetica-font h5 fw-100 letter-sp-1"><i class="fa fa-calendar"></i> &nbsp; TUESDAY</td>
                                        <td class="coolvetica-font h5 fw-100 letter-sp-1">
                                            <div class="d-flex vertical-aligned-columns align-items-center justify-content-center">
                                                <img src="{{ URL::to('img/web-img/recipie-2.png') }}" class="chart-table-img" alt=""> &nbsp; &nbsp; <p>Creamy Tomato <br> Pasta</p>
                                            </div>
                                        </td>
                                        <td class="coolvetica-font h5 fw-100 letter-sp-1">
                                            <div class="d-flex vertical-aligned-columns align-items-center justify-content-center">
                                                <img src="{{ URL::to('img/web-img/recipie-3.png') }}" class="chart-table-img" alt=""> &nbsp; &nbsp; <p>Berry Oat  <br> Pancakes</p>
                                            </div>
                                        </td>
                                        <td class="coolvetica-font h5 fw-100 letter-sp-1">
                                            <div class="d-flex vertical-aligned-columns align-items-center justify-content-center">
                                                <img src="{{ URL::to('img/web-img/recipie-5.png') }}" class="chart-table-img" alt=""> &nbsp; &nbsp; <p>Citrus Crunch <br> Salad</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="coolvetica-font h5 fw-100 letter-sp-1"><i class="fa fa-calendar"></i> &nbsp; WEDNESDAY</td>
                                        <td class="coolvetica-font h5 fw-100 letter-sp-1">
                                            <div class="d-flex vertical-aligned-columns align-items-center justify-content-center">
                                                <img src="{{ URL::to('img/web-img/recipie-2.png') }}" class="chart-table-img" alt=""> &nbsp; &nbsp; <p>Creamy Tomato <br> Pasta</p>
                                            </div>
                                        </td>
                                        <td class="coolvetica-font h5 fw-100 letter-sp-1">
                                            <div class="d-flex vertical-aligned-columns align-items-center justify-content-center">
                                                <img src="{{ URL::to('img/web-img/recipie-3.png') }}" class="chart-table-img" alt=""> &nbsp; &nbsp; <p>Berry Oat  <br> Pancakes</p>
                                            </div>
                                        </td>
                                        <td class="coolvetica-font h5 fw-100 letter-sp-1">
                                            <div class="d-flex vertical-aligned-columns align-items-center justify-content-center">
                                                <img src="{{ URL::to('img/web-img/recipie-5.png') }}" class="chart-table-img" alt=""> &nbsp; &nbsp; <p>Citrus Crunch <br> Salad</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="coolvetica-font h5 fw-100 letter-sp-1"><i class="fa fa-calendar"></i> &nbsp; THURSDAY</td>
                                        <td class="coolvetica-font h5 fw-100 letter-sp-1">
                                            <div class="d-flex vertical-aligned-columns align-items-center justify-content-center">
                                                <img src="{{ URL::to('img/web-img/recipie-2.png') }}" class="chart-table-img" alt=""> &nbsp; &nbsp; <p>Creamy Tomato <br> Pasta</p>
                                            </div>
                                        </td>
                                        <td class="coolvetica-font h5 fw-100 letter-sp-1">
                                            <div class="d-flex vertical-aligned-columns align-items-center justify-content-center">
                                                <img src="{{ URL::to('img/web-img/recipie-3.png') }}" class="chart-table-img" alt=""> &nbsp; &nbsp; <p>Berry Oat  <br> Pancakes</p>
                                            </div>
                                        </td>
                                        <td class="coolvetica-font h5 fw-100 letter-sp-1">
                                            <div class="d-flex vertical-aligned-columns align-items-center justify-content-center">
                                                <img src="{{ URL::to('img/web-img/recipie-5.png') }}" class="chart-table-img" alt=""> &nbsp; &nbsp; <p>Citrus Crunch <br> Salad</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="coolvetica-font h5 fw-100 letter-sp-1"><i class="fa fa-calendar"></i> &nbsp; FRIDAY</td>
                                        <td class="coolvetica-font h5 fw-100 letter-sp-1">
                                            <div class="d-flex vertical-aligned-columns align-items-center justify-content-center">
                                                <img src="{{ URL::to('img/web-img/recipie-2.png') }}" class="chart-table-img" alt=""> &nbsp; &nbsp; <p>Creamy Tomato <br> Pasta</p>
                                            </div>
                                        </td>
                                        <td class="coolvetica-font h5 fw-100 letter-sp-1">
                                            <div class="d-flex vertical-aligned-columns align-items-center justify-content-center">
                                                <img src="{{ URL::to('img/web-img/recipie-3.png') }}" class="chart-table-img" alt=""> &nbsp; &nbsp; <p>Berry Oat  <br> Pancakes</p>
                                            </div>
                                        </td>
                                        <td class="coolvetica-font h5 fw-100 letter-sp-1">
                                            <div class="d-flex vertical-aligned-columns align-items-center justify-content-center">
                                                <img src="{{ URL::to('img/web-img/recipie-5.png') }}" class="chart-table-img" alt=""> &nbsp; &nbsp; <p>Citrus Crunch <br> Salad</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="coolvetica-font h5 fw-100 letter-sp-1"><i class="fa fa-calendar"></i> &nbsp; SATURDAY</td>
                                        <td class="coolvetica-font h5 fw-100 letter-sp-1">
                                            <div class="d-flex vertical-aligned-columns align-items-center justify-content-center">
                                                <img src="{{ URL::to('img/web-img/recipie-2.png') }}" class="chart-table-img" alt=""> &nbsp; &nbsp; <p>Creamy Tomato <br> Pasta</p>
                                            </div>
                                        </td>
                                        <td class="coolvetica-font h5 fw-100 letter-sp-1">
                                            <div class="d-flex vertical-aligned-columns align-items-center justify-content-center">
                                                <img src="{{ URL::to('img/web-img/recipie-3.png') }}" class="chart-table-img" alt=""> &nbsp; &nbsp; <p>Berry Oat  <br> Pancakes</p>
                                            </div>
                                        </td>
                                        <td class="coolvetica-font h5 fw-100 letter-sp-1">
                                            <div class="d-flex vertical-aligned-columns align-items-center justify-content-center">
                                                <img src="{{ URL::to('img/web-img/recipie-5.png') }}" class="chart-table-img" alt=""> &nbsp; &nbsp; <p>Citrus Crunch <br> Salad</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="coolvetica-font h5 fw-100 letter-sp-1"><i class="fa fa-calendar"></i> &nbsp; SUNDAY</td>
                                        <td class="coolvetica-font h5 fw-100 letter-sp-1">
                                            <div class="d-flex vertical-aligned-columns align-items-center justify-content-center">
                                                <img src="{{ URL::to('img/web-img/recipie-2.png') }}" class="chart-table-img" alt=""> &nbsp; &nbsp; <p>Creamy Tomato <br> Pasta</p>
                                            </div>
                                        </td>
                                        <td class="coolvetica-font h5 fw-100 letter-sp-1">
                                            <div class="d-flex vertical-aligned-columns align-items-center justify-content-center">
                                                <img src="{{ URL::to('img/web-img/recipie-3.png') }}" class="chart-table-img" alt=""> &nbsp; &nbsp; <p>Berry Oat  <br> Pancakes</p>
                                            </div>
                                        </td>
                                        <td class="coolvetica-font h5 fw-100 letter-sp-1">
                                            <div class="d-flex vertical-aligned-columns align-items-center justify-content-center">
                                                <img src="{{ URL::to('img/web-img/recipie-5.png') }}" class="chart-table-img" alt=""> &nbsp; &nbsp; <p>Citrus Crunch <br> Salad</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="empty-space col-xs-b35 col-md-b70"></div>

        <!-- Built for real -->
        <div class="block-entry" style="background-image: url({{ URL::to('img/web-img/insperation-bg.png') }});">
            <div class="container">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="cell-view simple-banner-height simple-article size-3 text-center">
                            <div class="empty-space col-xs-b35 col-sm-b50"></div>
                            <div class="empty-space col-xs-b35 col-sm-b50"></div>
                            <h3 class="text-white coolvetica-font letter-sp-1 lowercase">Built for real routines</h3>
                            <h1 class="text-white coolvetica-font lowercase letter-sp-1">From  <span class="gradient-text-1">inspiration </span> to checkout, without the mess. </h1>
                            <div class="simple-article manrope-font light size-4 col-xs-b20">Food4Fork helps busy households turn scattered meal ideas into one organized plan. Save recipes,<br> build a balanced week, and walk into the store already prepared.</div>
                            <div class="empty-space col-xs-b35 col-sm-b50"></div>
                            <div class="empty-space col-xs-b35 col-sm-b50"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="empty-space col-xs-b35 col-md-b70"></div>

        <!-- Testimonials -->
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center col-sm-b30">
                    <div class="simple-article uppercase banner-sub-heading col-sm-b20 coolvetica-font transparent size-3">Happy cooks</div>
                    <h1 class="h1 text-semi-dark coolvetica-font sub-heading ">A friendlier   <span class="gradient-text-2">brand feel </span> from top to bottom.</h1>
                </div>
                <div class="col-md-12 simple-articel size-3">
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{ URL::to('img/web-img/happy-customer.png') }}" class="img-fluid" alt="">
                        <div class="ml-3">
                            <h5 class="h4 coolvetica-font lowercase letter-sp-1">Our Happy Customer</h5>
                            <p class="coolvetica-font simple-article size-4 letter-sp-1"><i class="fa fa-star yellow-text"></i> 4.5 (12K + Review)</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="empty-space col-xs-b35 col-md-b50"></div>

            <div class="slider-wrapper hidden-pixel-y">
                <div class="swiper-button-prev hidden"></div>
                <div class="swiper-button-next hidden"></div>
                <div class="swiper-container testimonial-slider" data-breakpoints="1" data-xs-slides="1" data-sm-slides="1" data-md-slides="1" data-lt-slides="3"  data-slides-per-view="3" data-centered-slides="true">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="col-md-12">
                                <div class="card card-design-4">
                                    <div class="card-body">
                                        <p class="manrope-font text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard of type and scrambled it to make a type specimen book.</p>
                                        <div class="d-flex align-items-center justify-content-between">
                                        <!-- <div class="row vertical-aligned-columns"> -->
                                            <div class="">
                                                <div class="d-flex align-items-center">
                                                    <img class="profile-img" src="./img/web-img/testimonial-1.png" alt="">
                                                    <div class="simple-article size-3 ml-3">
                                                        <div class="coolvetica-font lowercase name">Amelia</div>
                                                        <p class="manrope-font title">Home Cook</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="">
                                                <img src="{{ URL::to('img/web-img/Icon-4.png') }}" class="img-fluid" alt="" srcset="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="col-md-12">
                                <div class="card card-design-4">
                                    <div class="card-body">
                                        <p class="manrope-font text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard of type and scrambled it to make a type specimen book.</p>
                                        <div class="d-flex align-items-center justify-content-between">
                                        <!-- <div class="row vertical-aligned-columns"> -->
                                            <div class="">
                                                <div class="d-flex align-items-center">
                                                    <img class="profile-img" src="{{ URL::to('img/web-img/testimonial-1.png') }}" alt="">
                                                    <div class="simple-article size-3 ml-3">
                                                        <div class="coolvetica-font lowercase name">Amelia</div>
                                                        <p class="manrope-font title">Home Cook</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="">
                                                <img src="{{ URL::to('img/web-img/Icon-4.png') }}" class="img-fluid" alt="" srcset="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="col-md-12">
                                <div class="card card-design-4">
                                    <div class="card-body">
                                        <p class="manrope-font text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard of type and scrambled it to make a type specimen book.</p>
                                        <div class="d-flex align-items-center justify-content-between">
                                        <!-- <div class="row vertical-aligned-columns"> -->
                                            <div class="">
                                                <div class="d-flex align-items-center">
                                                    <img class="profile-img" src="{{ URL::to('img/web-img/testimonial-1.png') }}" alt="">
                                                    <div class="simple-article size-3 ml-3">
                                                        <div class="coolvetica-font lowercase name">Amelia</div>
                                                        <p class="manrope-font title">Home Cook</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="">
                                                <img src="{{ URL::to('img/web-img/Icon-4.png') }}" class="img-fluid" alt="" srcset="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination relative-pagination"></div>
                </div>
            </div>
        </div>

        <div class="empty-space col-xs-b35 col-md-b70"></div>

        <!-- Ready to launch -->
        <div class="block-entry">
            <div class="container">
                <div class="launch-card">
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1">
                            <div class="cell-view  simple-article size-3 text-center">
                                <div class="empty-space col-xs-b40 col-sm-b50"></div>
                                <h3 class="text-white coolvetica-font letter-sp-1 lowercase">Ready to launch</h3>
                                <h1 class="text-white coolvetica-font lowercase letter-sp-1 sub-heading  col-sm-b30">A brighter <span class="gradient-text-1"> Food4Fork, </span> ready <br> for your next step.</h1>
                                <div class="simple-article manrope-font light size-4 ">This version keeps your single-file setup but gives it a much stronger visual identity, with <br> more color, more imagery, and a more polished landing-page structure.</div>
                                <div class="empty-space col-sm-b10"></div>
                                <div class="buttons-wrapper">
                                    <a class="button size-2 style-3" href="#">
                                        <span class="button-wrapper">
                                            <span class="icon"><img src="{{ URL::to('img/icon-4.png') }}" alt=""></span>
                                            <span class="text coolvetica-font">Contact</span>
                                        </span>
                                    </a>
                                    <a class="button size-2 style-1" href="#">
                                        <span class="button-wrapper">
                                            <span class="icon"><img src="{{ URL::to('img/icon-1.png') }}" alt=""></span>
                                            <span class="text coolvetica-font">See all Feature</span>
                                        </span>
                                    </a>
                                </div>
                                <div class="empty-space col-xs-b40 col-sm-b70"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="empty-space col-xs-b35 col-md-b70"></div>

        <!-- FOOTER -->
        <footer>
            <div class="container">
                <div class="footer-top">
                    <div class="row">
                        <div class="col-xs-6 col-md-3 col-xs-b30 col-md-b0">
                            <img src="img/web-img/logo-footer.png" height="50" alt="" />
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
                                    <a href="#">Home</a>
                                    <a href="#">Features</a>
                                    <a href="#">Recipes</a>
                                    <a href="#">Planner</a>
                                    <a href="#">Reviews</a>
                                    <a href="#">Contact</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-2 col-xs-b30 col-md-b0">
                            <h4 class="h4 text-dark coolvetica-font lowercase letter-sp-1">Connect with us</h4>
                            <div class="empty-space col-xs-b20"></div>
                            <div class="footer-column-links">
                                <div class="">
                                    <a href="#">Why Food4Fork</a>
                                    <a href="#">Partner With Us</a>
                                    <a href="#">FAQ</a>
                                    <a href="#">Blog</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-2 col-xs-b30 col-md-b0">
                            <h4 class="h4 text-dark coolvetica-font lowercase letter-sp-1">Support</h4>
                            <div class="empty-space col-xs-b20"></div>
                            <div class="footer-column-links">
                                <div class="">
                                    <a href="#">Account</a>
                                    <a href="#">Terms & Conditions</a>
                                    <a href="#">Feedback</a>
                                    <a href="#">Contact Us</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-2 col-xs-b30 col-md-b0">
                            <h4 class="h4 text-dark coolvetica-font lowercase letter-sp-1">Get in Touch</h4>
                            <div class="empty-space col-xs-b20"></div>
                            <div class="footer-column-links">
                                <div class="">
                                    <a href="#">Question or feedback? We’d love to hear from you</a>
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

</body>
</html>
