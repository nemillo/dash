<?php
  include_once("dbconnect.php");

  $productID=$_POST["viewimagesproductID"];
  $targetDir = "uploads/" . $productID;
  $imgfolderName = $targetDir . "/img";

  $file_data = scandir($imgfolderName);
  $output = '
  <table class="table table-bordered table-striped">
   <tr>
    <th>Image</th>
    <th>File Name</th>
    <th>Delete</th>
   </tr>
  ';
  
  foreach($file_data as $file)
  {
   if($file === '.' or $file === '..')
   {
    continue;
   }
   else
   {
    $path = $imgfolderName . '/' . $file;
    $output .= '
    <tr>
     <td><img src="'.$path.'" name="image-popup" class="image-popup" height="50" width="50" /></td>
     <td contenteditable="true" data-folder_name="'.$imgfolderName.'"  data-file_name = "'.$file.'" class="change_file_name">'.$file.'</td>
     <td><button name="removeimagebtn" class="removeimagebtn btn btn-danger btn-xs" id="'.$path.'">Remove</button></td>
    </tr>
    ';
   }
  }
  $output .='</table>';
  echo $output;
 ?>