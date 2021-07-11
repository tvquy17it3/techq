@extends('layouts.admin')
@section('title', 'Accounts')
@section('css')
<link href="assets\dashb\css\dataTables.bootstrap.min.css" rel="stylesheet">
<link href="assets\dashb\css\toastr.css" rel="stylesheet" />
<meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection
@section('content')
<!-- page content -->
<div class="content">
    <div class="page-title">
        <div class="title_left">
            <h3>Manage<small> User</small></h3>
        </div>
        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-secondary" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable-fixed-header" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Provider</th>
                                            <th>Role</th>
                                            <th>Created_at</th>
                                            <th>Updated_at</th>
                                            <th>Block</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $values)
                                        <tr>
                                            <td>{{$values->id}}</td>
                                            <td>{{$values->name}}</td>
                                            <td>{{$values->email}}</td>
                                            <td>{{$values->phone}}</td>
                                            <td>{{$values->provider}}</td>
                                            <td>
                                                <p id="myText{{$values->id}}">{{$values->role}}</p>
                                            </td>
                                            <td>{{$values->created_at}}</td>
                                            <td>{{$values->updated_at}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- <input type="text" id="myText" value="Mickey"> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="ad\js\jquery.dataTables.min.js"></script>
<script src="ad\js\dataTables.bootstrap.min.js"></script>
<script src="ad\js\toastr.js"></script>
<script type="text/javascript" src="ad\js\dash\dashboad.js"> </script>

@endsection

<!-- 
SELECT `id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `image`, `provider`, `provider_id`, `role`, `remember_token`, `created_at`, `updated_at' -->