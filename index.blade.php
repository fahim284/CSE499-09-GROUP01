@extends(config('main-app-layout', 'redprintUnity::page'))

@section('title') Profile - Index @stop

@section('page_title') Profile @stop
@section('page_subtitle') Index @stop
@section('page_icon') <i class="icon-folder"></i> @stop

@section('content')
    <div class="card">

        <div class="card-header">
            <a href="{{ route('profile.new') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;{{ trans('redprint::core.new') }}</a>
            <div class="btn-group float-right">
                @if(count(Request::input()))
                    <a class="btn btn-default" href="{{ route('profile.index') }}">{{ trans('redprint::core.clear') }}</a>
                    <a class="btn btn-primary" id="searchButton" data-toggle="modal" data-target="#searchModal" href="#">{{ trans('redprint::core.modify_search') }}</a>
                @else
                    <a class="btn btn-primary" id="searchButton" data-toggle="modal" data-target="#searchModal" href="#"><i class="icon-search"></i>&nbsp;&nbsp;{{ trans('redprint::core.search') }}</a>
                @endif
            </div>
        </div>


        <div class="card-body">
            <table class="table table-striped table-hover table-bordered">
                <tbody>
                    <thead>
                        <tr>
                            <td>Height</td>
<td>Weight</td>
<td>Gender</td>
<td>Contact</td>
<td>Plan</td>

                            <th>{{ trans('redprint::core.actions') }}</th>
                        </tr>
                    </thead>
                    @foreach($profilesData as $profileItem)
                    <tr>
                        <td> {{ $profileItem->height }}</td>
<td> {{ $profileItem->weight }}</td>
<td> {{ $profileItem->gender }}</td>
<td> {{ $profileItem->contact }}</td>
<td> {{ $profileItem->plan }}</td>

                        <th>
                            @if(!$profileItem->deleted_at)
                                <a href="{{ route('profile.form', $profileItem->id) }}" class="btn btn-primary btn-xs">{{ trans('redprint::core.edit') }}</a>
                                <a href="#" class="btn btn-xs btn-warning" data-target="#deleteModal{{ $profileItem->id }}" data-toggle="modal" >{{ trans('redprint::core.delete') }}</a>


                                <!-- modal starts -->
                                <div class="modal fade" id="deleteModal{{ $profileItem->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form class="form-horizontal" method="post" action="{{ route('profile.delete', $profileItem->id) }}" >
                                            {!! csrf_field() !!}
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"> {{ trans('redprint::core.delete') }}: {{ $profileItem->id }} </h4>
                                            </div>
                            
                                            <div class="modal-body">
                                                {{ trans('redprint::core.confirm_delete') }} <strong>{{ $profileItem->id }} ?</strong>
                                            </div>
                            
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('redprint::core.close') }}</button>
                                                <button type="submit" class="btn btn-danger">{{ trans('redprint::core.delete') }}</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- modal ends -->

                            @else

                                <a href="#" class="btn btn-xs btn-success" data-target="#restoreModal{{ $profileItem->id }}" data-toggle="modal" >Restore</a>
                                <a href="#" class="btn btn-xs btn-danger" data-target="#forceDeleteModal{{ $profileItem->id }}" data-toggle="modal" >{{ trans('redprint::core.permanently_delete') }}</a>


                                <!-- modal starts -->
                                <div class="modal fade" id="restoreModal{{ $profileItem->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form class="form-horizontal" method="post" action="{{ route('profile.restore', $profileItem->id) }}" >
                                            {!! csrf_field() !!}

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"> {{ trans('redprint::core.restore') }}: {{ $profileItem->id }} </h4>
                                            </div>
                            
                                            <div class="modal-body">
                                                {{ trans('redprint::core.confirm_restore') }} <code>{{ $profileItem->id }} ?</code>
                                            </div>
                            
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('redprint::core.close') }}</button>
                                                <button type="submit" class="btn btn-primary">{{ trans('redprint::core.restore') }}</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- modal ends -->



                                <!-- modal starts -->
                                <div class="modal fade" id="forceDeleteModal{{ $profileItem->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form class="form-horizontal" method="post" action="{{ route('profile.force-delete', $profileItem->id) }}" >
                                            {!! csrf_field() !!}
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"> Permanently: {{ $profileItem->id }} </h4>
                                            </div>
                            
                                            <div class="modal-body">
                                                {{ trans('redprint::core.confirm_permanent_delete') }} <strong>{{ $profileItem->id }} </strong> ? {{ trans('redprint::core.permanent_delete_warning') }}
                                            </div>
                            
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('redprint::core.close') }}</button>
                                                <button type="submit" class="btn btn-primary">{{ trans('redprint::core.permanently_delete') }}</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- modal ends -->

                            @endif
                        </th>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {!! $profilesData->links() !!}
        </div>
    </div>

    @section('modals')
    @parent
    <!-- profile search modal -->
    <div class="modal fade" id="searchModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" method="get" action="{{ route('profile.index') }}" >
                {!! csrf_field() !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ trans('redprint::core.search') }} profiles</h4>
                </div>

                <div class="modal-body">                  
                    <div class="form-group">
					    
					    <label class="col-sm-3">{{ \Lang::has('redprint::strings.weight') ? trans('redprint::strings.weight') :  'Weight' }} </label>

					    <div class="col-sm-9">
					        <input type="text" name="weight" value="{{ old('weight') }}" class="form-control" >
					    </div>
					</div><div class="form-group">
					    
					    <label class="col-sm-3">{{ \Lang::has('redprint::strings.gender') ? trans('redprint::strings.gender') :  'Gender' }} </label>

					    <div class="col-sm-9">
					        <input type="text" name="gender" value="{{ old('gender') }}" class="form-control" >
					    </div>
					</div>                                        
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('redprint::core.close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ trans('redprint::core.search') }}</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- search modal ends -->
    @stop

@stop