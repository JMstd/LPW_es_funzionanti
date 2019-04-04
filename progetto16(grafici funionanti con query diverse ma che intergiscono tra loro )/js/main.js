$(document).ready(function(){
	//crea_grafico_torta();
	graficoXY();
	graficoTot();

	//$("input[name=radioPie]:radio").change(crea_grafico_torta);
	$("input[name=radioPie1]:radio").change(graficoXY);	
	$("input[name=radioPie]:radio").change(graficoXY);
	$("input[name=radioPie]:radio").change(graficoTot);


});

function crea_grafico_torta()
{
	$("#pieChart").empty();
	var anno = $("input[name=radioPie]:checked").val();
	$.getJSON("api/pieChart.php?anno=" + anno, function(data){
		Highcharts.chart('pieChart', {
    	chart: {
       		plotBackgroundColor: null,
        	plotBorderWidth: null,
        	plotShadow: false,
        	height: 250,
        	type: 'pie'
    	},
    	title: {
        	text: null
    	},
    	tooltip: {
        	pointFormat: ' <b>{point.percentage:.1f}%</b>'
    	},
    	plotOptions: {
        	pie: {
            	allowPointSelect: true,
            	cursor: 'pointer',
            	dataLabels: {
                	enabled: true,
                	format: '<b>{point.name} Componenti</b>: {point.percentage:.1f} %',
                	style: {
                    	color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                	}
            	}
        	}
    	},
    	series: [{
        	name: 'Percentuale',
        	colorByPoint: true,
        	data: data
		}]
		});
	});
}

/*****************************************************************************************************/




function graficoTot(){

		$("#container").empty();
		var anno = $("input[name=radioPie]:checked").val();
		$.getJSON("api/grafic.php?anno=" + anno, function(data){
            var chart = {
               zoomType: 'x'
            }; 
            var title = {
               text: 'Monthly Average Temperature from 1900 through 2016'   
            };
            var subtitle = {
               text: document.ontouchstart === undefined ?
               'Click and drag in the plot area to zoom in' :
               'Pinch the chart to zoom in'
            };
            var xAxis = {
               type: 'datetime',
               minRange: 14 * 24 * 3600000 // fourteen days
            };
            var yAxis = {
               title: {
                  text: 'Temperature (\xB0C)'
               }
            };
            var legend = {
               enabled: false 
            };
            var plotOptions = {
               area: {
                  fillColor: {
                     linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1},
                     stops: [
                        [0, Highcharts.getOptions().colors[0]],
                        [1, Highcharts.Color(
                           Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                     ]
                  },
                  marker: {
                     radius: 2
                  },
                  lineWidth: 1,
                  states: {
                     hover: {
                        lineWidth: 1
                     }
                  },
                  threshold: null
               }
            };
            var series = [{
               turboThreshold:10000,	//set it to a larger threshold, it is by default to 1000
               type: 'area',
               name: 'Temperature Variability',
               pointInterval: 24 * 3600 * 1000 * 30,
               pointStart: Date.UTC(1900, 0, 6),
               data: data
              // visible: true
            }];
   
            var json = {};
            json.chart = chart;
            json.title = title;
            json.subtitle = subtitle;
            json.legend = legend;
            json.xAxis = xAxis;
            json.yAxis = yAxis;  
            json.series = series;
            json.plotOptions = plotOptions;

            $('#container').highcharts(json);
         });
	}


function graficoXY(){

		$("#container1").empty();
		var anno = $("input[name=radioPie]:checked").val();
		var anno1 = $("input[name=radioPie1]:checked").val();

//		var valore = $.getJSON("api/grafic.php?anno=" + anno, function(data){});

//var p= [/*-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0*/];

		$.getJSON("api/graficoXY.php?anno1=" + anno1 + "&anno=" + anno, function(data){

            var title = {
               text: 'Monthly Average Temperature'   
            };
            var subtitle = {
               text: 'Source: WorldClimate.com'
            };
            var xAxis = {
            	type: 'datetime',
        		minRange: 14 * 24 * 3600000 // fourteen days
               //categories: [/*'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'*/]
            };
            var yAxis = {
               title: {
                  text: 'Temperature (\xB0C)'
               },
               plotLines: [{
                  value: 0,
                  width: 1,
                  color: '#808080'
               }]
            };   

            var tooltip = {
               valueSuffix: '\xB0C'
            }
            var legend = {
               layout: 'vertical',
               align: 'right',
               verticalAlign: 'middle',
               borderWidth: 0
            };
 			
 			var series =  [{
 				  turboThreshold:10000,	//set it to a larger threshold, it is by default to 1000
                  name: anno1,
                pointInterval: 24 * 3600 * 1000 * 30,
               	pointStart: Date.UTC(2000, 0, 6),
                  data: data

               }, 
               {
                  name: 'New York',
                  data: [] //valore
               }, 
               {
                  name: 'Berlin',
                  data:[] //p               
              }, 
               {
                  name: 'London',
                  data: [/*3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 
                     16.6, 14.2, 10.3, 6.6, 4.8*/]
               }
            ];

			var json = {};
            json.title = title;
            json.subtitle = subtitle;
            json.xAxis = xAxis;
            json.yAxis = yAxis;
            json.tooltip = tooltip;
            json.legend = legend;
            json.series = series;

            $('#container1').highcharts(json);
	});

}



