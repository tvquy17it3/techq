@extends('layouts.admin')
@section('title', 'Accounts')
@section('css')
<link href="ad\css\toastr.css" rel="stylesheet" />
<link href="ad\css\customad.css" rel="stylesheet" />
<meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection
@section('content')
<!-- page content -->
<div class="content">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>Edit Role Permissons</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{route('roles_permissions')}}"> Back</a>
            </div>
        </div>
    </div>


    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="row">
        <form class="form-horizontal" role="form" method="POST" action="{{ route('update-permissons', ['role' => $role->id]) }}">
            {{ csrf_field() }}
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name: {{$role->name}}</strong>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Permission:</strong><br>
                    @foreach($role->permissions as $key => $value)

                    <label class="btn btn-info active" style="margin: 5px;margin-left: 30px;">
                        <input type="checkbox" autocomplete="off" {{!$value ?: 'checked'}} name="check_list[]" value="{{$key}}">{{$key}}
                    </label><br>
                    @endforeach
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

@endsection
@section('scripts')
<!-- <script src="ad/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="ad/js/dataTables.bootstrap.min.js"></script> -->
<script src="ad/js/toastr.js"></script>
<script type="text/javascript" src="ad/js/dash/dashboad.js"> </script>
<script>
    toastr.options = {
      "newestOnTop": true,
      "progressBar": true,
      "onclick": null,
    }
    $(document).ready(function() {
        var check = "{{\Session::has('success')}}";
        if (check !="") {
            toastr["success"]("{!! \Session::get('success') !!}");
        }   
    })


</script>
@endsection

<!-- https://www.itsolutionstuff.com/post/laravel-8-user-roles-and-permissions-tutorialexample.html -->