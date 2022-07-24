<?php
$message='';

include_once("dbconnect.php");

if (!empty($_POST['username']) && !empty($_POST['password'])){
    if ($_POST['password'] == $_POST['passwordconfirm']){
        $sql = "INSERT INTO users (username, password,usertype) VALUES (:username, :password,'1')";
        $stmt = $database->prepare($sql);
        $stmt->bindParam(':username',$_POST['username']);
        $password_hashed = password_hash($_POST['password'],PASSWORD_BCRYPT);
        $stmt->bindParam(':password',$password_hashed);

        if ($stmt->execute()){
            $message = 'User created succesfully';
            header("Location: /dash/login.php");
        } else{
            $message = 'Error creating user on database';
        }
    } else{ 
    $message = 'Password mismatch';
    }
} else {
    $message = 'Missing elements for register';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="css/bootstrap.min.css">
     <!-- JS-->
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <title>Dash</title>
</head>
<body> 
<div class="container">
    <div class="row">
        <div class="col-md-12 min-vh-100 d-flex flex-column justify-content-center">
            <div class="row">
                <div class="col-lg-6 col-md-8 mx-auto">
                <?php if(!empty($message)): ?>
                <p> <?= $message ?></p>
                <?php endif; ?>
                    <!-- form card login -->
                    <div class="card rounded shadow shadow-sm">
                        <div class="card-header">
                            <h3 class="mb-0">Sign up as new user</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" id="formLogin" novalidate="" method="POST">
                                <div class="form-group">
                                    <label for="username">Choose your Username</label>
                                    <input type="text" class="form-control form-control-lg rounded-0" name="username" id="username" required="">
                                    <div class="invalid-feedback">Oops, you missed this one.</div>
                                </div>
                                <div class="form-group">
                                    <label for="password">Choose your Password</label>
                                    <input type="password" class="form-control form-control-lg rounded-0" name="password" id="password" required="" autocomplete="new-password">
                                    <div class="invalid-feedback">Enter your password too!</div>
                                </div>
                                <div class="form-group">
                                    <label for="passwordconfirm">Confirm your Password</label>
                                    <input type="password" class="form-control form-control-lg rounded-0" name="passwordconfirm" id="passwordconfirm" required="" autocomplete="new-password">
                                    <div class="invalid-feedback">Confirm your password!</div>
                                </div>
                                <button type="submit" class="btn btn-success btn-lg float-right" id="btnLogin">Sign up</button>
                            </form>
                        </div>
                        <!--/card-block-->
                    </div>
                    <!-- /form card login -->

                </div>


            </div>
            <!--/row-->

        </div>
        <!--/col-->
    </div>
    <!--/row-->
</div>
<!--/container-->
</body>
</html>