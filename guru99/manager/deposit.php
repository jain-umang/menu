<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
?>
<?php
$name=$acc_id=$deposit=$description="";
$showError= false;
$showSucc= false;
include '../loginsys/partials/_dbconnect.php';
// include '../components/cust.css';
if($_SERVER['REQUEST_METHOD']=="POST"){
    $name=$_POST['name'];
    $acc_id=$_POST['sno'];
    $deposit=$_POST['deposit'];
    
    $description=$_POST['description'];
    $m_id=$_SESSION['m_id'];
    $sql="SELECT * FROM `c_account` WHERE `sno`='$acc_id' AND `m_id`='$m_id'";
    $result=mysqli_query($conn, $sql);
    if($result !== False && mysqli_num_rows($result) > 0){
      $row=mysqli_fetch_assoc($result);
      
      $ini_deposit=$row['amount'];
      $deposit=$_POST['deposit'];
      $total=0;
      $total=$ini_deposit+$deposit;
      $sql2 = "UPDATE `c_account` SET `amount`= '$total' WHERE `sno`='$acc_id'";
      if (mysqli_query($conn, $sql2)) {
          $showSucc= "Amount deposited successfully";
        } 
      else {
          echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
        }
        $sql3="INSERT INTO `transaction_table`(`payer_name`, `payee_name`, `payee_acc`, `payer_acc`, `type`, `amount`, `Description`) VALUES ('$name', '$name', '$acc_id','$acc_id','Deposit','$deposit','$description')";
        $result3=mysqli_query($conn, $sql3);
    }
    else{
      $showError= "Kindly check the details you have entered as no such account was found";
    }
}
?>



<html>

  <head>
    <link rel="stylesheet" href="..\components\cust.css">
    <style>
      h1 {
        color: white;
      }

      body {
        background-image: url("https://images.unsplash.com/photo-1537724326059-2ea20251b9c8?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NXx8YmFua2luZ3xlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=60");
        background-size: cover;
        height: 100vh;
        width: auto;
      }

      form {
        color: darkgreen;
        font-size: 20px;
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
        <h1 class="text-center">Deposit</h1>
        <h4 class="text-center">Please enter how much you want to deposit in the customer's account</h4>
        <!-- <p><span class="error">* required field</span></p> -->
      </div>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF"]);?>">

        <div class="row">
          <div class="col-25">
            <label for="fname">Customer Name:</label>
          </div>
          <div class="col-75">
            <input type="text" name="name" value="<?php echo $name;?>" required>
          </div>
        </div>
        <br><br>
        <div class="row">
          <div class="col-25">
            <label for="fname">Account Number:</label>
          </div>
          <div class="col-75">
            <input type="number" name="sno" value="<?php echo $acc_id;?>" required>
          </div>
        </div>
        <br><br>
        <div class="row">
          <div class="col-25">
            <label for="fname">Deposit:</label>
          </div>
          <div class="col-75">
            <input type="number" name="deposit" value="<?php echo $deposit;?>" required>
          </div>
        </div>
        <br><br>

        <div class="row">
          <div class="col-25">
            <label for="fname">Deposit:</label>
          </div>
          <div class="col-75">
            <textarea name="description" rows="5" cols="40"><?php echo $description;?></textarea></br>
          </div>
        </div>
        </br>
        <div class="row">
        <input type="submit" name="submit" value="SUBMIT">
        <input type="submit" name="reset" value="RESET">
        <?php
      if(isset($_POST['reset']))
      {
        header("location:deposit.php");
      }
      ?>
      </div>
      </form>
    </center>
  </body>
  <!-- </head> -->

</html>