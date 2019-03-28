<?php

include('../php/funzioni.php');
header("Content-type: application/json");

// prendo in ingresso l'anno
$anno = analizza_GET('anno');
// ATTENZIONE se prende in ingresso l'anno allora deve cambiare tutta la parte di controllo get e visto che in questo caso la scelta e tra valori obbligatori direi di togliere proprio il get

$sql = "SELECT Misura AS name, Valore as y
		FROM AmpiezzaFamiglie  
		WHERE Periodo = '".$anno."' and Misura = 'per 100 famiglie con le stesse caratteristiche'  and Misura <> 'totale'";

$campi = array('y' => 'floatval');
// attenzione vedere bene come uso questo array xke io cosi ho aggiunto solo una colonna
echo esegui_query($sql, $campi);


?>