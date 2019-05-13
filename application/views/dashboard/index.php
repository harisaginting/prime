<!-- JQVMAP -->
<script src="<?= base_url(); ?>assets/plugin/jqvmap/jquery.vmap.js"></script>
<script src="<?= base_url(); ?>assets/plugin/jqvmap/maps/jquery.vmap.indonesia.js"></script>

<style type="text/css">
	.icon-bg{
		font-size: 4rem;
	    position: absolute;
	    overflow: hidden;
	    right: 0%;
	}
	.reg_marker{font-size:12px;font-family:sans-serif;font-weight:900;color:red}.target_text{color:#300;font-family:sans-serif;font-weight:700}.card{border-radius:0}@media (min-width:768px){#con_projectTypeData{margin-top:-20px!important}}
</style>

<div class="row">
   <div class="col-md-4">
   		<div class="row">
   			<div class="col-md-6">
		   		<div class="card bg-darkness">
						<div class="card-body">
							<div class="h1 text-right text-transparant mb-4 icon-bg">
								<i class="icon-rocket" ></i>
							</div>
								<div class="text-white h1 no-margin"><?= $total_project; ?></div>
							<small class="text-white text-uppercase font-weight-bold">Projects</small>
						</div>
					</div>
		   	</div>
		   	<div class="col-md-6">
		   		<div class="card bg-darkness">
						<div class="card-body">
							<div class="h1 text-right text-transparant mb-4 icon-bg">
								<i class="icon-people" ></i>
							</div>
								<div class="h1 text-white no-margin"><?= $total_pm; ?></div>
							<small class="text-uppercase text-white font-weight-bold">Project Managers</small>
						</div>
					</div>
		   	</div>
   		</div>	

		<div id="chartProjectScale"></div>
	</div>
	<div class="col-md-8">
		<div id="chartProjectStatus"></div>
	</div>


	<div class="col-md-2">	

	</div>
	<div class="col-md-10">
		<div class="row">
			
		</div>
	</div>
</div>


<div class="row" style="margin-top: 20px">
	<div class="col-md-3">      
                  <?php $c=0; foreach ($total_project_c as $key => $value) : ?>
                      <div class="card" style="height: 50px;margin-bottom: 2px;border:2px solid #00000093;">
                        <div class="card-body p-0 d-flex align-items-center" style="<?= !empty($value) ? "background: #dfdfdf;" : ""; ?>height: 46px;">
                        <span class="bg-info p-4 font-2xl mr-3" style="height: 46px; padding-top: 9px !important;padding-bottom: 7px !important; min-width: 70px;font-family: monospace;font-weight: 900;background: <?= $colorTProj[$c]; ?> !important"><?= substr($key, 0,3) ?></span>
                          <div>
                            <div style="margin-top: 2px;"><span class="h4"><?= $value; ?></span></div>
                            <div class="text-muted text-uppercase font-weight-bold h6"><strong style="font-size: 9px;"><?= $key ?></strong></div>
                          </div>
                        </div>
                      </div>
                    <?php $c++; endforeach; ?>
        </div>
        <div class="col-md-9">
        	<div class="row">
        		<div class="col-md-12" style="margin-bottom: 15px;">
        			<div id="regionalChart" style="height: 300px;"></div>
        		</div>
        		<div class="col-md-8">
        			<div id="chartBast"></div>
        		</div>
        		<div class="col-md-4">
        			<div id="chartBastProgress"></div>
        		</div>
        	</div>
        </div>
</div>


<div class="row" style="margin-top: 20px;">
  <div class="col-md-12">
    <div id="chartSegmenProgress"></div>
  </div>
</div>

<div class="row" style="margin-top: 20px;">
  <div class="col-md-6">
    <div id="chartSegmenScale"></div>
  </div>
  <div class="col-md-6">
    <div id="chartSegmenValue"></div>
  </div>
</div>


<script type="text/javascript">
      var colors = Highcharts.getOptions().colors,
          categories = [
              "BIG",
              "MEGA",
              "ORDINARY",
              "REGULAR",
          ],
          data = <?= json_encode($chartProjectScale); ?>,
          projectScale = [],
          i,
          j,
          dataLen = data.length,
          drillDataLen,
          brightness;


      // Build the data arrays
      for (i = 0; i < dataLen; i += 1) {

          // add browser data 
          projectScale.push({
              name: categories[i],
              y: data[i].Y,
              color: data[i].color,
              x: data[i].V
          });
      }

      // Create the chart
      Highcharts.chart('chartProjectScale', {
          chart: {
              type: 'pie',
              backgroundColor: '#00000093',
              height:'270px',
          },
          title: {text: '' },
          credits: { text: ''},
          subtitle: { text: ''},
          yAxis: {
              title: {
                  text: 'Projects Scale'
              }
          },
          plotOptions: {
              pie: {
                  showInLegend: true
              }
          },
          legend: {
	          itemStyle: {
	                color: '#efefef',
	                fontSize : '10px'
	              },
	      },
          series: [{
              name: 'Total Projects',
              data: projectScale,
              size: '100%',
              innerSize:'0%',
              dataLabels: {
                  style: {
                      fontSize : '14px',
                      border : '0px',
                    },
                  formatter: function () {
                      return this.y;
                  },
                  border : '0px',
                  distance: -20
              }
          }],
      });




      var colors = ["#7cb5ec", "#434348", "#90ed7d", "#f7a35c", "#8085e9", "#f15c80", "#e4d354", "#2b908f", "#f45b5b", "#91e8e1"],
      categories = [
          "DELAY",
          "LAG",
          "LEAD",
      ],
      data = <?= json_encode($chartProgress) ?>,
      browserData = [],
      versionsData = [],
      i,
      j,
      dataLen = data.length,
      drillDataLen,
      brightness;

      colorA = ['#d81011','#ffc107','#0fc13e'];
      colorB = <?= json_encode($colorTProj); ?>;



      // Build the data arrays
      for (i = 0; i < dataLen; i += 1) {

          // add browser data 
          browserData.push({
              name: categories[i],
              y: data[i].Y,
              color: colorA[i]
          });

          // add version data
          drillDataLen = data[i].drilldown.data.length;
          for (j = 0; j < drillDataLen; j += 1) {
              brightness = 0.2 - (j / drillDataLen) / 5;
              versionsData.push({
                  name: data[i].drilldown.categories[j],
                  y: data[i].drilldown.data[j],
                  color: colorB[j],
              });
          }
      }


      Highcharts.chart('chartProjectStatus', {
          chart: {
              type: 'pie',
              backgroundColor : '#ffffffc2',
          },
          title: {
                  text: ''
              },
          credits: {
                          text: '',
                      },
          subtitle: {
              text: ''
          },
          yAxis: {
              title: {
                  text: 'Projects Status'
              }
          },
          plotOptions: {
              pie: {
                  center: ['50%', '50%']
              }
          },
          series: [{
              name: 'Total Projects',
              data: browserData,
              size: '75%',
              innerSize: '0%',
              dataLabels: {
                  style: {
                      fontSize : '11px',
                      border : '0px',
                      borderWidth: 0
                    },
                  formatter: function () {
                      // display only if larger than 1
                      return this.y > 0 ? '<b>' + this.point.name + ':</b> ' +
                          this.y : null;
                  },
                  color: '#fff',
                  border : '0px',
                  distance: -65 
              }
            },
            {
              name: 'Total Projects',
              data: versionsData,
              size: '80%',
              innerSize: '75%',
              dataLabels: {
                  style: {
                      fontSize : '10px',
                      border : '1px'
                    },
                  formatter: function () {
                      return this.y > 0 ? "<b style='color:#000000'>" + this.point.name + " : <span style='font-size:14px;color:#000000'>"+this.y+'</b> ' : null;
                  },
                  color: '#000',
                  distance: 70
              }
            }
          ],
          responsive: {
              rules: [{
                  condition: {
                      maxWidth: 400
                  },
                  chartOptions: {
                      series: [{
                          id: 'versions',
                          dataLabels: {
                              enabled: false
                          }
                      }]
                  }
              }]
          }
      }); 


Highcharts.chart('chartBast', {
    chart: {
    	backgroundColor:'#ffffffc2',
        type: 'column',
        height: '200px'
    },
    title: {
        text: 'BAST Approved',
        style : {
          fontSize : '14px'
        }
    },
    subtitle: {
        text: 'Click the columns to view month',
        style : {
          fontSize : '10px'
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: ''
        },
        labels :{
            enabled : false,
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
                color : '#000'
            }
        }
    },
    credits: {
          enabled: false
      },
    tooltip: {
        headerFormat: '',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> BAST<br/>'
    },

    series: [
        {
            "name": "Year",
            "color": '#1c7132',
            "data": <?= json_encode($bast['data']); ?>,        }
    ],
    drilldown : {series : <?= json_encode($bastDrilldown) ?>}
});


Highcharts.chart('chartBastProgress', {
    chart: {
    	backgroundColor:'#ffffffc2',
        type: 'column',
        height :'200px;'
    },
    exporting: { enabled: false },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    xAxis: {
                      categories: [ '','']
                  },
    yAxis: {
        title: {
            text: ''
        },
        labels :{
            enabled : false,
        }

    },
    legend: {
        enabled: true,
        itemStyle: {
          fontSize : '9px'
        }
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
            }
        }
    },
    credits: {
          enabled: false
      },
    tooltip: {
        headerFormat: '',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> BAST<br/>'
    },

    series: [
        {
            name        : "Revision (Out)",
            color       : '#ffc107',
            data        : [<?= $bast_r ?>]    
        },
        {
            name        : "Progress (In)",
            color       : '#0fc13e',
            data        : [<?= $bast_p ?>]    
        }
    ]

});



var c_region1 = '#00aced';
        var c_region2 = '#004f6e';
        var c_region3 = '#4875b4';
        var c_region4 = '#00c204';
        var c_region5 = '#d38436';
        var c_region6 = '#f396cf';
        var c_region7 = '#96e7f3';

        $('#regionalChart').vectorMap({
          map: 'indonesia_id',
          backgroundColor: '#0b8fc1',
          borderColor: '#818181',
          borderRadius: '5px',
          borderOpacity: 0.25,
          borderWidth: 1,
          color: '#f4f3f0',
          enableZoom: true,
          hoverColor: '#c9dfaf',
          hoverOpacity: null,
          normalizeFunction: 'linear',
          scaleColors: ['#b6d6ff', '#005ace'],
          selectedColor: '#c9dfaf',
          selectedRegions: null,
          showTooltip: true,
          onRegionClick: function(element, code, region)
          {

            console.log(this);
              var message = region;

              console.log(message);
          },
          pins: <?= json_encode($regional); ?>,
        });

        $('#regionalChart').vectorMap('set', 'colors', { path01: c_region1, 
                                                    path02: c_region1,
                                                    path03: c_region1,
                                                    path04: c_region1,
                                                    path05: c_region1,
                                                    path06: c_region1,
                                                    path07: c_region1,
                                                    path08: c_region1,
                                                    path09: c_region1,
                                                    path10: c_region1,
                                                    
                                                    path11: c_region2,
                                                    path14: c_region2,

                                                    path12: c_region3,

                                                    path13: c_region4,
                                                    path16: c_region4,

                                                    path15: c_region5,
                                                    path17: c_region5,
                                                    path18: c_region5,
                                                    path19: c_region5,

                                                    path20: c_region6,
                                                    path21: c_region6,
                                                    path22: c_region6,
                                                    path23: c_region6,
                                                    path24: c_region6,

                                                    path25: c_region7,
                                                    path26: c_region7,
                                                    path27: c_region7,
                                                    path28: c_region7,
                                                    path29: c_region7,
                                                    path30: c_region7,
                                                    path31: c_region7,
                                                    path32: c_region7,
                                                    path33: c_region7,
                                                    path34: c_region7,
        });





  Highcharts.chart('chartSegmenScale', {
      chart: {
          type: 'bar',
          backgroundColor : '#ffffff93',
          height: '550px'
      },
      title: {
          text: ''
      },
      xAxis: {
          categories: <?= json_encode($segmen['s_name']); ?>
      },
      subtitle: {
          text: 'Segmen with Projects Scale'
      },
      yAxis: {
          min: 0,
          title: {
              text: ''
          }
      },
       tooltip: {
                    valueSuffix: ' Projects'
                  },
      legend: {
          reversed: true
      },
      credits: { text: ''},
      plotOptions: {
          series: {
              stacking: 'normal'
          }
      },
      series: <?= json_encode($segmen_scale); ?>,
      plotOptions: {
          bar: {
              dataLabels: {
                  enabled: true,
                  style: {
                      fontSize : '12px',
                      border : '0px',
                    },
                  color : '#000'
              }
          }
      },
  });


  Highcharts.chart('chartSegmenValue', {
      chart: {
          type: 'bar',
          backgroundColor : '#ffffff93',
          height: '550px'
      },
      title: {
          text: ''
      },
      xAxis: {
          categories: <?= json_encode($segmen['s_name']); ?>
      },
      subtitle: {
        text: 'Segmen Projects Value IDR in Billion' 
      },
      yAxis: {
          min: 0,
          title: {
              text: ''
          }
      },
      tooltip: {
                    valueSuffix: ' Billion'
                  },

      legend: {
          reversed: true
      },
      credits: { text: ''},
      plotOptions: {
          series: {
              stacking: 'normal'
          }
      },
      series: [{
                  name: 'Total Projects Value',
                  data: <?= json_encode($segmen_value) ?>
              }],
      plotOptions: {
          bar: {
              dataLabels: {
                  enabled: true,
                  style: {
                      fontSize : '10px',
                      border : '0px',
                    },
                  color : '#000'
              }
          }
      },
  });
      

  Highcharts.chart('chartSegmenProgress', {
      chart: {
          type: 'column',
          backgroundColor : '#ffffff93',
          height: '330px'
      },
      title: {
          text: ''
      },
      subtitle: {
          text: 'Segmen Projects Progress'
      },
      xAxis: {
          categories: <?= json_encode($segmen['s_name']); ?>
      },
      yAxis: {
          title: {
              text: ''
          },
          labels :{
              enabled : false,
          }

      },
      legend: {
          layout: 'vertical',
          align: 'right',
          verticalAlign: 'top',
          x: -40,
          y: 80,
          floating: true,
          borderWidth: 1,
          backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
          shadow: true
      },
      plotOptions: {
          series: {
              borderWidth: 0,
              dataLabels: {
                  enabled: true,
              }
          }
      },
      credits: {
          enabled: false
      },
      series: <?= json_encode($segmen_status); ?>
  });

</script>