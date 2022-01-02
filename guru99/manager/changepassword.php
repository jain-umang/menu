<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
?>
<?php
$password=$npassword=$cnpassword="";
$showError= false;
$showSucc= false;
include '..\loginsys\partials\_dbconnect.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    // $useridm=$_POST['useridm'];
    $password=$_POST['password'];
    $npassword=$_POST['npassword'];
    $cnpassword=$_POST['cnpassword'];
    $msno=$_SESSION['m_id'];
    $sql="SELECT * FROM `manager_table` WHERE `sno`=$msno";
    $result=mysqli_query($conn, $sql);
    $row=mysqli_fetch_assoc($result);
    $passworduj=$row['passwordm'];
    if($password===$passworduj){
      if($npassword===$cnpassword){
        $sql2="UPDATE `manager_table` SET `passwordm`='$npassword' WHERE `sno`='$msno'";
        $result2=mysqli_query($conn, $sql2);
        $showSucc= "Old Password changed successfully";
      }
      else{
        $showError= "New Password and Confirm Password do not match";
      }
    }
    else{
      $showError= "Please enter your Current Password correctly";
    }

}
?>


<html>
<head>
  <style>
  .error{color:red}

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
  <?php require '..\loginsys\partials\_navm.php' ?>
<?php
if($showError){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
               <strong>Error!</strong> '. $showError . '
        
             </div>';
     }
     if($showSucc){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Success!</strong> '. $showSucc . '</div>';
     }
    ?>
    <center>
    <div class="container my-4">
      <h1 class="text-center">Change your current password</h1></br>
    </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    Current Password: <input type="password" name="password" value="<?php echo $password;?>">
    </br></br>
    New Password: <input type="password" name="npassword" value="<?php echo $npassword;?>">
    </br></br>
    Confirm New Password: <input type="password" name="cnpassword" value="<?php echo $cnpassword;?>">
    </br></br>
    <input type="submit" name="Submit" value="Submit">
    <input type="submit" name="Reset" value="Reset">  
        <?php
          if(isset($_POST['Reset']))
        {
            $password=$npassword=$cnpassword="";
          header("location:changepassword.php");
        }
        ?>
</form>
      </center>
</body>
</html>