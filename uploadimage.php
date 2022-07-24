<?php
include_once("dbconnect.php");

$productID=$_POST["uploadimageproductID"];
$targetDir = "uploads/" . $productID;
$imgfolderName = $targetDir . "/img";

if($_FILES["upload_image"]["name"] != '')
{
 $data = explode(".", $_FILES["upload_image"]["name"]);
 $extension = $data[1];
 $allowed_extension = array("jpg", "png", "gif");
 if(in_array($extension, $allowed_extension))
 {
  $new_file_name = $imgfolderName . '/' . $_FILES["upload_image"]["name"];
  if(move_uploaded_file($_FILES["upload_image"]["tmp_name"], $new_file_name))
  {
   echo 'Image Uploaded';
   return header("Location:index.php");
  }
  else
  {
   echo 'There is some error';
  }
 }
 else
 {
  echo 'Invalid Image File';
 }
}
else
{
 echo 'Please Select Image';
}
?>