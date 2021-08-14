@extends('layouts.admin')
@section('title', 'Chưa Duyệt')
@section('css')
<link href="ad\css\dataTables.bootstrap.min.css" rel="stylesheet">
<link href="ad\css\toastr.css" rel="stylesheet" />
<link href="ad\css\customad.css" rel="stylesheet" />
<meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection
@section('content')
<!-- page content -->
<div class="content">
    @livewire('postun')
</div>

@endsection
@section('scripts')
<!-- <script src="ad/js/jquery.dataTables.min.js"></script>
<script src="ad/js/dataTables.bootstrap.min.js"></script> -->
<script src="ad/js/toastr.js"></script>
<script type="text/javascript" src="ad/js/dash/dashboad.js"> </script>
<script>
    window.addEventListener('show-delete-modal', event=>{
        $('#confirm-delete').modal('show');
    })

    window.addEventListener('hide-delete-modal', event=>{
        $('#confirm-delete').modal('hide');
        toastr.success(event.detail.message,'Success!!');
    })

    window.addEventListener('published', event=>{
        toastr.success(event.detail.message,'Success!!');
    })
    window.addEventListener('noti-error', event=>{
        toastr.error(event.detail.message,'Error!!');
    })

</script>
@endsection