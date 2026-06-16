@extends('layouts.website', [
    'title' => 'FoodFork - Dashboard',
    'active' => 'dashboard',
    'showSearch' => true,
])
@section('content')

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
                                                <a class="button size-2 style-3" href="{{ route('login') }}">
                                                    <span class="button-wrapper">
                                                        <span class="icon"><img src="{{ URL::to('img/icon-4.png') }}" alt=""></span>
                                                        <span class="text coolvetica-font">Start Free</span>
                                                    </span>
                                                </a>
                                                <a class="button size-2 style-2" href="#">
                                                    <span class="button-wrapper">
                                                        <span class="icon"><img src="{{ URL::to('img/icon-1.png') }}" alt=""></span>
                                                        <span class="text coolvetica-font">Browse Recipes</span>
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

@endsection

@push('styles')

@endpush

@push("scripts")

@endpush
