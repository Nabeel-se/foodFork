@extends('layouts.website', [
    'title' => 'FoodFork - Dashboard',
    'active' => 'dashboard',
    'showSearch' => true,
])
@section('content')

    <div class="header-empty-space"></div>

    <div class="block-entry fixed-background banner-custom-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="cell-view simple-banner-height text-center">
                        <div class="empty-space col-xs-b35 col-sm-b70"></div>
                        <h1 class="h1 text-dark coolvetica-font banner-heading">Our <span class="gradient-text-1">Features</span></h1>
                        <div class="title-underline center"><span></span></div>
                        <div class="simple-article transparent size-4 manrope-font text-dark">In feugiat molestie tortor a malesuada. Etiam a venenatis ipsum. Proin pharetra elit at feugiat commodo vel placerat tincidunt sapien nec</div>
                        <div class="empty-space col-xs-b35 col-sm-b70"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="empty-space col-xs-b35 col-md-b70"></div>
    <div class="empty-space col-xs-b35 col-md-b70"></div>

    <div class="container">
        <div class="text-left">
            <div class="simple-article uppercase banner-sub-heading col-sm-b20 coolvetica-font transparent size-3 letter-sp-1">our Features</div>
            <div class="h1 text-semi-dark coolvetica-font sub-heading">What <span class="gradient-text-2">We</span> Offer</div>
            <div class="title-underline center"><span></span></div>
            <p class="simple-article transparent size-4 manrope-font text-dark">Etiam mollis tristique mi ac ultrices. Morbi vel neque eget lacus</p>
        </div>
    </div>

    <div class="empty-space col-sm-b15 col-md-b50"></div>

    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="card card-design-1">
                    <div class="card-body">
                        <div class="">
                            <img src="img/icon-27.png" alt="">
                            <div class="simple-article size-3">
                                <h4 class="coolvetica-font lowercase mb-3">Smart grocery lists</h4>
                                <p class="manrope-font">Map out your week in minutes and spot busy nights before they become stressful.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="empty-space col-xs-b10"></div>
            </div>
            <div class="col-sm-6">
                <div class="card card-design-1">
                    <div class="card-body">
                        <div class="">
                            <img src="./img/icon-26.png" alt="">
                            <div class="simple-article size-3">
                                <h4 class="coolvetica-font lowercase mb-3">Smart grocery lists</h4>
                                <p class="manrope-font">Map out your week in minutes and spot busy nights before they become stressful.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="empty-space col-xs-b10"></div>
            </div>
            <div class="col-sm-6">
                <div class="card card-design-1">
                    <div class="card-body">
                        <div class="">
                            <img src="img/icon-24.png" alt="">
                            <div class="simple-article size-3">
                                <h4 class="coolvetica-font lowercase mb-3">Smart grocery lists</h4>
                                <p class="manrope-font">Map out your week in minutes and spot busy nights before they become stressful.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="empty-space col-xs-b20"></div>
            </div>
            <div class="col-sm-6">
                <div class="card card-design-1">
                    <div class="card-body">
                        <div class="">
                            <img src="img/icon-23.png" alt="">
                            <div class="simple-article size-3">
                                <h4 class="coolvetica-font lowercase mb-3">Smart grocery lists</h4>
                                <p class="manrope-font">Map out your week in minutes and spot busy nights before they become stressful.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="empty-space col-xs-b20"></div>
            </div>
        </div>
    </div>

    <div class="empty-space col-xs-b35 col-md-b70"></div>

    <div class="row nopadding">
        <div class="col-md-6">
            <div class="block-entry banner-custom-bg" style="background:linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('http://127.0.0.1:8000/img/web-img/recipie-2.png'); background-size:cover;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                            <div class="cell-view simple-banner-height middle text-center">
                                <div class="empty-space col-xs-b35 col-sm-b70"></div>
                                <div class="simple-article size-3 banner-sub-heading coolvetica-font light transparent uppercase col-xs-b5 letter-sp-1">we offer</div>
                                <h2 class="h2 light coolvetica-font sub-heading">Choose The <span class="gradient-text-1">Best</span></h2>
                                <div class="title-underline light center"><span></span></div>
                                <div class="simple-article transparent light size-4 manrope-font text-dark">Praesent nec finibus massa. Phasellus id auctor lacus, at iaculis lorem. Donec quis arcu elit. In vehicula purus sem</div>
                                <div class="empty-space col-xs-b35 col-sm-b70"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2">
                        <div class="cell-view simple-banner-height middle">
                            <div class="empty-space col-xs-b35 col-sm-b70"></div>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="col-xs-text-center col-sm-text-left">
                                            <div class="simple-article size-4 gradient-text-1 banner-heading coolvetica-font uppercase col-xs-b5">Discount</div>
                                            <h4 class="h4 col-xs-b5 banner-sub-heading coolvetica-font fw-bold">loyality system</h4>
                                            <div class="simple-article size-3 manrope-font">Mollis nec consequat at In feugiat molestie tortor a malesuada etiam a venenatis</div>
                                        </div>
                                        <div class="empty-space col-xs-b30 col-sm-b60"></div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="col-xs-text-center col-sm-text-left">
                                            <div class="simple-article size-4 gradient-text-1 banner-heading coolvetica-font uppercase col-xs-b5">24/7</div>
                                            <h5 class="h4 col-xs-b5 banner-sub-heading coolvetica-font fw-bold">customer support</h5>
                                            <div class="simple-article size-3 manrope-font">Mollis nec consequat at In feugiat molestie tortor a malesuada etiam a venenatis</div>
                                        </div>
                                        <div class="empty-space col-xs-b30 col-sm-b60"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="col-xs-text-center col-sm-text-left">
                                            <div class="simple-article size-4 gradient-text-1 banner-heading coolvetica-font uppercase col-xs-b5">Quality</div>
                                            <h5 class="h4 col-xs-b5 banner-sub-heading coolvetica-font fw-bold">best materials</h5>
                                            <div class="simple-article size-3 manrope-font">Mollis nec consequat at In feugiat molestie tortor a malesuada etiam a venenatis</div>
                                        </div>
                                        <div class="empty-space col-xs-b30 col-sm-b0"></div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="col-xs-text-center col-sm-text-left">
                                            <div class="simple-article size-4 gradient-text-1 banner-heading coolvetica-font uppercase col-xs-b5">Professional Staf</div>
                                            <h5 class="col-xs-b5 banner-sub-heading coolvetica-font uppercase fw-bold">Over 5,000 employers</h5>
                                            <div class="simple-article size-3 manrope-font">Mollis nec consequat at In feugiat molestie tortor a malesuada etiam a venenatis</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="empty-space col-xs-b35 col-sm-b70"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="empty-space col-xs-b35 col-md-b70"></div>
    <div class="empty-space col-xs-b35 col-md-b70"></div>

    <div class="container">
        <div class="text-center">
            <div class="simple-article size-3 banner-sub-heading coolvetica-font transparent uppercase col-xs-b5 letter-sp-1">our award</div>
            <div class="h1 text-semi-dark coolvetica-font sub-heading">Best <span class="gradient-text-2">Customers</span> Support</div>
            <div class="title-underline center"><span></span></div>
        </div>
    </div>

    <div class="empty-space col-xs-b35 col-md-b70"></div>

    <div class="container">
        <div class="row vertical-aligned-columns">
            <div class="col-sm-6 col-xs-b30 col-sm-b0">
                <img class="image-thumbnail" src="img/web-img/logo-footer.png" alt="" />
            </div>
            <div class="col-sm-6">
                <div class="simple-article size-4">
                    <h3 class="h3 text-semi-dark coolvetica-font sub-heading letter-sp-1">Quisque scelerisque leo nisl</h3>
                    <p class="manrope-font">Aenean facilisis, purus ut tristique pulvinar, odio neque commodo ligula, non vestibulum lacus justo vel diam. Aenean ac aliquet tortor, nec gravida urna. Ut nec urna elit. Etiam id scelerisque ante. Cras velit nunc, luctus a volutpat nec, blandit id dolor. Quisque commodo elit nulla, eu semper quam feugiat et. Integer quam velit, suscipit eget consectetur ac, molestie eu diam.</p>
                    <p class="manrope-font">Fusce semper rhoncus dignissim. Curabitur dapibus convallis varius. Suspendisse sem urna, ullamcorper eget porttitor ut, sagittis in justo. Vestibulum egestas nulla nec purus porttitor fermentum. Integer mauris mi, viverra eget nibh at, efficitur consectetur erat. Curabitur et imperdiet enim.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="empty-space col-xs-b35 col-md-b70"></div>
    <div class="empty-space col-xs-b35 col-md-b70"></div>

@endsection

@push('styles')

@endpush

@push("scripts")

@endpush
