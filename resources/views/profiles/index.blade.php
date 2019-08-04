@extends("layouts.default")

@section("title") @parent User @stop

@section("content")
    <h3>Welcome {{ $user->name }} To Your Account</h3>
    <hr />

    <h4>{{ $message }}</h4> </br></br>
    <h4>Your TDEE Is {{ $bmr }}</h4></br></br>
    <h4>Your Suggested Calorie {{ $suggested_bmr }}</h4></br></br>
    
@stop

@section("sidebar")
    {{-- <a href="{{ route("restaurant.new") }}" class="btn btn-success">Add New Restaurant</a> --}}
@stop
