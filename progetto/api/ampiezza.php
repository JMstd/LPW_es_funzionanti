<?php
include('config.php');
header('Content-Type: application/json'); //chiamata ad una funzione che setta il formato del risultato in json
// Non e' componenti famiglia come nelle slide ma come qui
// inoltre ho dovuto aggiungere il settaggio di NumeroComponenti in intval, altrimenti da errore ricevendo in return il risultato solo parzialment eritipato dentro al while
$sql = "SELECT NumeroComponenti,Valore,Periodo 
		FROM AmpiezzaFamiglie 
		WHERE Misura = 'valori in migliaia'";

$risultato = mysqli_query($conn,$sql);

if (!$risultato) die("Errore query: ".mysqli_error($conn));

$return = array();

while($row=mysqli_fetch_assoc($risultato)){
	
	$row['NumeroComponenti'] = intval($row['NumeroComponenti']);
	$row['Valore'] = floatval($row['Valore']);
	$row['Periodo'] = floatval($row['Periodo']);
	$return[] = $row;
}

echo json_encode($return);
mysqli_close($conn);
?>