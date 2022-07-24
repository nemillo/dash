<?php
  include_once("dbconnect.php");
  
  $productID=$_POST["editproductID"];
  $Name=$_POST["Name"];
  $Supplier=$_POST["Supplier"];
  $CategoryID=$_POST["CategoryID"];
  $Qty=$_POST["Qty"];
  $SerialNr=$_POST["SerialNr"];
  $UnitPrice=$_POST["UnitPrice"];
  $Warehouse=$_POST["Warehouse"];

  $sentencesupplier=$database->prepare("SELECT supplierID FROM suppliers WHERE Name=:supplierName;");
  $sentencesupplier->bindParam(':supplierName',$Supplier);
  if($sentencesupplier->execute()){
    $resultsupplier = $sentencesupplier->fetch(PDO::FETCH_BOTH);
    $SupplierID = $resultsupplier[0];
  }
  else{echo 'error sentence suppliers';}

  $sentence=$database->prepare("UPDATE products SET productID=:productID,Name=:Name,SupplierID=:SupplierID,CategoryID=:CategoryID,
  Qty=:Qty,SerialNr=:SerialNr,UnitPrice=:UnitPrice,Warehouse=:Warehouse WHERE productID=:productID;"); 

  $sentence->bindParam(':productID',$productID);
  $sentence->bindParam(':Name',$Name);
  $sentence->bindParam(':SupplierID',$SupplierID);
  $sentence->bindParam(':CategoryID',$CategoryID);
  $sentence->bindParam(':Qty',$Qty);
  $sentence->bindParam(':SerialNr',$SerialNr);
  $sentence->bindParam(':UnitPrice',$UnitPrice);
  $sentence->bindParam(':Warehouse',$Warehouse);

  if($sentence->execute()){
      return header("Location:index.php");
  }
  else{
    echo "error"  ; 
    $arr = $sentence->errorInfo();
    print_r($arr);
    return "error";
  }

?>