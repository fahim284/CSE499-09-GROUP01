@extends("layouts.default")

@section("title") @parent Profile @stop
@section('css')
    @parent
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
@stop

@section("content")

    <form method="post" action="{{ route("profiles.save") }}" class="form-horizontal">
        {{ csrf_field() }}

        <input type="hidden" name="id" value="{{ $profile->id }}">

        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

        <div class="form-group">
            <label style="color:#FFFF00;">Height: </label>
            <input type="text" name="height" placeholder="eg. CM" class="form-control @if ($errors->has("height")) is-invalid @endif" value="{{ $profile->height ?: old("height") }}">

            @if($errors->has("height"))
                <div class="invalid-feedback">
                    {{$errors->first("height")}}
                </div>
            @endif

        </div>
        
        <div class="form-group">
            <label style="color:#FFFF00;">Weight: </label>
            <input type="text" name="weight" placeholder="80kg" class="form-control @if ($errors->has("weight")) is-invalid @endif" value="{{ $profile->weight ?: old("weight") }}">

            @if($errors->has("weight"))
                <div class="invalid-feedback">
                    {{$errors->first("weight")}}
                </div>
            @endif

        </div>

        <div class="form-group">
            <label style="color:#FFFF00;">Age: </label>
            <input type="text" name="age" placeholder="50" class="form-control @if ($errors->has("age")) is-invalid @endif" value="{{ $profile->age ?: old("age") }}">

            @if($errors->has("age"))
                <div class="invalid-feedback">
                    {{$errors->first("age")}}
                </div>
            @endif

        </div>

        <div class="form-group">
            <label style="color:#FFFF00;">Gender: </label>
            <input type="text" name="gender" placeholder="Gender" class="form-control @if ($errors->has("gender")) is-invalid @endif" value="{{ $profile->gender ?: old("gender") }}">

            @if($errors->has("gender"))
                <div class="invalid-feedback">
                    {{$errors->first("gender")}}
                </div>
            @endif

        </div>

        <div class="form-group">
            <label style="color:#FFFF00;">Contact: </label>
            <input type="text" name="contact" placeholder="+2545488" class="form-control @if ($errors->has("contact")) is-invalid @endif" value="{{ $profile->contact ?: old("contact") }}">

            @if($errors->has("contact"))
                <div class="invalid-feedback">
                    {{$errors->first("contact")}}
                </div>
            @endif

        </div>

        <div class="form-group" style="color:#FFFF00;">
            <label>Plan: </label> <br />
            <input type="radio" name="plan" value="0"> Gain <br />
            <input type="radio" name="plan" value="1"> Loss<br />
        </div>

        {{-- <div class="form-group">
            <label>Image</label><br/>

            @if ($profile->avatar)
                <img src="/uploads/profiles/{{ ($profile->avatar) }}" class="img-thumbnail" style="width: 200px">
            @endif
            <input type="file" name="avatar" class="form-control @if($errors->has('avatar')) is-invalid @endif" />

            @if($errors->has("avatar"))
                <div class="invalid-feedback">
                    {{$errors->first("avatar")}}
                </div>
            @endif

        </div>     --}}
            
            <input type="submit" @if($profile->exists) value="Edit" @endif value="Create Profile" class="btn btn-success">
    </form>
@stop
@section('js')
    @parent
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@stop
@section("sidebar")
    {{-- <a href="{{ route("staff.index") }}" class="btn btn-success">All Staff</a> --}}
@stop