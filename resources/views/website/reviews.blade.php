@extends('layouts.website', [
    'title' => 'FoodFork - Dashboard',
    'active' => 'dashboard',
    'showSearch' => true,
])
@section('content')

    <div class="empty-space col-xs-b35 col-md-b70"></div>
    <div class="empty-space col-xs-b35 col-md-b70"></div>
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

@endsection

@push('styles')

@endpush

@push("scripts")

@endpush
