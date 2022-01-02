<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
?>

<?php
$sno="";
$showError= false;
$showSucc= false;
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
    .color{
        color:darkgrey;
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

<body>
    <center>
    <div class="container my-4">
      <h1 class="text-center">Mini Statement</h1>
    </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
        Account Number: <input type="text" name="sno" value="<?php echo $sno;?>"required>
        <!-- <span type="color:blue" class="error">* <?php echo $snoErr;?></span> -->
        <br><br>
        
        <input type="submit" name="Submit" value="Submit">
        <input type="submit" name="Reset" value="Reset">
       
          <?php
          if(isset($_POST['Reset']))
        {
            header("location:ministatement.php");
        }
        ?>
    </center>
</form>
<div class="color">
<?php
include '..\loginsys\partials\_dbconnect.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    $sno=$_POST['sno'];
    $sql="SELECT * FROM `c_account` WHERE `sno`='$sno'";
    $result=mysqli_query($conn, $sql);
    if($result!== FALSE && mysqli_num_rows($result) > 0){
        $sql2= "SELECT * FROM `transaction_table` WHERE `payee_acc`='$sno' OR `payer_acc`='$sno'";
        $result2=mysqli_query($conn, $sql2);
        while($row=mysqli_fetch_assoc($result2)){
            $jsonarr[]=json_encode($row);
        }
        $n=count($jsonarr);
        $arr=array_reverse($jsonarr);
        if($n<5){
            // print_r($arr);
            for($i=0;$i<$n;$i++){
                $serial_no=$i+1;
                echo "<h3>". "$serial_no - ". $arr[$i] .  "</h3>";
            }
        }
        else{
            for($index=0; $index<5; $index++){
                $s_number=$index+1;
                echo "<h3>". "$s_number - " . $arr[$index] . "</h3>";
            }
        }
    }
    else{
        $showError= "Error: No such account exists, please check account number you have entered";
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

</div>
</body>
</html>

