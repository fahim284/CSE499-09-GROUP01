@extends("layouts.default")

@section("title") @parent Report Page @stop

@section("content")
    <h3>Reports</h3>
    <hr />

    <h4>{{ $message }}</h4>

    <table class="table table-striped table-hover table-bordered">
        <thead>
            <th>Product Name</th>
            <th>Units</th>
            <th>Calorie</th>
            <th>Net Calorie</th>
            <th>Consumption Time</th>
        </thead>

        @foreach($histories as $history)
        <tr>
            <td>{{ $history->product->long_name }}</td>
            <td>{{ $history->units }}</td>
            <td>{{ $history->energy }}</td>
            <td>{{ $history->net_calorie }}</td>
            <td>{{ $history->created_at->toDayDateTimeString() }}</td>
        </tr>
        @endforeach
    </table>
        
        {{ $histories->appends(Request::all())->links("vendor.pagination.bootstrap-4") }}
@stop

@section("sidebar")
    <a href="{{ route("report.form") }}" class="btn btn-success">Report Form Page</a> <br /> <br />

    @if($suggested_bmr)
        <p>Your Suggested BMR is  {{ $suggested_bmr }} For Selected Days</p>
    @endif

    @if($net_calorie)
        <p>Your Consumed Calorie Is  {{ $net_calorie }} For Selected Days</p>
    @endif

    @if($profit)
        <p>You Are In A Defecit Of {{ $profit }} For Selected Days</p>
    @endif
    
    @if($loss)
        <p>You Have Exceeded By {{ $loss }} For Selected Days</p>
    @endif
@stop
