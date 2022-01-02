<?php
$userid=$password=$sno=$fdate=$tdate=$amt=$num="";
$showError= false;
$showSucc= false;
?>
<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
?>
<?php
include '..\loginsys\partials\_dbconnect.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    $userid=$_POST['userid'];
    $password=$_POST['password'];
    $sno=$_POST['sno'];
    $fdate=$_POST['fdate'];
    $tdate=$_POST['tdate'];
    $amt=$_POST['amt'];
    $num=$_POST['num'];
    // $userid=$row['userid'];
    
    // $userid=$_SESSION['userid'];
    // $password=$_SESSION['password'];
    
    $sqli="SELECT * FROM `loginpage` WHERE `userid`='$userid' AND `password`='$password'";
    $result3=mysqli_query($conn, $sqli);
    if($result3!==FALSE && mysqli_num_rows($result3) > 0){
        $sql="SELECT * FROM `c_account` WHERE `sno`='$sno'";
        $result=mysqli_query($conn, $sql);
        if($result!== FALSE && mysqli_num_rows($result) > 0){

            // $sql2= "SELECT * FROM `transaction_table` WHERE (`payee_acc`='$sno' OR `payer_acc`='$sno') AND (amount > '$amt')";
            $sql2= "SELECT * FROM `transaction_table` WHERE `payee_acc`='$sno' OR `payer_acc`='$sno'";
            $result2=mysqli_query($conn, $sql2);
            if($result2!==FALSE && mysqli_num_rows($result2) > 0){
                
                while($row=mysqli_fetch_assoc($result2)){
                    $moneyy=$row['amount'];
                    if($moneyy>$amt){
                        if($row['date_time']>=$fdate && $row['date_time']<=$tdate)
                    
                        {$jsonarr[]=json_encode($row);}
                        else {
                            $showError="No records found on the entered date !!";
                            exit;
                        }
                    }
                }
            
                $n=count($jsonarr);
                $arr=array_reverse($jsonarr);
                if($n<$num){
                    // print_r($arr);
                    for($i=0;$i<$n;$i++){
                        $serial_no=$i+1;
                        echo "<h3>". "$serial_no - ". $arr[$i] .  "</h3>";
                    }
                }
                else{
                    for($index=0; $index<$num; $index++){
                        $s_number=$index+1;
                        echo "<h3>". "$s_number - " . $arr[$index] . "</h3>";
                    }
                }
            }
        }
        else{
            $showError= "Error: No such account exists, please check account details you have entered";
           }
    }
    else{
        $showError= "The Cusotmer UserId or Password is incorrect, please try again.";
        
    }
    


}



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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
      
</head>
<body>
 <?php require '..\loginsys\partials\_navm.php' ;
     if($showError){  
          
      echo '<div class="alert  alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError . '</div>';

    }
     
     if($showSucc){
      echo '<div class="alert  alert-success alert-dismissible fade show" role="alert"> <strong>Success!</strong> '. $showSucc . '</div>';
      
     }

 ?>

    <center>
    <div class="container my-4">
      <h1 class="text-center">Customised Statement</h1>
    </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
        
        
        Customer User ID: <input type="number" name="userid" value="<?php echo $userid;?>"required>
        <br><br>
        Password: <input type="password" name="password" value="<?php echo $password;?>"required>
        <br><br>
        Account Number: <input type="number" name="sno" value="<?php echo $sno;?>"required>
        <br><br>
        From Date: <input type="Date" name="fdate" value="<?php echo $fdate;?>"required>
        <br><br>
        To Date: <input type="Date" name="tdate" value="<?php echo $tdate;?>"required>
        <br><br>
        Amount Lower Limit <input type="number" name="amt" value="<?php echo $amt;?>"required>
        <br><br>
        Number of Transactions: <input type="number" name="num" value="<?php echo $num;?>"required>
        <br><br>
        <input type="submit" name="Submit" value="Submit">
        <input type="submit" name="Reset" value="Reset">
        <?php
          if(isset($_POST['Reset']))
        {
            header("location:customised_stat.php");
        }
        ?>
    </center>
</form>

      
    </body>
</html>

