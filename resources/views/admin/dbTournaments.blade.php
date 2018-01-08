@extends('layouts.app')

@section('content')
@if(Auth::check())
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="filters">
                    
                    <form class="form-horizontal" method="POST" action="{{ route('admin.db.tournaments') }}">

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

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <label class="col-md-2 control-label">Category</label>
                                <div class="col-md-8">
                                    <select onchange="submit();" class="selectpicker form-control" title="category" id="category_id" name="category_id">
                                        <option {{ $sport_id == 0 ? "selected" : "" }} value="0">--- Select ---</option>
                                        @if(isset($categories))
                                            @foreach($categories as $category)
                                            <option {{ $category_id == $category->id ? "selected" : "" }} value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                    </form>

                    @if(isset($sportname) && isset($categoryname))
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ $sportname }} Tournaments saved on DB</div>
                            
                        <div class="panel-body">
                            <ul>
                                @foreach($dbtournaments->where('sport_id', $sport_id)->where('category_id', $category_id) as $dbtournament)
                                <li class="col-md-2">{{ $dbtournament->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif

                    @if(isset($tournaments))

                    <form class="form-horizontal" method="POST" action="{{ route('admin.db.tournamentsupdate') }}">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                       
                        <div class="form-group">  <!-- Checkbox Group !-->
                            <label class="control-label" style="display: block; text-align: left;">Choose tournaments to update</label>
                            @foreach($tournaments as $tournament)
                                <?php $id = explode(':', $tournament['id'])[2]; ?>
                                <div class="col-md-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="tournamentschk[{{ $id }}]" value="{{$tournament['name']}}" >
                                            {{$tournament['name']}} <i class="fa fa-new"></i>
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

                    <p>No tournaments for this sport's category.</p>

                    @endif

                </div>
                

            </div>
        </div>
    </div>
@endif
@endsection