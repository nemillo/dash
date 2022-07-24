<?php

include_once("dbconnect.php");

$sentence=$database->query("SELECT * FROM warehouse;");
$warehouses=$sentence->fetchAll(PDO::FETCH_OBJ);


?>