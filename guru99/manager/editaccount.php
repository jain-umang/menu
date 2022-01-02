<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
?>
<?php
  include '..\loginsys\partials\_dbconnect.php';
  $sno=$name=$acc_type=$ini_deposit="";
  $showError= false;
$showSucc= false;
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    $sno=$_POST["sno"];
    $m_id=$_SESSION['m_id'];
    $sql= "SELECT * FROM `c_account` WHERE sno='$sno' AND `m_id`='$m_id'";
    
    $result = mysqli_query($conn, $sql);
    
    if($result !== false && mysqli_num_rows($result)> 0){

      $row = mysqli_fetch_assoc($result);
      $_SESSION["sno"]=$row['sno'];
      $_SESSION["name"]=$row['cname'];
      $_SESSION["acc_type"]=$row['a_type'];
      $_SESSION["ini_deposit"]=$row['amount'];
      echo $_SESSION["ini_deposit"];
      
      header("location:/guru99/manager/editaccount2.php");
    }
   
    else{
      $showError= "No such customers are found";
    }
  } 
  ?>





<!DOCTYPE html> 
<html lang="en">
<head>
  <title>Edit Account</title>
</head>
<style>
  h1 {color: white;}
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
<body>
 <?php require '..\loginsys\partials\_navm.php' ?>
<?php
    if($showError){         
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError . '</div>';
     }
     if($showSucc){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Success!</strong> '. $showSucc . '</div>';
     }
?> 
    <center>
  <h1>Edit Account</h1>
  <h4>Please enter the account number whose details you want to edit</h4>  
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
  ID: <input type="text" name="sno" value="<?php echo $sno;?>"required></br></br>
  <input type="submit" name="Submit" value="Submit">
  <input type="submit" name="Reset" value="Reset">
  <?php
  if(isset($_POST['Reset'])){
    $sno="";
    header("location:editaccount.php");
  }
  ?>
  </form>
  </center>
</body>
</html>

