@extends('layouts.app')

@section('content')
@if(Auth::check())
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="filters">
                    
                    <form class="form-horizontal" method="POST" action="{{ route('admin.db.categories') }}">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                       
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <label class="col-md-2 control-label">Sport</label>
                                <div class="col-md-8">
                                    <select onchange="submit();" class="selectpicker form-control" title="sport" id="sport_id" name="sport_id">
                                        <option {{ $sport_id == 0 ? "selected" : "" }} value="0">--- Select ---</option>
                                        @foreach($sports as $sport)
                                        <option {{ $sport_id == $sport->id ? "selected" : "" }} value="{{ $sport->id }}">{{ $sport->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </form>

                    @if(isset($sportname))
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ $sportname }} Categories saved on DB</div>
                            
                        <div class="panel-body">
                            <ul>
                                @foreach($dbcats->where('sport_id', $sport_id) as $dbcat)
                                <li class="col-md-2">{{ $dbcat->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif

                    @if(isset($cats))

                    <form class="form-horizontal" method="POST" action="{{ route('admin.db.categoriesupdate') }}">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                       
                        <div class="form-group">  <!-- Checkbox Group !-->
                            <label class="control-label" style="display: block; text-align: left;">Choose categories to update</label>
                            @foreach($cats as $cat)
                                <?php $cat['id'] = ( (!strtok($cat['id'], ':').strtok(':')) ? strtok(':') : $cat['id'] ) ; ?>
                                <div class="col-md-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="catschk[{{ $cat['id'] }}]" value="{{$cat['name']}}" >
                                            {{$cat['name']}} <i class="fa fa-new"></i>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>  

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                       
                    </form>
                    @else

                    <p>No categories for this sport</p>

                    @endif

                </div>

            </div>
        </div>
    </div>
@endif
@endsection