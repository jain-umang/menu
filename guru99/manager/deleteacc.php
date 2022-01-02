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
    // $acc_type=$_POST['acc_type'];
    $sql="SELECT * FROM `c_account` WHERE `sno`='$sno' AND `cname`='$name'";
    $result=mysqli_query($conn, $sql);
    if($result !== false && mysqli_num_rows($result)> 0){
        $row = mysqli_fetch_assoc($result);
        $amount= $row['amount'];
        if($amount==0){
            $sql2 = "DELETE FROM `c_account` WHERE `sno`='$sno'";
            if (mysqli_query($conn, $sql2)) {
                $showSucc= "Record deleted successfully";
                } 
            else {
                echo "Error deleting record: " . mysqli_error($conn);
                }
            }
        else{
            $showError= "The account you want to delete still has some money left in it so kindly transfer/withdraw that amount to delete this account";
        }
    }
    else {
        $showError= "Account details do not match, please try again";
    }
}
?>
<html>
<head>
  <style>
  .error{color:red}
  body {
    margin-top: 10px;
    /* margin-left: 200px; */
    background-color:lightgrey;
  }
  h1 {color: white;}
  h3 {
      color: lightgrey;
      font-family: papyrus;
}
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
      <h1 class="text-center">Delete account</h1>
      <h3 class="text-center">enter the account number and name to delete the account</h3>
    </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
        Account Number: <input type="text" name="sno" value="<?php echo $sno;?>"required>
        <!-- <span type="color:blue" class="error">* <?php echo $snoErr;?></span> -->
        </br></br>
        Account Name: <input type="text" name="name" value="<?php echo $name;?>"required>
        <!-- <span type="color:blue" class="error">* <?php echo $nameErr;?></span> -->
        <br></br>
     
        <input type="submit" name="Delete" value="Delete">
        <input type="submit" name="Reset" value="Reset">
        <?php
          if(isset($_POST['Reset']))
        {
            header("location:deleteacc.php");
        }

        ?>
</form>
 <center>
</body>
</html>