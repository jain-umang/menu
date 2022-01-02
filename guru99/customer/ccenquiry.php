<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
$showError= false;
$showSucc= false;
?>


   

<!DOCTYPE html>

<head>
  
    <title>Balance Enquiry</title>
    <style>

  h1 {color: white;}
  h4 {color: white;}
  body {
        background-image: url("https://images.unsplash.com/photo-1537724326059-2ea20251b9c8?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NXx8YmFua2luZ3xlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=60");
        background-size: cover;
        height: 100vh;
        width: auto;
       }
  form{ color: darkgreen;
      font-size: 18px;
}
  </style>
      <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
</html>
     

<?php

include '..\loginsys\partials\_dbconnect.php';
require '..\loginsys\partials\_navc.php';

$c_id=$_SESSION['csno'];
$sql="SELECT *FROM `c_account` WHERE `c_id`='$c_id'";
$result=mysqli_query($conn, $sql);

// echo $c_id;
    if($result!== FALSE && mysqli_num_rows($result) > 0){
       while ($row=mysqli_fetch_assoc($result)){
        $name=$row['cname'];
        $money=$row['amount'];
    echo "<h4>"."<br>". "Account Holder Name: ". $name . "<br>"."</h4>";
    echo "<h4>"."Current Balance: ". $money . "<br>"."</h4>";}
    }
    else{
        $showError= "No accounts under your name";
    }
    if($showError){         
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError . '</div>';
     }
     if($showSucc){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Success!</strong> '. $showSucc . '</div>';
     }
?> 

