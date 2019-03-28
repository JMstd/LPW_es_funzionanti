<?php

include('../php/funzioni.php');
header("Content-type: application/json");

$tipo_misura = analizza_GET();

$sql = "SELECT NumeroComponenti, Periodo, Valore 
		FROM AmpiezzaFamiglie 
		WHERE Misura = '".$tipo_misura."'";
		
$campi = array('NumeroComponenti' => 'intval', 'Valore' => 'floatval', 'Periodo' => 'intval');

echo esegui_query($sql, $campi);


?>