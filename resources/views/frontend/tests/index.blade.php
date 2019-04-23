@extends(config('frontend-app-layout', 'layouts.frontend'))

@section('title') Test - Index @stop

@section('page_title') Test @stop
@section('page_subtitle') Index @stop
@section('page_icon') <i class="icon-folder"></i> @stop

@section('content')
    <div class="col-md-6">

        @foreach($testsData as $testItem)
            <p class="description">
                <br> {{ $testItem->name }}

            </p>
        @endforeach

    </div>

    {!! $testsData->links() !!}
@stop