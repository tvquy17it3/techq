@extends('layouts.admin')
@section('title', 'Analytics Users')
<livewire:styles />
@section('css')
<link href="ad\css\dataTables.bootstrap.min.css" rel="stylesheet">
<link href="ad\css\toastr.css" rel="stylesheet" />
<link href="ad\css\customad.css" rel="stylesheet" />
<meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection

@section('content')
<!-- page content -->
<div class="content">
    @livewire('analytics');
</div>


<livewire:scripts/>

@endsection
@section('scripts')
<script src="ad/js/toastr.js"></script>
<script type="text/javascript">
    // toastr.success("ok",'Success!!');

     Livewire.on('renderData', countsUser => {
        chart.updateSeries([{
            name: 'Users update',
            data: countsUser
          }])
    })
</script>
@endsection