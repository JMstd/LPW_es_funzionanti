// tutta sta roba dentro (document).ready e una jquery. posso usarla perche in html ho inserito lo script per le jquery

$(document).ready(function(){
	
	$("input[name=misura]:radio").change(function(){
	
		$("#miodiv").empty();
		var misura = $("input[name=misura]:checked").val();
		// va a prendere il json risultato dellesercizio prima, quindi devo correggere se sbagliato il json anche in questa cartella
		$.getJSON("api/ampiezza.php?misura=" + misura, function(data){
		
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
		
	});
	
	
	

});