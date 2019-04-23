@extends('redprintUnity::page')

@section('title')
    Update Profile: {{$user->name}}
@stop

@section('page_title')
    Update Profile
@stop

@section('page_subtitle') 
    {{ $user->name }}
@stop

@section('page_icon') <i class="icon-user-circle"></i> @stop

@section('content')
<div class="card">

    <div class="card-body">
        <form action="{{ route('backend.profile.post') }}" method="POST" enctype="multipart/form-data" > 
        {!! csrf_field() !!}
        <input type="hidden" name="id" value="{{ $user->id }}">
            <div class="row">

                <div class="form-group col-md-6">
                    
                    <label class="control-label">First Name<span class="required">*</span></label>

                    <input type="text" class="form-control" placeholder="John" name="first_name" value="{{$user->first_name}}" />

                    @if ($errors->has('first_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6">
                    <label class="control-label">Last Name<span class="required">*</span></label>
                    
                    <input type="text" class="form-control" placeholder="Doe" name="last_name" value="{{$user->last_name}}" />

                    @if ($errors->has('last_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                    @endif

                </div>


            </div>

            <div class="row">
                <div class="col-md-12">
                    <h5>Change Password:</h5>
                </div>
                <hr />
                <div class="form-group col-md-6">
                    <label class="control-label">Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="password"/>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6">
                    <label class="control-label">Confirm Password</label>
                    <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation"/>
                </div>

            </div>

        </div>

        <div class="card-footer">
            @if(function_exists('redprint') && redprint() && $user->hasRole('su'))
                <p>Super Users are not editable in Redprint mode.</p>
            @else
                <button class="btn btn-md btn-success" type="submit" style="border-radius: 0px !important;">Save</button>
            @endif
        </div> 

        </form>

    </div>
</div>
@stop