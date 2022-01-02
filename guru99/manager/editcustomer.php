<!-- A session is a way to store information (in variables) to be used across multiple pages. -->

<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
?>

<?php
  include '..\loginsys\partials\_dbconnect.php';
  $sno=$name=$gender=$dob=$address=$city=$state=$pin=$m_no=$email=$m_id="";
$showError= false;
$showSucc= false;
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    $sno=$_POST["sno"];
    $name=$_POST["name"];
    $m_id=$_SESSION['m_id'];
   
    $sql= "SELECT * FROM `add_customer` WHERE sno='$sno' AND cname='$name' AND `m_id`='$m_id'";
    
    $result = mysqli_query($conn, $sql);
    
    if($result !== false && mysqli_num_rows($result)> 0){
      
      $row = mysqli_fetch_assoc($result);


      // echo $row["cname"]. "gybswafyhdjsw";
      $_SESSION["sno"]=$row["sno"];
      // echo $row["sno"]. "gybswafyhdjsw";
      $_SESSION["name"]=$row["cname"];
      $_SESSION["gender"]=$row["gender"];
      $_SESSION["dob"]=$row["dob"];
      $_SESSION["address"]=$row["address"];
      $_SESSION["city"]=$row["city"];
      $_SESSION["state"]=$row["state"];
      $_SESSION["pin"]=$row["pin"];
      $_SESSION["m_no"]=$row["m_no"];
      $_SESSION["email"]=$row["email"];
      
      //session VS code vale se related he and row database se related he
    
      header("location:/guru99/manager/editcustomer2.php");
      //never use \ in header file and don't give spaces-chinmay
    }
   
    else{
      $showError= "No such customers are found";
    }
  } 
  ?>

<!DOCTYPE html> 
<html lang="en">
<head>
  <title>Edit Customer</title>
</head>
<style>

  h1 {color: white;}
  .error{color:red;}
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
  <h1>Edit Customer</h1>
  <h4>Please enter the ID and Name of the customer whose detail you want to edit </h4>  
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
  ID: <input type="text" name="sno" value="<?php echo $sno;?>"required></br></br>
  NAME: <input type="text" name="name" value="<?php echo $name;?>"required></br></br>
  <input type="submit" name="Submit" value="Submit">
  <input type="submit" name="Reset" value="Reset">
  <?php
  if(isset($_POST['Reset'])){
    $sno=$name="";
    // $idErr=$nameErr="";
    header("location:editcustomer.php");
  }
  ?>
  </form>
  </center>
</body>
</html>



