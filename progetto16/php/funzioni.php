<?php

function analizza_GET($parametro)
{
	if(isset($_GET[$parametro]))
	{

		$misura = $_GET[$parametro];
		/*$tipo_misura = "";
		switch($misura)
		{
			case 'caratteristiche':
				$tipo_misura = 'per 100 famiglie con le stesse caratteristiche';
				break;
			case 'migliaia':
				$tipo_misura = 'valori in migliaia'; 
				break;
			default:
				$tipo_misura = $misura;
		}*/
		return $misura;
	}
	else
	{
		echo json_encode(
			array(	"status" => "error",
			"dettagli" => "parametro $parametro mancante") 
		);
		exit(1);
	}	
}

function esegui_query($sql, $campi)
{
	include('config.php');
	$risultato = select($conn,$sql);

	$return = array();
	for($i = 0; $i < count($risultato); $i++)
	{
		foreach($campi as $chiave => $formato)
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