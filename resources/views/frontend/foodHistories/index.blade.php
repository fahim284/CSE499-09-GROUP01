@extends(config('frontend-app-layout', 'layouts.frontend'))

@section('title') FoodHistory - Index @stop

@section('page_title') FoodHistory @stop
@section('page_subtitle') Index @stop
@section('page_icon') <i class="icon-folder"></i> @stop

@section('content')
    <div class="col-md-6">

        @foreach($foodHistoriesData as $foodHistoryItem)
            <p class="description">
                <br> {{ $foodHistoryItem->energy }}
<br> {{ $foodHistoryItem->units }}

            </p>
        @endforeach

    </div>

    {!! $foodHistoriesData->links() !!}
@stop