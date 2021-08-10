@extends('layouts.admin')
@section('title', 'Role Permisson')
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
                <h1>Role Management</h1>
            </div>
            <div class="pull-right">
            @can('role.create')
                <a class="btn btn-success" href="{{ route('role-create') }}"> Create New Role</a>
            @endcan
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <div>
        <table class="table" style="margin-top: 50px;">
            <thead class="thead-dark">
                <tr>
                  <th scope="col">#ID</th>
                  <th scope="col">Name</th>
                  <th scope="col">Slug</th>
                  <th scope="col">Permisson</th>
                  <th scope="col">Created_at</th>
                  <th scope="col">Updated_at</th>
                  <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr>
                  <th scope="row">{{$role->id}}</th>
                  <td>{{$role->name}}</td>
                  <td>{{$role->slug}}</td>
                  <td>
                    @foreach ($role->permissions as $key => $pms)
                        <h2><span class="badge badge-{{$pms ? 'success' :'dark'}}">{{$key.":".($pms ? 'true' :' false')}}</span></h2>
                    @endforeach
                  </td>
                  <td>{{$role->created_at}}</td>
                  <td>{{$role->updated_at}}</td>
                  <td>
                    @can('role.update')
                        <a href="{{route('edit-permisson',['role'=>$role->id])}}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        @can('role.delete')
                            <a type="button" class="btn btn-danger btn-sm" href="role/delete">Delete</a>
                        @endcan
                    @else
                        <p>No Permission</p>
                    @endcan
                  </td>
              </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
@section('scripts')
<script src="ad/js/toastr.js"></script>
<script type="text/javascript" src="ad/js/dash/dashboad.js"> </script>
<script>
    toastr.options = {
      "newestOnTop": true,
      "progressBar": true,
      "onclick": null,
    }

    window.addEventListener('show-edit-modal', event=>{
        $('#show-edit-modal').modal('show');
    })

    window.addEventListener('hide-edit-modal', event=>{
        $('#show-edit-modal').modal('hide');
        toastr.success(event.detail.message,'Success!!');
    })

    window.addEventListener('noti', event=>{
        $('#show-edit-modal').modal('hide');
        toastr.success(event.detail.message,'Success!!');
    })


</script>
@endsection