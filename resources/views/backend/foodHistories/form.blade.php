@extends(config('main-app-layout', 'redprintUnity::page'))

@section('title') FoodHistory - Form @stop

@section('page_title') FoodHistory @stop
@section('page_subtitle') @if ($foodHistory->exists) {{ trans('redprint::core.editing') }} FoodHistory: {{ $foodHistory->id }} @else Add New FoodHistory @endif @stop

@section('title')
  @parent
  FoodHistory
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

  <form method="post" action="{{ route('foodHistory.save') }}" enctype="multipart/form-data" >
  {!! csrf_field() !!}
  <div class="card">

    <div class="card-body row">
				        <input type="hidden" name="id" value="{{ $foodHistory->id }}" >

<div class="form-group col-md-6 col-xs-6 col-lg-6  has-feedback {{ $errors->has('product_id') ? 'has-error' : '' }}">
	<label class="control-label"> Product <span class="required">*</span></label>
	
    <select name='product_id' class ='form-control selectpicker' placeholder='Please select a product' data-live-search='true' id ='product_id' >
        @foreach($products as $entityId => $entityValue)
            <option value="{{ $entityId }}" {{ $foodHistory->product_id === $entityId ? 'selected' : '' }} >{{ $entityValue }}</option>
        @endforeach
    </select>

  @if ($errors->has('product_id'))
    <span class="help-block">
      <strong>{{ $errors->first('product_id') }}</strong>
    </span>
  @endif
</div>
<div class="form-group col-md-6 col-xs-6 col-lg-6  has-feedback {{ $errors->has('user_id') ? 'has-error' : '' }}">
	<label class="control-label"> User <span class="required">*</span></label>
	
    <select name='user_id' class ='form-control selectpicker' placeholder='Please select a user' data-live-search='true' id ='user_id' >
        @foreach($users as $entityId => $entityValue)
            <option value="{{ $entityId }}" {{ $foodHistory->user_id === $entityId ? 'selected' : '' }} >{{ $entityValue }}</option>
        @endforeach
    </select>

  @if ($errors->has('user_id'))
    <span class="help-block">
      <strong>{{ $errors->first('user_id') }}</strong>
    </span>
  @endif
</div>                <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-12 {{ $errors->has('energy') ? 'has-error' : '' }}">
            <label>Energy</label>
            <input type="text" name="energy" class="form-control" value="{{ $foodHistory->energy ?: old('energy') }}">
            @if ($errors->has('energy'))
                <span class="help-block">
                    <strong>{{ $errors->first('energy') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-12 {{ $errors->has('units') ? 'has-error' : '' }}">
            <label>Units</label>
            <input type="text" name="units" class="form-control" value="{{ $foodHistory->units ?: old('units') }}">
            @if ($errors->has('units'))
                <span class="help-block">
                    <strong>{{ $errors->first('units') }}</strong>
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