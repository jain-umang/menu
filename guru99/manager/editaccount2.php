<?php
include '..\loginsys\partials\_dbconnect.php';
session_start();
$sno=$_SESSION["sno"];
$name=$_SESSION["name"];
$acc_type=$_SESSION["acc_type"];
$ini_deposit=$_SESSION["ini_deposit"];
$showError= false;
$showSucc= false;
function test_input($data)
{
   $data=trim($data);
   $data=htmlspecialchars($data);
   $data=stripcslashes($data);
   return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $acc_type=$_POST['acc_type'];
  $ini_deposit=$_POST['deposit'];
$sql="UPDATE `c_account` SET `a_type`='$acc_type', `amount`='$ini_deposit' WHERE `sno`='$sno'";

if (mysqli_query($conn, $sql)) {
    $showSucc= "Account Updated Successfully";
    } 
else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<html>
<head>
  <style>

  h1 {color: white;}
  h5 {color: darkgreen;}
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
      <h1 class="text-center">Edit account by filling the form below</h1><br>
      <?php 
        echo "<h5>"."Customer Name: ". $name ."</h5>";
      ?>
    </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
    
        Account type: <select type="acc_type" name="acc_type">
                        <option value="current">Current</option>
                        <option value="savings">Savings</option>
                      </select>
        <br><br>
        Deposit: <input type="text" name="deposit" value="<?php echo $ini_deposit;?>"required>
        <br><br>
        <input type="submit" name="Submit" value="Submit">
        <input type="submit" name="Reset" value="Reset">
       
          <?php
          if(isset($_POST['Reset']))
        {
            header("location:editaccount2.php");
        }
        ?>
</form>
</body>
</html>