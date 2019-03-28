<?php 
//Questo file contiene i parametri di configurazione della connessione al database e aprirà la connessione al database. Il file config.php dovrà essere incluso in tutti gli script php che effettueranno l’accesso al database.

$database = "LPW";
$username = "root";
$password = "";
$servername = "localhost";
$conn =  mysqli_connect($servername,$username,$password,$database) or die("Errore connessione ".mysqli_connect_error($conn));


?>