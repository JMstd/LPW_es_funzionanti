<?php

include('../php/funzioni.php');
header("Content-type: application/json");

$tipo_misura = analizza_GET("misura");

$sql = "SELECT Regione, TipoDato, Valore 
		FROM TipologiaFamiglie
		WHERE Misura = '".$tipo_misura."' ORDER BY Regione ASC";
		
$campi = array('Valore' => 'floatval', 'TipoDato' => 'utf8_encode');

echo esegui_query($sql, $campi);

?>