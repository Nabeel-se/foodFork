@extends('layouts.website', [
    'title' => 'FoodFork - Contact',
    'active' => 'contact',
    'showSearch' => true,
])
@section('content')

    <div class="header-empty-space"></div>

    <div class="block-entry fixed-background" style="background-image: url(img/web-img/insperation-bg.png); background-size:cover; background-position:top center;">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="cell-view simple-banner-height text-center">
                        <div class="empty-space col-xs-b35 col-sm-b70"></div>
                        <h1 class="h1 light coolvetica-font sub-heading ">Contact <span class="gradient-text-1">Us</span></h1>
                        <div class="title-underline center light"><span></span></div>
                        <div class="simple-article manrope-font light size-4 col-xs-b20">In feugiat molestie tortor a malesuada. Etiam a venenatis ipsum. Proin pharetra elit at feugiat commodo vel placerat tincidunt sapien nec</div>
                        <div class="empty-space col-xs-b35 col-sm-b70"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="empty-space col-xs-b35 col-md-b70"></div>
    <div class="empty-space col-xs-b35 col-md-b70"></div>

    <div class="container">
        <div class="text-center">
            <div class="simple-article uppercase banner-sub-heading col-sm-b20 coolvetica-font transparent size-3 letter-sp-1">our contacts</div>
            <div class="h2 text-semi-dark coolvetica-font sub-heading">We Are Ready For Your <span class="gradient-text-2">Questions</span></div>
            <div class="title-underline center"><span></span></div>
        </div>
    </div>

    <div class="empty-space col-sm-b15 col-md-b50"></div>

    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="icon-description-shortcode style-1">
                    <h2 class="h2 gradient-text-1 col-sm-b15"><i class="fa fa-map-marker"></i></h2>
                    <div class="title h4 coolvetica-font letter-sp-1">address</div>
                    <div class="description simple-article size-4 manrope-font text-dark">London, United Kingdom</div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="icon-description-shortcode style-1">
                    <h2 class="h2 gradient-text-1 col-sm-b15"><i class="fa fa-phone"></i></h2>
                    <div class="title h4 coolvetica-font letter-sp-1">Phone</div>
                    <div class="description simple-article size-4 manrope-font text-dark"><a href="tel:+44 1234 5678">+44 1234 5678</a></div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="icon-description-shortcode style-1">
                    <h2 class="h2 gradient-text-1 col-sm-b15"><i class="fa fa-envelope"></i></h2>
                    <div class="title h4 coolvetica-font letter-sp-1">Email</div>
                    <div class="description simple-article size-4 manrope-font text-dark"><a href="mailto:support@foodfork.com">support@foodfork.com</a></div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="icon-description-shortcode style-1">
                    <h2 class="h2 gradient-text-1 col-sm-b15"><i class="fa fa-globe"></i></h2>
                    <div class="title h4 coolvetica-font letter-sp-1">Links</div>
                    <div class="description simple-article size-4 manrope-font text-dark d-flex justify-content-center">
                        <a class="entry mx-3" href="#"><i class="fa fa-facebook"></i></a>
                        <a class="entry mx-3" href="#"><i class="fa fa-instagram"></i></a>
                        <a class="entry mx-3" href="#"><i class="fa fa-youtube-play"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="empty-space col-xs-b15 col-sm-b20"></div>

    {{-- <div class="container">
        <div class="map-wrapper">
            <div id="map-canvas" class="full-width" data-lat="34.0151244" data-lng="-118.4729871" data-zoom="14"></div>
        </div>
        <div class="addresses-block hidden">
            <a class="marker" data-lat="34.0151244" data-lng="-118.4729871" data-string="1. Here is some address or email or phone or something else..."></a>
        </div>
    </div> --}}

    <div class="empty-space col-xs-b25 col-sm-b50"></div>

    <div class="container">
        {{-- <h4 class="h4 text-center col-xs-b25">have a questions?</h4> --}}
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form class="contact-form">
                    <div class="row m5">
                        <div class="col-sm-6">
                            <input class="simple-input col-xs-b20" type="text" value="" placeholder="Name" name="name" />
                        </div>
                        <div class="col-sm-6">
                            <input class="simple-input col-xs-b20" type="text" value="" placeholder="Email" name="email" />
                        </div>
                        <div class="col-sm-6">
                            <input class="simple-input col-xs-b20" type="text" value="" placeholder="Phone" name="phone" />
                        </div>
                        <div class="col-sm-6">
                            <input class="simple-input col-xs-b20" type="text" value="" placeholder="Subject" name="subject" />
                        </div>
                        <div class="col-sm-12">
                            <textarea class="simple-input col-xs-b20" placeholder="Your message" name="message"></textarea>
                        </div>
                        <div class="col-sm-12">
                            <div class="text-center">
                                <div class="button size-2 style-3">
                                    <span class="button-wrapper">
                                        <span class="icon"><img src="img/icon-4.png" alt=""></span>
                                        <span class="text coolvetica-font">Send Message</span>
                                    </span>
                                    <input type="submit"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="empty-space col-xs-b35 col-md-b70"></div>
    <div class="empty-space col-xs-b35 col-md-b70"></div>

@endsection

@push('styles')

@endpush

@push("scripts")
    <!-- MAP -->
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script src="{{ URL::to('js/map.js') }}"></script>

    <!-- CONTACT -->
    <script src="{{ URL::to('js/contact.form.js') }}"></script>
@endpush
