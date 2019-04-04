<?php

include('../php/funzioni.php');
header("Content-type: application/json");

$anno = analizza_GET('anno');

$sql = "SELECT Temp as y
		FROM monthly_t 
		WHERE Source = '".$anno."' and Year LIKE '19__' ORDER BY Year, Month ASC";

$campi = array('y' => 'floatval');

echo esegui_query($sql, $campi);

?>