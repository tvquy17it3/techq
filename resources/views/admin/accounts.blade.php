@extends('layouts.admin')
@section('title', 'Accounts')
@section('css')
<link href="ad\css\dataTables.bootstrap.min.css" rel="stylesheet">
<link href="ad\css\toastr.css" rel="stylesheet" />
<link href="ad\css\customad.css" rel="stylesheet" />
<meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection
@section('content')
<!-- page content -->
<div class="content">
    @if ($typeAccount=='all-accounts')
        @livewire('account')
    @endif

    @if ($typeAccount=='blocked')
        @livewire('blocked')
    @endif
    
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

    window.addEventListener('noti', event=>{
        toastr.success(event.detail.message,'Success!!');
    })

    window.addEventListener('noti-error', event=>{
        toastr.error(event.detail.message,'Error!!');
    })

    window.addEventListener('hide-modal-noti-error', event=>{
        $('#confirm-delete').modal('hide');
        toastr.error(event.detail.message,'Error!!');
    })

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
@endsection