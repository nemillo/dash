<?php

$password="weqmXe12345";
$user="epiz_28718908";
$namedb="epiz_28718908_myinv";
try {
    $database = new PDO('mysql:host=sql112.epizy.com;dbname='.$namedb,$user,$password);

} catch (Exception $e) {
    echo "<script>alert('Connection error')</script>";
}

?>