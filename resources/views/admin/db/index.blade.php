@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Data Management and Request
            <p class="small">Manage all data active on radar and db</p>
        </h2>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<!-- Page Heading -->
    

    <div class="row">

        <div class="col-lg-3 col-md-6">
            <a href="{{ route('admin.db.books') }}">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div>Tournaments</div>
                                <div class="huge">{{ $tournaments }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel-footer">
                        <span class="pull-left">Request</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </div>   
            </a>             
        </div>

        <div class="col-lg-3 col-md-6">
            <a href="{{ route('admin.db.categories') }}">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-flag fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div>Categories</div>
                                <div class="huge">{{ $categories }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel-footer">
                        <span class="pull-left">Request</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                    
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6">
            <a href="#">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-shopping-cart fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div>Sports</div>
                                <div class="huge">{{ $sports }}</div>
                            </div>
                        </div>
                    </div>
                
                    <div class="panel-footer">
                        <span class="pull-left">Request</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>                
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6">
            <a href="#">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-support fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div>Matches</div>
                                <div class="huge">{{ $matches }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel-footer">
                        <span class="pull-left">Request</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>                    
                </div>
            </a>
        </div>

    </div>
@endsection