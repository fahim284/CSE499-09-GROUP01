@extends(config('main-app-layout', 'redprintUnity::page'))

@section('title') Profile - Form @stop

@section('page_title') Profile @stop
@section('page_subtitle') @if ($profile->exists) {{ trans('redprint::core.editing') }} Profile: {{ $profile->id }} @else Add New Profile @endif @stop

@section('title')
  @parent
  Profile
@stop

@section('css')
  @parent
  <link rel="stylesheet" href="{{ asset('vendor/redprintUnity/vendor/summernote/summernote-bs4.css') }}" />
@stop

@section('js')
  @parent
  <script src="{{ asset('vendor/redprintUnity/vendor/summernote/summernote-bs4.min.js') }}"></script>
@stop

@section('content')

  <form method="post" action="{{ route('profile.save') }}" enctype="multipart/form-data" >
  {!! csrf_field() !!}
  <div class="card">

    <div class="card-body row">
		        <input type="hidden" name="id" value="{{ $profile->id }}" >

<div class="form-group col-md-6 col-xs-6 col-lg-6  has-feedback {{ $errors->has('user_id') ? 'has-error' : '' }}">
	<label class="control-label"> User <span class="required">*</span></label>
	
    <select name='user_id' class ='form-control selectpicker' placeholder='Please select a user' data-live-search='true' id ='user_id' >
        @foreach($users as $entityId => $entityValue)
            <option value="{{ $entityId }}" {{ $profile->user_id === $entityId ? 'selected' : '' }} >{{ $entityValue }}</option>
        @endforeach
    </select>

  @if ($errors->has('user_id'))
    <span class="help-block">
      <strong>{{ $errors->first('user_id') }}</strong>
    </span>
  @endif
</div>                <div class="form-group has-feedback col-xs-6 col-md-6 col-lg-6 {{ $errors->has('height') ? 'has-error' : '' }}">
            <label>Height</label>
            <input type="text" name="height" class="form-control" value="{{ $profile->height ?: old('height') }}">
            @if ($errors->has('height'))
                <span class="help-block">
                    <strong>{{ $errors->first('height') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-6 col-md-6 col-lg-6 {{ $errors->has('weight') ? 'has-error' : '' }}">
            <label>Weight</label>
            <input type="text" name="weight" class="form-control" value="{{ $profile->weight ?: old('weight') }}">
            @if ($errors->has('weight'))
                <span class="help-block">
                    <strong>{{ $errors->first('weight') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('gender') ? 'has-error' : '' }}">
            <label>Gender</label>
            <input type="text" name="gender" class="form-control" value="{{ $profile->gender ?: old('gender') }}">
            @if ($errors->has('gender'))
                <span class="help-block">
                    <strong>{{ $errors->first('gender') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-5 col-md-5 col-lg-5 {{ $errors->has('contact') ? 'has-error' : '' }}">
            <label>Contact</label>
            <input type="text" name="contact" class="form-control" value="{{ $profile->contact ?: old('contact') }}">
            @if ($errors->has('contact'))
                <span class="help-block">
                    <strong>{{ $errors->first('contact') }}</strong>
                </span>
            @endif
        </div>
    <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('avatar') ? 'has-error' : '' }}">

        <label>{{ \Lang::has('redprint::strings.avatar') ? trans('redprint::strings.avatar') :  'Avatar' }} </label>
        <div class="input-group">
            <span class="input-group-btn">
                <span class="btn btn-default btn-file">
                    {{ trans('redprint::core.browse') }} <input type="file" class="imgInp" name="avatar">
                </span>
            </span>
            <input type="text" class="form-control" readonly>
        </div>

        @if($profile->avatar)
            <img src="/uploads/profiles/{{ ($profile->avatar) }}" class="img-thumbnail img-upload">
        @else
            <img src="/vendor/redprint/images/default-thumbnail.png" class="img-thumbnail img-upload">
        @endif

        @if($errors->has("avatar"))
            <div class="invalid-feedback">
                {{$errors->first("avatar")}}
            </div>
        @endif

    </div>

        <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('plan') ? 'has-error' : '' }}">
            <label>Plan</label>
            <input type="text" name="plan" class="form-control" value="{{ $profile->plan ?: old('plan') }}">
            @if ($errors->has('plan'))
                <span class="help-block">
                    <strong>{{ $errors->first('plan') }}</strong>
                </span>
            @endif
        </div>

    </div>

    <div class="card-footer">
      <div class="row">
        <div class="col-sm-8">
          <button type="submit" class="btn-primary btn" >{{ trans('redprint::core.save') }}</button>
        </div>
      </div>
    </div>

  </div>
  </form>

@stop