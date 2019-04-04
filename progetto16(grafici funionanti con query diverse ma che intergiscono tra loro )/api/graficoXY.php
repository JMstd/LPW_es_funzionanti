<?php
/*
include('../php/funzioni.php');
header("Content-type: application/json");

$anno = analizza_GET('radioPie');

$sql = "SELECT Source, Data, Mean 
		FROM monthly_csv 
		WHERE Source = '".$anno."'";

$campi = array('Mean' => 'floatval');

echo esegui_query($sql, $campi);

echo graficoXY($sql, $campi);
*/

include('../php/funzioni.php');
header("Content-type: application/json");

$anno = analizza_GET('anno');
$anno1 = analizza_GET('anno1');

$sql = "SELECT Temp as y
		FROM monthly_t 
		WHERE  Year = '".$anno1."' and Source  = '".$anno."'";

$campi = array('y' => 'floatval');

echo esegui_query($sql, $campi);

?>