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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Welcome Customer</title>
    <STYLE>
      body {
        /* margin-top: 40px; */
        /* margin-left: 50px;  */
        margin-bottom: 50px;
        /* background-color:pink; */


        /* <img src="components/bg_img.webp" alt="banking"> */

      }

      .button {
        /* display: grid;
        grid-gap: 50px;
        grid-template-columns: auto auto auto; */
        background-color: darkgrey;
        color: black;
        padding: 10px 30px;
        border: 1px solid black;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 15px;
        font-weight: bold;
        cursor: pointer;
        border-radius: 20px;
        /* margin-top: 40px; */
        margin-left: 50px;
      }

      h2 {
        color: white;
        text-align: center;
        font-size: 40px;
      }

      .bimg {
        background-image: url("https://images.unsplash.com/photo-1537724326059-2ea20251b9c8?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NXx8YmFua2luZ3xlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=60");
        background-size: cover;
        height: 100vh;
        /* viewport height */
        width: auto;
      }
    </STYLE>


  </head>

  <body>
    <!-- <?php require 'partials/_nav.php' ?> -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="/guru99/loginsys/login.php">Guru99 Bank</a>
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

    <div class="bimg">
      </br>
      <h2>Welcome To Customer's Page of GURU99 BANK</h2></br></br>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>
      <a href="/guru99/customer/cenquiry.php"><button class="button">Balance Enquiry</button></a></br></br>
      <a href="/guru99/customer/cfundtransfer.php"><button class="button">Fund Transfer</button></a></br></br>
      <a href="/guru99/customer/changepass.php"><button class="button">Change Password</button></a></br></br>
      <a href="/guru99/customer/cministat.php"><button class="button">Mini Statement</button></a></br></br>
      <a href="/guru99/customer/ccuststat.php"><button class="button">Customised Statement</button></br></br>
        <a href="logout.php"><button class="button">Log out</button></a></br>
    </div>

  </body>

  <head>
    <!-- <div id="carouselExampleInterval" class="carousel slide .carousel-fade" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="2000">
          <img src="https://source.unsplash.com/1000x300/?banking,money" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item" data-bs-interval="2000">
          <img src="https://source.unsplash.com/1000x300/?finance" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="https://source.unsplash.com/1000x300/?online,transfer" class="d-block w-100" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div> -->

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