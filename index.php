<?php
  session_start();
  $user = null;
  include_once("dbconnect.php");
  if (isset($_SESSION['user_id'])) {
    $records = $database->prepare('SELECT userID, username, password FROM users WHERE userID = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    if (count($results) > 0) {
      $user = $results;
    }
  } else {
    header('Location: /dash/login.php');
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="css/image-popup.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <title>Dash</title>
  </head>

  <body>
  <div id="header">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">  
    <a class="navbar-brand" href=""><strong>My Inventory</strong></a>
        <ul class="nav nav-tabs me-auto mb-2 mb-lg-0">
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#Suppliers" id="SuppliersTab">Suppliers</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#Categories" id="CategoriesTab">Categories</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#Warehouses" id="WarehousesTab">Warehouses</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Products
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" data-bs-toggle="tab" data-bs-target="#ListProducts" id="ListProductsTab">List Products</a></li>
              <li><a class="dropdown-item" data-bs-toggle="tab" data-bs-target="#InsertProduct" id="NewProductTab">Add New Product</a></li>
          </ul>
          </li>
        </ul>
        <form class="row row-cols-lg-auto g-3 align-items-center">
          <div class="col-12">Logged in as <b><?php echo $user['username']; ?> </b> </div>
          <div class="col-12"><button class="btn btn-danger" type="submit" formaction="/dash/logout.php">Logout</button></div>
          <div class="col-12"><input class="form-control" type="search" placeholder="Search" aria-label="Search"></div>
          <div class="col-12"><button class="btn btn-outline-success" type="submit">Search</button></div>
        </form>
    </div>
    </nav>
</div>
<!-- Content -->
<div class="tab-content" id="tabcontent">
<div class="tab-pane container fade" id="Suppliers" role="tabpanel" tabindex="0">
<h1 class="text-center">Suppliers</h1>
       
       <br>
       <br>
       <table class="table table-striped">
        <thead>
         <tr>
          <th class="text-center" scope="col">supplierID</th>
          <th class="text-center" scope="col">Name</th>
          <th class="text-center" scope="col">Address</th>
          <th class="text-center" scope="col">Edit</th>
          <th class="text-center" scope="col">Remove</th>
          </tr>
         </thead>
       <tbody>
        <?php include_once("listsuppliers.php"); ?>
        <?php foreach($suppliers as $supplier) {?>
        <tr>
           <td class="text-center"><?php echo $supplier->supplierID?></td>
           <td class="text-center"><?php echo $supplier->name?></td>
           <td class="text-center"><?php echo $supplier->address?></td>
           <td><button type="button" class="btn btn-success editsupplierbtn" data-toggle="modal" data-target="#EditSupplier">Edit</button></td>
           <td><button type="button" class="btn btn-danger removesupplierbtn" data-toggle="modal" data-target="#RemoveSupplier">Remove</button></td>
        </tr>
        <?php }?>
       </tbody>
      </table>  
  </div>
  
  <div class="tab-pane fade" id="Categories" role="tabpanel" aria-labelledby="Categories" tabindex="0">
  <h1 class="text-center">Categories</h1>
       
       <br>
       <br>
       <table class="table table-striped">
        <thead>
         <tr>
          <th class="text-center" scope="col">categoryID</th>
          <th class="text-center" scope="col">Name</th>
          <th class="text-center" scope="col">Edit</th>
          <th class="text-center" scope="col">Remove</th>
          </tr>
         </thead>
       <tbody>
        <?php include_once("listcategories.php"); ?>
        <?php foreach($categories as $category) {?>
        <tr>
           <td class="text-center"><?php echo $category->categoryID?></td>
           <td class="text-center"><?php echo $category->categoryname?></td>
           <td><button type="button" class="btn btn-success editcategorybtn" data-toggle="modal" data-target="#EditCategory">Edit</button></td>
           <td><button type="button" class="btn btn-danger removecategoryrbtn" data-toggle="modal" data-target="#RemoveCategory">Remove</button></td>
        </tr>
        <?php }?>
       </tbody>
      </table>  
  </div>
  
  <div class="tab-pane fade" id="Warehouses" role="tabpanel" aria-labelledby="Warehouses" tabindex="0">
  <h1 class="text-center">Warehouses</h1>
       
       <br>
       <br>
       <table class="table table-striped">
        <thead>
         <tr>
          <th class="text-center" scope="col">warehouseID</th>
          <th class="text-center" scope="col">Name</th>
          <th class="text-center" scope="col">Address</th>
          <th class="text-center" scope="col">Edit</th>
          <th class="text-center" scope="col">Remove</th>
          </tr>
         </thead>
       <tbody>
        <?php include_once("listwarehouses.php"); ?>
        <?php foreach($warehouses as $warehouse) {?>
        <tr>
           <td class="text-center"><?php echo $warehouse->warehouseID?></td>
           <td class="text-center"><?php echo $warehouse->wname?></td>
           <td class="text-center"><?php echo $warehouse->waddress?></td>
           <td><button type="button" class="btn btn-success editwarehousebtn" data-toggle="modal" data-target="#EditWarehouse">Edit</button></td>
           <td><button type="button" class="btn btn-danger removewarehousebtn" data-toggle="modal" data-target="#RemoveWarehouse">Remove</button></td>
        </tr>
        <?php }?>
       </tbody>
      </table>  
  </div>
  
  <div class="tab-pane fade active" id="ListProducts" role="tabpanel" aria-labelledby="ListProducts">
    <h1 class="text-center">Products</h1>
       
    <br>
    <br>
    <table class="table table-striped">
     <thead>
      <tr>
       <th class="text-center" scope="col">productID</th>
       <th class="text-center" scope="col">Name</th>
       <th class="text-center" scope="col">Supplier</th>
       <th class="text-center" scope="col">Category</th>
       <th class="text-center" scope="col">Quantity</th>
       <th class="text-center" scope="col">Serial Number</th>
       <th class="text-center" scope="col">Pictures</th>
       <th class="text-center" scope="col">Documents</th>
       <th class="text-center" scope="col">Unit Price</th>
       <th class="text-center" scope="col">Warehouse</th>
       <th class="text-center" scope="col">Edit</th>
       <th class="text-center" scope="col">Remove</th>
       </tr>
      </thead>
    <tbody>
     <?php include_once("listproducts.php"); ?>
     <?php foreach($products as $product) {
        $sentencesuppliername=$database->prepare("SELECT Name FROM suppliers WHERE supplierID=:supplierID;");
        $sentencesuppliername->bindParam(':supplierID', $product->SupplierID);
        if($sentencesuppliername->execute()){
          $resultsuppliername = $sentencesuppliername->fetch(PDO::FETCH_BOTH);
          $SupplierName = $resultsuppliername[0];
        }

        $sentencecategoryname=$database->prepare("SELECT categoryname FROM categories WHERE categoryID=:categoryID;");
        $sentencecategoryname->bindParam(':categoryID', $product->CategoryID);
        if($sentencecategoryname->execute()){
          $resultcategoryname = $sentencecategoryname->fetch(PDO::FETCH_BOTH);
          $CategoryName = $resultcategoryname[0];
        }

        $sentencewarehousename=$database->prepare("SELECT wname FROM warehouse WHERE warehouseID=:warehouseID;");
        $sentencewarehousename->bindParam(':warehouseID', $product->Warehouse);
        if($sentencewarehousename->execute()){
          $resultwarehousename = $sentencewarehousename->fetch(PDO::FETCH_BOTH);
          $WarehouseName = $resultwarehousename[0];
        }
      ?>
     <tr>
        <td class="text-center"><?php echo $product->productID?></td>
        <td class="text-center"><?php echo $product->Name?></td>
        <td class="text-center"><?php echo $SupplierName?></td>
        <td class="text-center"><?php echo $CategoryName?></td>
        <td class="text-center"><?php echo $product->Qty?></td>
        <td class="text-center"><?php echo $product->SerialNr?></td>
        <td><button type="button" class="btn btn-primary viewimagesbtn" data-toggle="modal" data-target="#ViewImages">View Images</button>  <button type="button" class="btn btn-secondary uploadimagesbtn" data-toggle="modal" data-target="#UploadImages">Upload Images</button></td>
        <td><button type="button" class="btn btn-primary viewdocsbtn" data-toggle="modal">View Docs</button>   <button type="button" class="btn btn-secondary uploaddocsbtn" data-toggle="modal" data-target="#UploadDocs">Upload Docs</button></td>
        <td class="text-center"><?php echo $product->UnitPrice?></td>
        <td class="text-center"><?php echo $WarehouseName?></td>
        <td><button type="button" class="btn btn-success editbtn" data-toggle="modal" data-target="#EditProduct">Edit</button></td>
        <td><button type="button" class="btn btn-danger removebtn" data-toggle="modal" data-target="#RemoveProduct">Remove</button></td>
     </tr>
     <?php }?>
    </tbody>
   </table>  
  </div>
  <!-- Modal Insert Product -->
 <div class="modal fade" id="InsertProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="insertproduct.php" method="POST" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Insert Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="form-group">
          <label for="">Product Name</label>
          <input type="text" name="Name" class="form-control">
          </div> 
          <div class="form-group">
          <label for="">Supplier</label>
          <select class="form-control" name="Supplier" id="Supplier">
          <?php foreach($suppliers as $supplier) {?>
           <option class="text-center"><?php echo $supplier->name?></option>
          <?php }?>
          </select>
          </div> 
          <div class="form-group">
          <label for="">Category</label>
          <select class="form-control" name="Category" id="Category">
          <?php foreach($categories as $category) {?>
           <option class="text-center"><?php echo $category->categoryname?></option>
          <?php }?>
          </select>
          </div> 
          <div class="form-group">
          <label for="">Quantity</label>
          <input type="text" name="Qty" class="form-control">
          </div> 
          <div class="form-group">
          <label for="">Serial Number</label>
          <input type="text" name="SerialNr" class="form-control">
          </div> 
          <div class="form-group">
          <label for="">Unit Price</label>
          <input type="text" name="UnitPrice" class="form-control">
          </div> 
          <div class="form-group">
          <label for="">Warehouse</label>
          <select class="form-control" name="Warehouse" id="Warehouse">
          <?php foreach($warehouses as $warehouse) {?>
           <option class="text-center"><?php echo $warehouse->wname?></option>
          <?php }?>
          </select>
          </div>   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Insert Product</button>
      </div>
      </form>
    </div>
   </div>
  </div>

<!-- Modal Edit Product -->
<div class="modal fade" id="EditProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="editproduct.php" method="POST">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
          <input type="hidden" name="editproductID" id="editproductID" class="form-control">
          </div>   
          <div class="form-group">
          <label for="">Product Name</label>
          <input type="text" name="Name" id="Name" class="form-control">
          </div> 
         <div class="form-group">
          <label for="">Supplier</label>
          <select class="form-control" name="Supplier" id="Supplier">
          <?php foreach($suppliers as $supplier) {?>
           <option class="text-center"><?php echo $supplier->name?></option>
          <?php }?>
          </select>
          </div> 
          <div class="form-group">
          <label for="">CategoryID</label>
          <input type="text" name="CategoryID" id="CategoryID" class="form-control">
          </div> 
          <div class="form-group">
          <label for="">Quantity</label>
          <input type="text" name="Qty" id="Qty" class="form-control">
          </div> 
          <div class="form-group">
          <label for="">Serial Number</label>
          <input type="text" name="SerialNr" id="SerialNr" class="form-control">
          </div> 
          <div class="form-group">
          <label for="">Unit Price</label>
          <input type="text" name="UnitPrice" id="UnitPrice" class="form-control">
          </div> 
          <div class="form-group">
          <label for="">Warehouse</label>
          <input type="text" name="Warehouse" id="Warehouse" class="form-control">
          </div>   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </div>
      </form>
    </div>
   </div>
 </div>

<!-- Modal Remove Product -->
<div class="modal fade" id="RemoveProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="removeproduct.php" method="POST">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Remove Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <h4>Are you sure?</h4>
          <input type="hidden" name="removeproductID" id="removeproductID">
          <input type="hidden" name="removeproductName" id="removeproductName">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-primary">Yes, remove</button>
      </div>
      </form>
    </div>
   </div>
 </div>

 <!-- Modal Upload Picture-->
 <div class="modal fade" id="UploadImages"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog" role="document">
  <div class="modal-content">
   <form action="uploadimage.php" method="POST" id="upload_form" enctype='multipart/form-data'>
   <div class="modal-header">
   <h5 class="modal-title" id="exampleModalLabel">Upload Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
   </div>
   <div class="modal-body">
     <h4>Select Image</h4>
     <input type="hidden" name="uploadimageproductID" id="uploadimageproductID">
     <input type="file" name="upload_image" /></p>
     <br />
     <input type="submit" name="upload_button" class="btn btn-info" value="Upload" />
    </form>
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>

<!-- Modal View Pictures-->
<div class="modal fade" id="ViewImages" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog" role="document">
  <div class="modal-content">
   <div class="modal-header">
   <h5 class="modal-title" id="exampleModalLabel">View Images</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
   </div>
   <div class="modal-body" id="image_list">
    
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>

<div id="popup-background" class="popup-background" style="display: none;">
    <div class="popup-content">
        <div id="popup-title"></div>
        <img id="popup-image" class="popup-image">
    </div>
</div>

<script>
  document.querySelector('.editbtn').addEventListener('click', function () {
  var tr=document.querySelector('.editbtn').closest('tr');
  var data=tr.children;
  document.getElementById("editproductID").value = data[0].innerText;
  document.getElementById("Name").value = data[1].innerText;
  document.getElementById("Supplier").value = data[2].innerText;
  document.getElementById("CategoryID").value = data[3].innerText;
  document.getElementById("Qty").value = data[4].innerText;
  document.getElementById("SerialNr").value = data[5].innerText;
  document.getElementById("UnitPrice").value = data[8].innerText;
  document.getElementById("Warehouse").value = data[9].innerText;
  });
</script>

<script>
  document.querySelector('.removebtn').addEventListener('click', function () {
  var tr=document.querySelector('.removebtn').closest('tr');
  var data=tr.children;
  console.log(data);
  document.getElementById("removeproductID").value = data[0].innerText;
  document.getElementById("removeproductName").value = data[1].innerText;  
  });
</script>

<script>
  document.querySelector('.uploadimagesbtn').addEventListener('click', function () {
  var tr=document.querySelector('.uploadimagesbtn').closest('tr');
  var data=tr.children;
  document.getElementById("uploadimageproductID").value = data[0].innerText;
  });
</script>

<script>
  document.querySelector('.viewimagesbtn').addEventListener('click', function () {
  var tr=document.querySelector('.viewimagesbtn').closest('tr');
  var data=tr.children;
  var request = new XMLHttpRequest();
  request.open('POST', 'viewimages.php', true);
  request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  request.onreadystatechange = function() {
    if (this.status >= 200 && this.status < 400) {
    // Success!
    var resp = this.response;
    document.getElementById("image_list").innerHTML = resp;
    } else {
    // We reached our target server, but it returned an error

    }
  };
  request.onerror = function() {
  // There was a connection error of some sort
  };

  request.send('viewimagesproductID='+data[0].innerText);
  });  
</script>

<script>
  document.addEventListener('click', function(event) {
  if (event.target.name == "removeimagebtn") {
    var path = event.target.id;
    if(confirm("Are you sure you want to remove this image?"))
    {
      var request = new XMLHttpRequest();
      request.open('POST', 'removeimage.php', true);
      request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      request.onreadystatechange = function() {
        if (this.status >= 200 && this.status < 400) {
        // Success!
        var modal = document.getElementById('ViewImages');
        

        // change state like in hidden modal
        modal.classList.remove('show');
        modal.setAttribute('aria-hidden', 'true');

        } else {
        // We reached our target server, but it returned an error

       }
    };
    request.onerror = function() {
  // There was a connection error of some sort
    };

    request.send('path='+path);
    }
  }
  });
</script>

<script>
  let popupBackground = document.querySelector("#popup-background");
  let popupImage = document.querySelector("#popup-image");
  var modal = document.getElementById('ViewImages');

  document.addEventListener('click', function(event) {
  if (event.target.name == "image-popup") {
        popupBackground.style.display = "block";
        popupImage.src = event.target.src;
        // change state like in hidden modal
        modal.classList.remove('show');
        modal.setAttribute('aria-hidden', 'true');
    }
  });

  popupBackground.addEventListener("click", function(){
    popupBackground.style.display = "none";
    modal.classList.add('show');
    modal.setAttribute('aria-hidden', 'false');
  })
</script>

</div>
   
</body>
</html>
