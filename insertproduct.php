<?php
  include_once("dbconnect.php");
  
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
  
  $sentence=$database->prepare("INSERT INTO products (Name,SupplierID,CategoryID,Qty,SerialNr,UnitPrice,Warehouse)
   VALUES(:Name,:SupplierID,:CategoryID,:Qty,:SerialNr,:UnitPrice,:Warehouse);");

 
  if (!$sentence) {
  echo "\nPDO::errorInfo():\n";
  print_r($sentence->errorInfo());
  }  
  
  $sentence->bindParam(':Name',$Name);
  $sentence->bindParam(':SupplierID',$SupplierID);
  $sentence->bindParam(':CategoryID',$CategoryID);
  $sentence->bindParam(':Qty',$Qty);
  $sentence->bindParam(':SerialNr',$SerialNr);
  $sentence->bindParam(':UnitPrice',$UnitPrice);
  $sentence->bindParam(':Warehouse',$Warehouse);
 
  
  if($sentence->execute()){
    $sentence2=$database->query("SELECT MAX(productID) FROM products;");
    $result = $sentence2->fetch(PDO::FETCH_BOTH);
    $productID = $result[0];
    $targetDir = "uploads/" . $productID;
    $imgfolderName = $targetDir . "/img";
    $docsfolderName = $targetDir . "/docs";
    $sentence3=$database->prepare("UPDATE products SET Picture=:Picture,Docs=:Docs WHERE productID=:productID;"); 
    $sentence3->bindParam(':productID',$productID);
    $sentence3->bindParam(':Picture',$imgfolderName);
    $sentence3->bindParam(':Docs',$docsfolderName);
    if($sentence3->execute()){
        if(!file_exists($targetDir)){
          mkdir($targetDir, 0777, true); 
          mkdir($imgfolderName, 0777, true);
          mkdir($docsfolderName, 0777, true);
          echo 'Folders Created';
        } else
        {
          echo 'Folders Already Created';
        }
    } else
    {
      echo "error sentence 3"  ; 
      return "error";
    }    
    return header("Location:index.php");
  } else
  {
    echo "error sentence" ;
    echo "\nPDOStatement::errorInfo():\n";
    $arr = $sentence->errorInfo();
    print_r($arr);
    return "error";
  }

?>