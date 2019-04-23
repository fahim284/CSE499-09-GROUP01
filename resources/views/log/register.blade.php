@extends("layouts.default")

@section("title") @parent Registration @stop

@section('css')
    @parent
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
@stop

@section("content")
    <div class="container">
    <div class="d-flex justify-content-center h-100">
        <div class="card">
            <div class="card-header">
                <h3>Registration</h3>
                <div class="d-flex justify-content-end social_icon">
                    <span><i class="fab fa-facebook-square"></i></span>
                    <span><i class="fab fa-google-plus-square"></i></span>
                    <span><i class="fab fa-twitter-square"></i></span>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('register.post')}}">
                    {{ csrf_field()}}
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="firstname" placeholder="firstname" value="{{ old('firstname') }}" class="form-control @if($errors->has('firstname')) is-invalid @endif" />

                            @if($errors->has("firstname"))
                                <div class="invalid-feedback">
                                    {{$errors->first("firstname")}}
                                </div>
                            @endif
                        
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="lastname" placeholder="lastname" value="{{ old('lastname') }}" class="form-control @if($errors->has('lastname')) is-invalid @endif" />

                            @if($errors->has("lastname"))
                                <div class="invalid-feedback">
                                    {{$errors->first("lastname")}}
                                </div>
                            @endif
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="email" placeholder="email" value="{{ old('email') }}" class="form-control @if($errors->has('email')) is-invalid @endif" />

                            @if($errors->has("email"))
                                <div class="invalid-feedback">
                                    {{$errors->first("email")}}
                                </div>
                            @endif
                        
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" placeholder="password" name="password" class="form-control @if($errors->has('password')) is-invalid @endif" />

                        @if($errors->has("password"))
                            <div class="invalid-feedback">
                                {{$errors->first("password")}}
                            </div>
                        @endif
                    </div>
            
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" placeholder="confirm password" name="password_confirmation" class="form-control" />
                        </div>
                    <div class="form-group">
                        <input type="submit" value="Register" class="btn float-right login_btn">
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-center links">
                    Already have an account?<a href="#">Login</a>
                </div>
                <div class="d-flex justify-content-center links">
                    Made By Fahim Khan
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
    @parent
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@stop