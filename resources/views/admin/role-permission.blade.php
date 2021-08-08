@extends('layouts.admin')
@section('title', 'Role Permisson')
@section('css')
<link href="ad\css\dataTables.bootstrap.min.css" rel="stylesheet">
<link href="ad\css\toastr.css" rel="stylesheet" />
<link href="ad\css\customad.css" rel="stylesheet" />
<meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection
@section('content')
<!-- page content -->
<div class="content">
    
    @livewire('rolepermission')
    
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

    window.addEventListener('show-delete-modal', event=>{
        $('#confirm-delete').modal('show');
    })

    window.addEventListener('hide-delete-modal', event=>{
        $('#confirm-delete').modal('hide');
        toastr.success(event.detail.message,'Success!!');
    })

    window.addEventListener('show-restore-modal', event=>{
        $('#confirm-restore').modal('show');
    })

    window.addEventListener('hide-restore-modal', event=>{
        $('#confirm-restore').modal('hide');
        toastr.success(event.detail.message,'Success!!');
    })

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