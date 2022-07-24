<?php

include_once("dbconnect.php");

$sentence=$database->query("SELECT * FROM products;");
$products=$sentence->fetchAll(PDO::FETCH_OBJ);


?>