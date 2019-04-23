@extends(config('frontend-app-layout', 'layouts.frontend'))

@section('title') Profile - Index @stop

@section('page_title') Profile @stop
@section('page_subtitle') Index @stop
@section('page_icon') <i class="icon-folder"></i> @stop

@section('content')
    <div class="col-md-6">

        @foreach($profilesData as $profileItem)
            <p class="description">
                <br> {{ $profileItem->height }}
<br> {{ $profileItem->weight }}
<br> {{ $profileItem->gender }}
<br> {{ $profileItem->contact }}
<br> {{ $profileItem->plan }}

            </p>
        @endforeach

    </div>

    {!! $profilesData->links() !!}
@stop