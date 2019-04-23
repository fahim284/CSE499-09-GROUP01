@extends("layouts.default")

@section("title") @parent User 
@stop


@section("content")
    <h3 style="color:#FFFF00;">Welcome {{ $user->name }} To Your Account</h3>
    <hr />

    <h4 style="color:#FFFF00;">{{ $message }}</h4> </br></br>
    <h4 style="color:#FFFF00;">Your TDEE Is {{ $bmr }}</h4></br></br>
    <h4 style="color:#FFFF00;">Your Suggested Calorie {{ $suggested_bmr }}</h4></br></br>
    
@stop

@section("sidebar")
@section('css')
    @parent
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" type="text/css" href="/css/style.css">
@stop
   <div class="container">
    <div class="row">
        <div class="col">
            <div class="weather-card one">
                <div class="top">
                    <div class="wrapper">
                        <div class="mynav">
                            <a href="javascript:;"><span class="lnr lnr-chevron-left"></span></a>
                            <a href="javascript:;"><span class="lnr lnr-cog"></span></a>
                        </div>
                        <h1 class="heading">Clear night</h1>
                        <h3 class="location">Dhaka, Bangladesh</h3>
                        <p class="temp">
                            <span class="temp-value">20</span>
                            <span class="deg">0</span>
                            <a href="javascript:;"><span class="temp-type">C</span></a>
                        </p>
                    </div>
                </div>
                <div class="bottom">
                    <div class="wrapper">
                        <ul class="forecast">
                            <a href="javascript:;"><span class="lnr lnr-chevron-up go-up"></span></a>
                            <li class="active">
                                <span class="date">Yesterday</span>
                                <span class="lnr lnr-sun condition">
                                    <span class="temp">23<span class="deg">0</span><span class="temp-type">C</span></span>
                                </span>
                            </li>
                            <li>
                                <span class="date">Tomorrow</span>
                                <span class="lnr lnr-cloud condition">
                                    <span class="temp">21<span class="deg">0</span><span class="temp-type">C</span></span>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="weather-card rain">
                <div class="top">
                    <div class="wrapper">
                        <div class="mynav">
                            <a href="javascript:;"><span class="lnr lnr-chevron-left"></span></a>
                            <a href="javascript:;"><span class="lnr lnr-cog"></span></a>
                        </div>
                        <h1 class="heading">Rainy day</h1>
                        <h3 class="location">Sylhet, Bangladesh</h3>
                        <p class="temp">
                            <span class="temp-value">16</span>
                            <span class="deg">0</span>
                            <a href="javascript:;"><span class="temp-type">C</span></a>
                        </p>
                    </div>
                </div>
                <div class="bottom">
                    <div class="wrapper">
                        <ul class="forecast">
                            <a href="javascript:;"><span class="lnr lnr-chevron-up go-up"></span></a>
                            <li class="active">
                                <span class="date">Yesterday</span>
                                <span class="lnr lnr-sun condition">
                                    <span class="temp">22<span class="deg">0</span><span class="temp-type">C</span></span>
                                </span>
                            </li>
                            <li>
                                <span class="date">Tomorrow</span>
                                <span class="lnr lnr-cloud condition">
                                    <span class="temp">18<span class="deg">0</span><span class="temp-type">C</span></span>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('js')
    @parent
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
@stop
