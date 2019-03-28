<?php

function analizza_GET()
{
	if(isset($_GET['misura']))
	{

		$misura = $_GET['misura'];
		$tipo_misura = "";
		switch($misura)
		{
			case 'caratteristiche':
				$tipo_misura = 'per 100 famiglie con le stesse caratteristiche';
				break;
			case 'migliaia':
				$tipo_misura = 'valori in migliaia'; 
				break;
			default:
				echo json_encode(
					array("status" => "error",
					"dettagli" => "valore non riconosciuto"));
				exit(1);
		}
		return $tipo_misura;
	}
	else
	{
		echo json_encode(
			array(	"status" => "error",
			"dettagli" => "parametro misura mancante") 
		);
		exit(1);
	}	
}

function esegui_query($sql, $campi)
{
	include('config.php');//ho dubbi che posso includerlo cosi,penso serva mettere anche la cartella nel percorso
	$risultato = select($conn,$sql);

	$return = array();
	for($i = 0; $i < count($risultato); $i++)
	{
		foreach($campi as $chiave => $formato)// questo mi motiva xke larray che uso e fatto da 2 campi 
		{
			if(isset($risultato[$i][$chiave]))
				$risultato[$i][$chiave] = $formato($risultato[$i][$chiave]);
		}
		$return[] = $risultato[$i];
	}
	
	closeDB($conn);

	return json_encode($return);
}
?>