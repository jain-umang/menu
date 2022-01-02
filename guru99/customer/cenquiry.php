<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
$csno="";
$showError= false;
$showSucc= false;
}
?>
<html>
<head>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <title>Balance Enquiry</title>
</head>
<body>
  <?php require '..\loginsys\partials\_navc.php' ?>
 
    <center>
    <div class="container my-4">
      <h1 class="text-center">Balance Enquiry</h1>
      <h5 class="text-center">If you want to see the balance of a particular account, fill the details below else click on "View balance of all accounts"</h5>
    </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
        Account Number: <input type="text" name="csno" value="">
        <br><br>
        <input type="submit" name="Submit" value="Submit">
       
       
     
    </center>
</form>
<a href="/guru99/customer/ccenquiry.php"> <button>View balance of all accounts</button></a>
</body>
</html>

<?php
  $showError= false;
$showSucc= false;
include '..\loginsys\partials\_dbconnect.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    $sno=$_SESSION['csno'];
    $csno=$_POST['csno'];
   
    $sql="SELECT *FROM `c_account` WHERE `sno`='$csno' AND `c_id`='$sno'";
    $result=mysqli_query($conn, $sql);
    if($result!== FALSE && mysqli_num_rows($result) > 0){
        $row=mysqli_fetch_assoc($result);
        $name=$row['cname'];
        $money=$row['amount'];
    echo "<h4>". "<br>"."Account Holder Name: ". $name . "<br>". "</h4>";
    echo "<h4>"."Current Balance: ". $money . "<br>". "</h4>";
    }
    else{
        $showError= "Error: No such account exists, please check account number you have entered";
    }
}


if($showError){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
               <strong>Error!</strong> '. $showError . '
        
             </div>';
     }
     if($showSucc){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Success!</strong> '. $showSucc . '</div>';
     }
   
?>
