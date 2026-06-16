@extends('layouts.website', [
    'title' => 'FoodFork - Dashboard',
    'active' => 'dashboard',
    'showSearch' => true,
])
@section('content')

    <div class="empty-space col-xs-b35 col-md-b70"></div>
    <div class="empty-space col-xs-b35 col-md-b70"></div>
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

@endsection

@push('styles')

@endpush

@push("scripts")

@endpush
