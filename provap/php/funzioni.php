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
	include('config.php');
	$risultato = mysqli_query($conn,$sql);

	$return = array();
	while($riga = mysqli_fetch_assoc($risultato))
	{
		foreach($campi as $chiave => $formato)
		{
			if(isset($riga[$chiave]))
				$riga[$chiave] = $formato($riga[$chiave]);
		}
		$return[] = $riga;
	};
	
	mysqli_close($conn);

	return json_encode($return);
}
?>