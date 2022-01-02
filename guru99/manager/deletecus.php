<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
?>
<?php
$sno=$name="";
$showError= false;
$showSucc= false;
include '..\loginsys\partials\_dbconnect.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    $sno=$_POST['sno'];
    $name=$_POST['name'];
    $m_id=$_SESSION['m_id'];
    $sql="SELECT * FROM `c_account` WHERE `c_id`='$sno' AND `m_id`='$m_id'";
    $result=mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)== 0){
        $sql3="SELECT *FROM `add_customer` WHERE `sno`='$sno' AND `cname`='$name'";
        if(mysqli_query($conn, $sql3)){
          $sql2 = "DELETE FROM `add_customer` WHERE `sno`='$sno' AND `m_id`='$m_id'";
          $sql4 = "DELETE FROM `loginpage` WHERE `userid`='$sno'";
          if (mysqli_query($conn, $sql2) && mysqli_query($conn, $sql4)) {
              $showSucc= "Record deleted successfully";
          } 
          else {
              echo "Error deleting record: " . mysqli_error($conn);
          }
          // $sql3="DELETE FROM `loginpage` WHERE `userid`='$name'";
          // if (mysqli_query($conn, $sql3)) {
          //     echo "Record deleted successfully";  
          // } 
          // else {
          //     echo "Error deleting record: " . mysqli_error($conn);
          // }
        }
        else{
          $showError= "No such customer exists in your list";
          exit;
        }
    }
    elseif(mysqli_num_rows($result) > 0)
    {
            $showError= "There is already an account associated with this customer, kindly delete that account to delete the customer you entered";
        }
    }
   
?>
<html>
<head>
  <style>
  .error{color:red}
  body {
    margin-top: 10px;
    margin-left: 200px;
    background-color:lightgrey;
  }
  h1 {color: white;}

  h5 {color: lightblue;}
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
    <div class="container my-4">
      <h1 class="text-center">Delete Customer</h1>
      <h5 class="text-center">**Enter the Customer Id and Name to delete the customer</h5>
      <h5 class="text-center">**Make sure customer has no account in the bank</h5>
    </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
        Customer Id: <input type="number" name="sno" value="<?php echo $sno;?>"required>
        <!-- <span type="color:blue" class="error">* <?php echo $snoErr;?></span> -->
        </br></br>
        Customer Name: <input type="text" name="name" value="<?php echo $name;?>"required>
        <!-- <span type="color:blue" class="error">* <?php echo $nameErr;?></span> -->

        </br></br></br>
        <input type="submit" name="Delete" value="Delete">
        <input type="submit" name="Reset" value="Reset">
        <?php
          if(isset($_POST['Reset']))
        {
            header("location:deletecus.php");
        }

        ?>
</form>
      </center>
</body>
</html>