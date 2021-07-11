@extends('layouts.dashb')
@section('title', 'Accounts')
@section('css')
  <link href="assets\dashb\css\dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="assets\dashb\css\toastr.css" rel="stylesheet"/>
  <meta name="csrf_token" content="{{ csrf_token() }}" />
  <style type="text/css">
        body { font-family: Arial; font-size: 10pt; }
        #dialog { height: 600px; overflow: auto; font-size: 10pt !important; font-weight: normal !important; background-color: #FFFFC1; margin: 10px; border: 1px solid #ff6a00; }
        #dialog div { margin-bottom: 15px; }
    </style>
@endsection
@section('content')
    <!-- page content -->
    <div class="content">
      <div class="page-title">
        <div class="title_left">
          <h3>Users <small>Blocked</small></h3>
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
              <h2>Fixed Header Example <small>Users Blocks</small></h2>
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
                    <p class="text-muted font-13 m-b-30">
                      This example shows FixedHeader being styling by the Bootstrap CSS framework.
                    </p>
                
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
                                  <td><p id="myText{{$values->id}}">{{$values->role}}</p></td>
                                  <td>{{$values->created_at}}</td>
                                  <td>{{$values->updated_at}}</td>
                                  <td style="text-align:center;">
                                    <!-- admintp/block/{{$values->id}} onclick="return confirm('Block Account?')"-->
                                    <button type="button" id="btnB{{$values->id}}" class="btn btn-outline-danger" onclick="event.preventDefault();editrole({{$values->id}},0)" @if($values->role ==0) style="display: none;" @endif>
                                      <i class="fa fa-ban" aria-hidden="true" title="Block"  style="color: red;"></i>
                                    </button>
                                    <button type="button" id="btnN{{$values->id}}" class="btn btn-outline-warning" onclick="event.preventDefault();editrole({{$values->id}},3)" @if($values->role !=0) style="display: none;"  @endif >
                                      <i class="" aria-hidden="true" title="Block"  style="color: red;" >N</i>
                                    </button>
                                  </td>

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
  <script src="assets\dashb\js\jquery.dataTables.min.js"></script>
  <script src="assets\dashb\js\dataTables.bootstrap.min.js"></script>
  <script src="assets\dashb\js\toastr.js"></script>
  <script type="text/javascript"src="assets\dashb\js\dash\dashboad.js"> </script>

@endsection

<!-- 
SELECT `id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `image`, `provider`, `provider_id`, `role`, `remember_token`, `created_at`, `updated_at' -->