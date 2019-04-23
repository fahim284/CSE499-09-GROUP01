@extends(config('main-app-layout', 'redprintUnity::page'))

@section('title') Article - Form @stop

@section('page_title') Article @stop
@section('page_subtitle') @if ($article->exists) {{ trans('redprint::core.editing') }} Article: {{ $article->id }} @else Add New Article @endif @stop

@section('title')
  @parent
  Article
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

  <form method="post" action="{{ route('article.save') }}" enctype="multipart/form-data" >
  {!! csrf_field() !!}
  <div class="card">

    <div class="card-body row">
        <input type="hidden" name="id" value="{{ $article->id }}" >
                <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-12 {{ $errors->has('title') ? 'has-error' : '' }}">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $article->title ?: old('title') }}">
            @if ($errors->has('title'))
                <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-6 col-lg-6 {{ $errors->has('content') ? 'has-error' : '' }}">
            <label>Content</label>
            <textarea name="content" class="form-control" id="contentEditor">{!! $article->content ?: old('content') !!}</textarea>

            @if ($errors->has('content'))
                <span class="help-block">
                    <strong>{{ $errors->first('content') }}</strong>
                </span>
            @endif
        </div>

        @section('post-js')
        @parent
            <script>
                $(document).ready(function() {
                  $('#contentEditor').summernote();
                });
            </script>
        @stop
    <div class="form-group has-feedback col-xs-12 col-md-4 col-lg-4 {{ $errors->has('image') ? 'has-error' : '' }}">

        <label>{{ \Lang::has('redprint::strings.image') ? trans('redprint::strings.image') :  'Image' }} </label>
        <div class="input-group">
            <span class="input-group-btn">
                <span class="btn btn-default btn-file">
                    {{ trans('redprint::core.browse') }} <input type="file" class="imgInp" name="image">
                </span>
            </span>
            <input type="text" class="form-control" readonly>
        </div>

        @if($article->image)
            <img src="/uploads/articles/{{ ($article->image) }}" class="img-thumbnail img-upload">
        @else
            <img src="/vendor/redprint/images/default-thumbnail.png" class="img-thumbnail img-upload">
        @endif

        @if($errors->has("image"))
            <div class="invalid-feedback">
                {{$errors->first("image")}}
            </div>
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