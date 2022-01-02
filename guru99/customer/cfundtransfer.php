<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
$s_acc=$d_acc=$amt=$description="";
?>

<html>
<head>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
     <?php require '..\loginsys\partials\_navc.php' ?>

<center>
    <div class="container my-4">
      <h1 class="text-center">Fund Transfer</h1>
      <h4 class="text-center">Please enter details of Payer and Payee by filling the form below</h4>
    </div>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
    Payer's Account Number: <input type="text" name="s_acc" value="<?php echo $s_acc;?>"required>
        <br><br>
    Payee's Account Number: <input type="number" name="d_acc" value="<?php echo $d_acc;?>"required>
        <br><br>
    Amount: <input type="number" name="amt" value="<?php echo $amt;?>"required>
        <br><br>
    Description <br/><textarea name="description" rows="5" cols="40"><?php echo $description;?></textarea>
    </br></br>
      <input type="submit" name="submit" value="SUBMIT">  
      <input type="submit" name="reset" value="RESET">   
      <?php
      if(isset($_POST['reset']))
      {
        header("location:fundtransfer.php");
      }
      ?>              
</form>
</center>
</body>
</html>
<?php
$showError= false;
$showSucc= false;

include '../loginsys/partials/_dbconnect.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    $s_acc=$_POST['s_acc'];
    $d_acc=$_POST['d_acc'];
    $amt=$_POST['amt'];
    $description=$_POST['description'];
    $userid=$_SESSION['csno'];
    
    $sql="SELECT * FROM `c_account` WHERE `sno`='$s_acc' AND `c_id`='$userid'";
    $result=mysqli_query($conn, $sql);
    if($result !== False && mysqli_num_rows($result) > 0){
      $row=mysqli_fetch_assoc($result);
      $sname=$row['cname'];
      $ini_deposit=$row['amount'];
      
      $amt=$_POST['amt'];
      $total=0;
      $total=$ini_deposit-$amt;
        if($total>=0){
        $sql2 = "UPDATE `c_account` SET `amount`= '$total' WHERE `sno`='$s_acc'";
        $result2=mysqli_query($conn, $sql2);
        }
        else{
            $showError= " Customer's account doesn't have this much balance". "<br>" . "Please check the balance of Payer's account.";
      
        }
      }
        else{
         $showError= "The details of Payer's account does not match, please try again.";
        //  echo $showError;
        }
    
      

      
      $sql3="SELECT * FROM `c_account` WHERE `sno`='$d_acc'";
      $result3=mysqli_query($conn, $sql3);
      if($result3 !== False && mysqli_num_rows($result3) > 0){
      $row2=mysqli_fetch_assoc($result3);
      $ini_deposit2=$row2['amount'];
      $dname=$row2['cname'];
      // $amt=$_POST['amt'];
      $total2=0;
      $total2=$ini_deposit2+$amt;
      $sql4 = "UPDATE `c_account` SET `amount`= '$total2' WHERE `sno`='$d_acc'";
      $result4=mysqli_query($conn, $sql4);
      if (mysqli_query($conn, $sql4) && mysqli_query($conn, $sql2)) {
        $showSucc= "Amount transferred successfully";
        $d_acc=$_POST['d_acc'];
        $sql5="INSERT INTO `transaction_table`(`payer_name`, `payee_name`, `payee_acc`, `payer_acc`, `type`, `amount`, `Description`) 
        VALUES ('$sname', '$dname','$s_acc','$d_acc','Fund Transfer','$amt','$description')";
        $result5=mysqli_query($conn, $sql5);
      } 
      else {
        echo "Error:  <br>" . mysqli_error($conn);
      }
    

    }
    else{
      
      $showError= "Kindly check the details you have entered as no such account was found";
     
    }
}

    if($showError){         
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError . '</div>';
     }
     if($showSucc){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Success!</strong> '. $showSucc . '</div>';
     }
?>