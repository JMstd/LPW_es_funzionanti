<?php

include('config.php');
header('Content-Type: application/json');

if(isset($_GET['misura'])){
	$misura = $_GET['misura'];
	$tipo_misura = "";
	switch($misura){

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


$sql = "SELECT NumeroComponenti,Valore,Periodo 
		FROM AmpiezzaFamiglie 
		WHERE Misura = '".$tipo_misura."'";

$risultato = mysqli_query($conn,$sql);

$return = array();

while($row=mysqli_fetch_assoc($risultato)){

	$row['NumeroComponenti'] = intval($row['NumeroComponenti']);
	$row['Valore'] = floatval($row['Valore']);
	$row['Periodo'] = floatval($row['Periodo']);
	$return[] = $row;
}

echo json_encode($return); // al posto di restituire il json devo fare la tabella
mysqli_close($conn);

}
else{
	echo json_encode(
		array( "status" => "errore",
			   "dettagli" => "parametro misura mancante"));
}
?>