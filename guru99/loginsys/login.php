<?php
$login= false;
$showError= false;
if($_SERVER["REQUEST_METHOD"]== "POST"){
  include 'partials/_dbconnect.php';
    $username = $_POST["userid"];
    $password = $_POST["password"];

    // $usernamem = $_POST["useridm"];
    // $passwordm = $_POST["passwordm"];

    
    $sql= "Select * from loginpage where userid= '$username' and password= '$password'";
    $result= mysqli_query($conn, $sql);
    $sqlm= "Select * from manager_table where useridm= '$username' and passwordm='$password'";
    $resultm= mysqli_query($conn, $sqlm);
    if($num= mysqli_num_rows($result)){
      if($num>=1){
        $login= true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['userid'] = $username;
        $row2=mysqli_fetch_assoc($result);
        
        $_SESSION['csno']=$row2['userid'];
     
        header("location: customer.php");
        }
    }
    elseif($num_m= mysqli_num_rows($resultm)){
      if($num_m>=1){
        $login= true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['useridm'] = $username;
        $row= mysqli_fetch_assoc($resultm);
        $_SESSION['m_id']=$row['sno'];
        // $_SESSION['useridm']=$row['useridm'];
        header("location: manager.php");
        }
    }  
    else{
      $showError = "Invalid User Id or Password, please try again";
    }
}

?>




<!doctype html>
<html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Login Page</title>
    <style>
      .bimg {
        /* background-image: url("https://images.unsplash.com/photo-1565514020179-026b92b84bb6?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTMxfHxiYW5raW5nfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=60"); */
        background-image: url("https://images.unsplash.com/photo-1565374392032-8007fb37c26e?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NzB8fGJhbmtpbmd8ZW58MHx8MHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=60");
        /* background-image: url("https://images.unsplash.com/photo-1539622287262-61e066a2c534?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NDR8fGJhbmtpbmd8ZW58MHx8MHx8&ixlib=rb-1.5.1&auto=format&w=1000&q=600"); */
        background-size: cover;
        height: 100vh;
        /* viewport height */
        width: auto;
      }
      /* h1{
        color: lightgrey;
      } */
      form{
        color: black;
      }
    </style>
  </head>

  <body>
  <div class="bimg"> 
  <?php require 'partials/_nav.php' ?>

    <?php
    if($login){
     echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> You have been logged in.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    if($showError){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
               <strong>Error!</strong> '. $showError . '
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>';
     }
    ?>

    <div class="container my-4">
      <h1 class="text-center">Login Page</h1>
      <form action="/guru99/loginsys/login.php" method="post">
        <div class="mb-3">
          <label for="userid" class="form-label">User ID</label>
          <input type="text" class="form-control" id="userid" name="userid">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        <button type="submit" class="btn btn-primary" name="Reset">Reset</button>
        <?php
          if(isset($_POST['Reset'])){
            header("location: login.php");
          }
          ?>
      </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
      crossorigin="anonymous"></script>
</div> 
    <head>
      <div class="card text-center">
        <div class="card-header">
          Featured
        </div>
        <div class="card-body">
          <h5 class="card-title">About Us</h5>
          <p class="card-text">This was created by Umang Jain and for any issue kindly contact:
            umang.jain.appcrave@gmail.com</p>
        </div>
      </div>

    </head>
  
  </body>

</html>