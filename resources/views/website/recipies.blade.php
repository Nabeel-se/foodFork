@extends('layouts.website', [
    'title' => 'FoodFork - Dashboard',
    'active' => 'dashboard',
    'showSearch' => true,
])
@section('content')
    <div class="header-empty-space"></div>

    <div class="block-entry fixed-background" style="background-image: url(img/web-img/recipie-4.png);">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="cell-view simple-banner-height text-center">
                        <div class="empty-space col-xs-b35 col-sm-b70"></div>
                        <h1 class="h1 text-white coolvetica-font lowercase letter-sp-1">Our <span class="gradient-text-1">Recipes</span></h1>
                        <div class="title-underline center"><span></span></div>
                        <div class="simple-article manrope-font light size-4 col-xs-b20">In feugiat molestie tortor a malesuada. Etiam a venenatis ipsum. Proin pharetra elit at feugiat commodo vel placerat tincidunt sapien nec</div>
                        <div class="empty-space col-xs-b35 col-sm-b70"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ideas Section -->
    <div class="bg-lemon">

        <div class="empty-space col-xs-b35 col-md-b70"></div>

        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <div class="simple-article uppercase banner-sub-heading col-sm-b20 coolvetica-font transparent size-3 letter-sp-1">Popular recipes</div>
                    <h1 class="h1 text-dark coolvetica-font sub-heading ">Fresh  <span class="gradient-text-2">ideas </span> for every part of the day.</h1>
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
                                    <div class="badges coolvetica-font">Fresh & light</div>
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
@endsection

@push('styles')

@endpush

@push("scripts")

@endpush
