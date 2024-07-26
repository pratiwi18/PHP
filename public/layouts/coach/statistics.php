<?php
	$malecnt = 0;
	$femalecnt = 0;
	$gendercnt = 0;
	$stage1cnt = 0;
	$stage2cnt = 0;
	$stage3cnt = 0;
	$stage4cnt = 0;
	$stage5cnt = 0;
	$age1 = 0;
	$age2 = 0;
	$age3 = 0;
	$age4 = 0;
	$age5 = 0;
	$age6 = 0;
	$age7 = 0;
	$age8 = 0;
	$participants = Participant::find_all();
	$currentstages = ParticipantSOC::find_all();
	foreach ($participants as $participant) {
		$gendercnt = $gendercnt + 1;
		if ($participant->gender == 'male')
			$malecnt = $malecnt + 1;
		else if($participant->gender == 'female')
			$femalecnt = $femalecnt + 1;
		if ($participant->age < 20)
			$age1 = $age1 + 1;
		else if ($participant->age < 30)
			$age2 = $age2 + 1;
		else if ($participant->age < 40)
			$age3 = $age3 + 1;
		else if ($participant->age < 50)
			$age4 = $age4 + 1;
		else if ($participant->age < 60)
			$age5 = $age5 + 1;
		else if ($participant->age < 70)
			$age6 = $age6 + 1;
		else if ($participant->age < 80)
			$age7 = $age7 + 1;
		else if ($participant->age < 120)
			$age8 = $age8 + 1;
	}
	foreach ($currentstages as $currentstage) {
		if ($currentstage->current_stage == 'Stage 1')
			$stage1cnt = $stage1cnt + 1;
		else if($currentstage->current_stage == 'Stage 2')
			$stage2cnt = $stage2cnt + 1;
		else if($currentstage->current_stage == 'Stage 3')
			$stage3cnt = $stage3cnt + 1;
		else if($currentstage->current_stage == 'Stage 4')
			$stage4cnt = $stage4cnt + 1;
		else if($currentstage->current_stage == 'Stage 5')
			$stage5cnt = $stage5cnt + 1;
	}
?>
<a class="btn btn-outline-primary" href="<?php echo ROOT_DIR."?pageid=home"?>"> &laquo; Back</a>
<script src="https://code.highcharts.com/highcharts.src.js"></script>
<div class="row">
<div class="col-sm-3 ml-sm-auto col-md-3 pt-5">
	<ul class="nav nav-tabs mb-3 flex-column" id="pills-tab" role="tablist">
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#Gender" role="tab" aria-controls="Gender" aria-selected="false">Bar Chart By Gender</a></li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#Stage" role="tab" aria-controls="Stage" aria-selected="false">Bar Chart By Current Stage</a></li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#Age" role="tab" aria-controls="Age" aria-selected="false">Bar Chart By Age</a></li>
			<li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#Pie" role="tab" aria-controls="Pie" aria-selected="false">Pie Chart By Gender</a></li>
	</ul>
</div>
<div class="tab-content col-md-9" id="pills-tabContent">
    <div class="tab-pane fade" id="Gender" role="tabpanel" aria-labelledby="Gender-tab">
			<div id="container1" style="min-width: 400px; max-width: 800px; height: 400px;"></div>
    </div>
    <div class="tab-pane fade" id="Stage" role="tabpanel" aria-labelledby="Stage-tab">
			<div id="container2" style="min-width: 400px; max-width: 800px; height: 400px;"></div>
    </div>
    <div class="tab-pane fade" id="Age" role="tabpanel" aria-labelledby="Age-tab">
			<div id="container3" style="min-width: 400px; max-width: 800px; height: 400px;"></div>
    </div>
		<div class="tab-pane fade in active show" id="Pie" role="tabpanel" aria-labelledby="Pie-tab">
			<div id="container4" style="min-width: 400px; max-width: 800px; height: 400px;"></div>
    </div>
</div>
</div>
<script>
Highcharts.chart('container1', {
  chart: {
    type: 'bar'
  },
  title: {
    text: 'Participants by Gender'
  },
  xAxis: {
    categories: ['Total', 'Male', 'Female'],
    title: {
      text: null
    }
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Participant count',
      align: 'high'
    },
    labels: {
      overflow: 'justify'
    }
  },
  plotOptions: {
    bar: {
      dataLabels: {
        enabled: true
      }
    }
  },
  /*legend: {
    layout: 'vertical',
    align: 'right',
    verticalAlign: 'top',
    x: -40,
    y: 80,
    floating: true,
    borderWidth: 1,
    backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
    shadow: true
  },*/
  credits: {
    enabled: false
  },
  series: [{
		name: 'Gender',
		data: [<?php echo $gendercnt ?>,<?php echo $malecnt?>,<?php echo $femalecnt?>]
  }]
});

Highcharts.chart('container2', {
  chart: {
    type: 'bar'
  },
  title: {
    text: 'Participant by current stage'
  },
  xAxis: {
    categories: ['Stage1', 'Stage2', 'Stage3', 'Stage4', 'Stage5'],
    title: {
      text: null
    }
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Participant count',
      align: 'high'
    },
    labels: {
      overflow: 'justify'
    }
  },
  plotOptions: {
    bar: {
      dataLabels: {
        enabled: true
      }
    }
  },
  /*legend: {
    layout: 'vertical',
    align: 'right',
    verticalAlign: 'top',
    x: -40,
    y: 80,
    floating: true,
    borderWidth: 1,
    backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
    shadow: true
  },*/
  credits: {
    enabled: false
  },
  series: [{
    name: 'Stage',
    data: [<?php echo $stage1cnt ?>,<?php echo $stage2cnt ?>,<?php echo $stage3cnt ?>,<?php echo $stage4cnt ?>,<?php echo $stage5cnt ?>]
  }]
});
	
Highcharts.chart('container3', {
  chart: {
    type: 'bar'
  },
  title: {
    text: 'Participant by age'
  },
  xAxis: {
    categories: ['<20', '20-30', '30-40', '40-50', '50-60', '60-70', '70-80', '>80'],
    title: {
      text: null
    }
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Participant count',
      align: 'high'
    },
    labels: {
      overflow: 'justify'
    }
  },
  plotOptions: {
    bar: {
      dataLabels: {
        enabled: true
      }
    }
  },
  /*legend: {
    layout: 'vertical',
    align: 'right',
    verticalAlign: 'top',
    x: -40,
    y: 80,
    floating: true,
    borderWidth: 1,
    backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
    shadow: true
  },*/
  credits: {
    enabled: false
  },
  series: [{
    name: 'Age',
    data: [<?php echo $age1 ?>,<?php echo $age2 ?>,<?php echo $age3 ?>,
					 <?php echo $age4 ?>,<?php echo $age5 ?>,<?php echo $age6 ?>,
					 <?php echo $age7 ?>,<?php echo $age8 ?>,]
  }]
});

Highcharts.chart('container4', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: 'Gender pie chart'
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
        style: {
          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
        }
      }
    }
  },
  series: [{
    name: 'Gend',
    colorByPoint: true,
    data: [{
      name: 'Female',
      y: <?php echo $femalecnt ?>,
      sliced: true,
      selected: true
    }, {
      name: 'Male',
      y: <?php echo $malecnt ?>,
    }]
  }]
});
</script>
