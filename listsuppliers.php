<?php

include_once("dbconnect.php");

$sentence=$database->query("SELECT * FROM suppliers;");
$suppliers=$sentence->fetchAll(PDO::FETCH_OBJ);


?>