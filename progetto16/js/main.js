$(document).ready(function(){
	
	//mostra_risultati();
	crea_grafico_torta();
	
	//$("input[name=misura]:radio").change(mostra_risultati);
	//$("input[name=api]:radio").change(mostra_risultati);
	$("input[name=radioPie]:radio").change(crea_grafico_torta);
	
	

});

function mostra_risultati()
{
		
		$("#miodiv").empty();
		var misura = $("input[name=misura]:checked").val();
		var api = $("input[name=api]:checked").val();
		
		
		$.getJSON("api/" + api + ".php?misura=" + misura, function(data){
		
			var tabella = "<table>";
		
			// inserisco i nomi delle colonne
			tabella = tabella + "<tr>";
			$.each(data[0], function(chiave,valore){
				tabella = tabella + "<td>" + chiave + "</td>";
			});
		
			tabella = tabella + "</tr>";
			
			for(var i = 0; i < data.length; i++)
			{
				tabella = tabella + "<tr>";
				$.each(data[i], function(chiave,valore){
					tabella = tabella + "<td>" + valore + "</td>";
				});
				tabella = tabella + "</tr>";
			}
			tabella = tabella + "</table>";
			$('#miodiv').append(tabella);
		});
		
}

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
        	pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
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