<?php
// deve ricevere tramie GET i parametri per misura e in base a quello da qualcosa di diverso 
// -se misura = caratteristiche, restituisce i valori per 100 famiglie con le stesse caratteristiche 
// - se misura = migliaia restituisce i valori in migliaia

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

// if (!$risultato) die("Errore query: ".mysqli_error($conn)); secondo me ci puo' stare anche questo in quanto controlla se poi ci sono valori nel db questa cosa la infila nell'else

$return = array();

while($row=mysqli_fetch_assoc($risultato)){

	$row['NumeroComponenti'] = intval($row['NumeroComponenti']);
	$row['Valore'] = floatval($row['Valore']);
	$row['Periodo'] = floatval($row['Periodo']);
	$return[] = $row;
}

echo json_encode($return);
mysqli_close($conn);

}
else{
	echo json_encode(
		array( "status" => "errore",
			   "dettagli" => "parametro misura mancante"));
}
?>