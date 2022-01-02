<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
$sno=$name=$money="";
$showError= false;
$showSucc= false;
?>
<html>
<head>
  <style>

  h1 {color: white;}
  h5 {color: green;}
  .error{color:red;}
  
  body {
        background-image: url("https://images.unsplash.com/photo-1537724326059-2ea20251b9c8?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NXx8YmFua2luZ3xlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=60");
        background-size: cover;
        height: 100vh;
        width: auto;
        /* color: green; */
       }


  form{ color: darkgreen;
      font-size: 18px;
}
  </style>
<title>Balance Enquiry</title>
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
      <h1 class="text-center">Balance Enquiry</h1>
    </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
        Account Number: <input type="text" name="sno" value="<?php echo $sno;?>"required>
        <br><br>
        <input type="submit" name="Submit" value="Submit">
        <input type="submit" name="Reset" value="Reset">
       
          <?php
          if(isset($_POST['Reset']))
        {
            header("location:enquiry.php");
        }
        ?>
    </center>
</form>
</body>
</html>

<?php

include '..\loginsys\partials\_dbconnect.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    $sno=$_POST['sno'];
    $m_id=$_SESSION['m_id'];
    $sql="SELECT *FROM `c_account` WHERE `sno`='$sno' AND `m_id`='$m_id'";
    $result=mysqli_query($conn, $sql);
    if($result!== FALSE && mysqli_num_rows($result) > 0){
        $row=mysqli_fetch_assoc($result);
        $name=$row['cname'];
        $money=$row['amount'];
    echo "<h5>"."Account Holder: ". $name . "<h5>"."<br>";
    echo "<h5>"."Current Balance: ". $money ."<h5>". "<br>";
    }
    else{
        $showError= "Error: No such account exists, please check account number you have entered";
    }
}
?>
