{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="content">
        <div class="container-fluid">
            @include('admin.statistical')
            <div class="row">
            	<div class="col-md-6">
            		<figure class="highcharts-figure">
						  <div id="container1"></div>
					</figure>
            	</div>
            	<div class="col-md-6">
            		<figure class="highcharts-figure">
  						<div id="container2"></div>
					</figure>
            	</div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <figure class="highcharts-figure">
                <div id="container3"></div>
              </div>
            </div>
        </div>
    </div>
@stop
@section('js')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script type="text/javascript">
Highcharts.chart('container1', {
  chart: {
    type: 'column'
  },
  title: {
    text: 'Tổng số bài viết theo tháng'
  },
   subtitle: {
    text: 'Bài biết theo năm hiện tại'
  },
  accessibility: {
    announceNewData: {
      enabled: true
    }
  },
  xAxis: {
    type: 'category'
  },
  yAxis: {
    title: {
      text: 'Thống kê'
    }

  },
  legend: {
    enabled: false
  },
  plotOptions: {
    series: {
      borderWidth: 0,
      dataLabels: {
        enabled: true,
        format: '{point.y}'
      }
    }
  },

  tooltip: {
    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> tổng số bài viết<br/>'
  },

  series: [
    {
      name: "",
      colorByPoint: true,
      data: {!! $totalMonthInYear !!}
    }
  ],
});
// Create the chart
Highcharts.chart('container2', {
  chart: {
    type: 'pie'
  },
  title: {
    text: 'Biều đồ thống kê bài viết theo ngày trong tuần'
  },
  subtitle: {
    text: 'Bài biết theo tuần hiện tại'
  },

  accessibility: {
    announceNewData: {
      enabled: true
    },
    point: {
      valueSuffix: '%'
    }
  },

  plotOptions: {
    series: {
      dataLabels: {
        enabled: true,
        format: '{point.name}: {point.y} bài'
      }
    }
  },

  tooltip: {
    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> bài viết<br/>'
  },

  series: [
    {
      name: "",
      colorByPoint: true,
      data: {!! $totalPostInWeek !!}
    }
  ],
});
Highcharts.chart('container3', {
  chart: {
    type: 'pie'
  },
  title: {
    text: 'Biều đồ thống kê người dùng mới theo ngày'
  },
  subtitle: {
    text: 'Thông kê người dùng theo tuần hiện tại'
  },

  accessibility: {
    announceNewData: {
      enabled: true
    },
    point: {
      valueSuffix: '%'
    }
  },

  plotOptions: {
    series: {
      dataLabels: {
        enabled: true,
        format: '{point.name}: {point.y} người mới'
      }
    }
  },

  tooltip: {
    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> người dùng<br/>'
  },

  series: [
    {
      name: "",
      colorByPoint: true,
      data: {!! $totalUserInWeek !!}
    }
  ],
});

</script>
@stop
