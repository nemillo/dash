<?php
  include_once("dbconnect.php");
  
  $productID=$_POST["removeproductID"];
  $Name=$_POST["removeproductName"];

  $targetDir = "uploads/" . $productID;
  $imgfolderName = $targetDir . "/img";
  $docsfolderName = $targetDir . "/docs";

  $imgfiles = scandir($imgfolderName);
  foreach($imgfiles as $file)
  {
   if($file === '.' or $file === '..')
   {
    continue;
   }
   else
   {
    unlink($imgfolderName . '/' . $file);
   }
  }
  if(!rmdir($imgfolderName)){
    echo "error img";
    return "error img";
  }
  
  $docsfiles = scandir($docsfolderName);
  foreach($docsfiles as $file)
  {
   if($file === '.' or $file === '..')
   {
    continue;
   }
   else
   {
    unlink($docsfolderName . '/' . $file);
   }
  }
  if(!rmdir($docsfolderName)){
    echo "error docs";
    return "error docs";
  }
   
  if(!rmdir($targetDir)){
    echo "error name";
    return "error name";
  }

  $sentence=$database->prepare("DELETE FROM products WHERE productID=:productID;"); 

  $sentence->bindParam(':productID',$productID);
  
  if($sentence->execute()){
      return header("Location:index.php");
  }
  else{
    echo "error SQL"  ;  
    echo "\nPDOStatement::errorInfo():\n";
    $arr = $sentence->errorInfo();
    print_r($arr);
    return "error";
  }

?>