@extends(config('frontend-app-layout', 'layouts.frontend'))

@section('title') Article - Index @stop

@section('page_title') Article @stop
@section('page_subtitle') Index @stop
@section('page_icon') <i class="icon-folder"></i> @stop

@section('content')
    <div class="col-md-6">

        @foreach($articlesData as $articleItem)
            <p class="description">
                <br> {{ $articleItem->title }}
<br> {{ $articleItem->image }}

            </p>
        @endforeach

    </div>

    {!! $articlesData->links() !!}
@stop