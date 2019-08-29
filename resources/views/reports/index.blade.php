@extends("layouts.default")

@section("title") @parent Report Page @stop

@section('css')
    @parent
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
@stop

@section("content")
    <h3 style="color: #006400">Reports</h3>
    <hr />

    <h4 style="color: #006400">{{ $message }}</h4>

    <table class="table table-striped table-hover table-bordered">
        <thead>
            <th style="color: #3b5998">Product Name</th>
            <th style="color: #3b5998">Units</th>
            <th style="color: #3b5998">Calorie</th>
            <th style="color: #3b5998">Net Calorie</th>
            <th style="color: #3b5998">Consumption Time</th>
        </thead>

        @foreach($histories as $history)
        <tr>
            <td style="color: #990000">{{ $history->product->long_name }}</td>
            <td style="color: #990000">{{ $history->units }}</td>
            <td style="color: #990000">{{ $history->energy }}</td>
            <td style="color: #990000">{{ $history->net_calorie }}</td>
            <td style="color: #990000">{{ $history->created_at->toDayDateTimeString() }}</td>
        </tr>
        @endforeach
    </table>
        
        {{ $histories->appends(Request::all())->links("vendor.pagination.bootstrap-4") }}
@stop

@section("sidebar")
    <a href="{{ route("report.form") }}" class="btn btn-success">Report Form Page</a> <br /> <br />

    @if($suggested_bmr)
        <b style="color: #FF00FF">Your Suggested BMR is  {{ $suggested_bmr }} For Selected Days</b> <br /> <br />
    @endif

    @if($net_calorie)
        <b style="color: #FF00FF">Your Consumed Calorie Is  {{ $net_calorie }} For Selected Days</b> <br /> <br />
    @endif

    @if($profit)
        <b style="color: #FF00FF">You Are In A Defecit Of {{ $profit }} For Selected Days</b> <br /> <br />
    @endif
    
    @if($loss)
        <b style="color: #006400">You Have Exceeded By {{ $loss }} For Selected Days</b> <br /> <br />
    @endif
@stop
