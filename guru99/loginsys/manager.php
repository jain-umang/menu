<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    header("location: login.php");
    exit;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Welcome Manager </title>
  </head>
  <body>
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="/guru99/loginsys/manager.php">Guru99 Bank</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/guru99/loginsys/login.php">Log Out</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <STYLE>
body {
     /* margin-top: 40px; */
    /* margin-left: 50px;  */
    background-color:white;
}
.button {
  background-color:lightgrey;
  color: black;
  padding: 10px 30px;
  border: 1px solid black;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 15px;
  font-weight:bold;
  cursor: pointer;
  border-radius: 20px;
  margin-left: 150px;
}
.bimg {
        /* background-image: url("https://cdn.wallpapersafari.com/68/93/hSEvPY.jpg"); */
        background-image: url("https://images.unsplash.com/photo-1537724326059-2ea20251b9c8?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NXx8YmFua2luZ3xlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=60");
        background-size: cover;
        height: 100vh;
        /* viewport height */
        width: auto;
      }
h2 {color: white;text-align: center; font-size:40px;}

</STYLE>
<div class="bimg">
    </br>
<h2>Welcome To Manager's Page of GURU99 BANK</h2></br></br>
    <!-- Welcome Senor <?php echo ($_SESSION['useridm']) . "<br>"?> You are on Manager page -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

  <a href="/guru99/manager/addcustomer.php"><button class="button">New Customer</button></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  <a href="/guru99/manager/addaccount.php"><button class="button">New Account</button></a>&nbsp&nbsp&nbsp&nbsp
  <a href="/guru99/manager/deposit.php"><button class="button">Deposit</button></a></br></br>
  <a href="/guru99/manager/editcustomer.php"><button class="button">Edit Customer</button></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  <a href="/guru99/manager/editaccount.php"><button class="button">Edit Account</button></a>&nbsp&nbsp&nbsp&nbsp&nbsp
  <a href="/guru99/manager/withdrawal.php"><button class="button">Withdrawal</button></a></br></br>
  <a href="/guru99/manager/deletecus.php"><button class="button">Delete Customer</button></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  <a href="/guru99/manager/deleteacc.php"><button class="button">Delete Account</button></a>&nbsp
  <a href="/guru99/manager/fundtransfer.php"><button class="button">Fund Transfer</button></a></br></br>
  <a href="/guru99/manager/changepassword.php"><button class="button">Change Password</button></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  <a href="/guru99/manager/enquiry.php"><button class="button">Balance Enquiry</button></a>
  <a href="/guru99/manager/ministatement.php"><button class="button">Mini Statement</button></a></br></br>
  <a href="/guru99/manager/customised_stat.php"><button class="button">Customised Statement</button></a>
  <a href="logout.php"><button class="button">Log out</button></a></br>

</div>
</body>
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
</html>