<div>

  <div class="alert alert-success" wire:poll="fectchData" style="margin-top: 100px">
      <h2>All users: {{$CountUsers}}</h2>
      <h2>Today: {{$countToday}}</h2>
  </div>
  

  <div class="w-full" style="height: 60%;">
        <div class="px-10" id="chart"></div>        
  </div>


<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script type="text/javascript">
    var options = {
  chart: {
    type: 'line',
    height:'350px',
    animations:{
      enabled:false,
    }
  },
  series: [{
    name: 'Users',
    data: @json($counts)
  }],
  xaxis: {
    categories: @json($days)
  },
  title: {
      text: 'Users',
  },
  noData: {
    text: 'Loading...'
  }
}

var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();

</script>
</div>

@push('scripts')
<script>
    alert(10);
</script>
@endpush