@extends("layouts.default")

@section("title") @parent Report @stop

@section('css')
    @parent
    <link href="/css/bootstrap-datepicker.css" rel="stylesheet" />  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">  
@stop

@section("content")

    <h3>Select Date</h3>
    <hr />

    <form method="get" action="{{ route('report.show') }}" class="form-horizontal">
        
        <div class="form-group">
            <label>From</label>
            <input class="datepicker form-control @if ($errors->has("date_from")) is-invalid @endif" type="text" name="date_from" placeholder="Start Date">

            @if($errors->has("date_from"))
                <div class="invalid-feedback">
                    {{$errors->first("date_from")}}
                </div>
            @endif

        </div>

        <div class="form-group">
            <label>To</label>
            <input class="datepicker form-control" type="text" name="date_to">
        </div>

        <input type="submit" value="Report" class="btn btn-success">
    </form>    
@stop

@section("sidebar")
    {{-- <a href="{{ route("product.index") }}" class="btn btn-success">All Products</a> --}}
@stop

@section('js')
    @parent
     
    <script src="/js/bootstrap-datepicker.js"></script>

    <script type="text/javascript">
     $('.datepicker').datepicker({
         weekStart:1,
         color: 'red'
     });
    </script>

@stop
