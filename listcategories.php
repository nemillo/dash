<?php

include_once("dbconnect.php");

$sentence=$database->query("SELECT * FROM categories;");
$categories=$sentence->fetchAll(PDO::FETCH_OBJ);


?>