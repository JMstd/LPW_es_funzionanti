<?php

function analizza_GET($parametro)
{
	if(isset($_GET[$parametro]))
	{

		$misura = $_GET[$parametro];
		$tipo_misura = "";
		switch($misura)
		{
			case 'GCAG':
				$tipo_misura = 'GCAG';
				break;
			case 'GISTEMP':
				$tipo_misura = 'GISTEMP'; 
				break;
			case '2013':
				$tipo_misura = '2013'; 
				break;
			case '2014':
				$tipo_misura = '2014'; 
				break;
			default:
				$tipo_misura = $misura;
		}
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