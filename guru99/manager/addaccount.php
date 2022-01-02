<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
?>
<?php
$sno=$name=$acc_type=$ini_deposit="";
$acc_typeErr=$ini_depositErr="";
$showError= false;
$showSucc= false;
include '..\loginsys\partials\_dbconnect.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(empty($_POST['ini_deposit'])){
        $ini_depositErr= "Some initial amount is to be depositted";
    }
    else{
        $ini_deposit=test_input($_POST['ini_deposit']);
    }
    
    $sno=$_POST['sno'];
    $name=$_POST['name'];
    $sql="SELECT * FROM `add_customer` WHERE sno='$sno' AND cname='$name'";
    $result=mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $row=mysqli_fetch_assoc($result);
        $c_id=$row['sno'];
        $acc_type=$_POST['acc_type'];
        $ini_deposit=$_POST['ini_deposit'];
        $m_id=$_SESSION['m_id'];
        
        $sql2="INSERT INTO `c_account` (`c_id`, `cname`, `a_type`, `amount`, `m_id`) VALUES ('$c_id', '$name', '$acc_type', '$ini_deposit', '$m_id');";
        if(mysqli_query($conn, $sql2)){
            $showSucc= "New account added successfully";
        }
        else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        
    }
    else{
        $showError= "No such customer found, please check the Customer ID and Name";
    }
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;}
    
?>

<html>
<head>
  <style>
  .error{color:red}
body {
        background-image: url("https://images.unsplash.com/photo-1537724326059-2ea20251b9c8?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NXx8YmFua2luZ3xlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=60");
        background-size: cover;
        height: 100vh;
        width: auto;
       }
  h2 {color: white;
        /* font-size: 30px;         */
}
  h6 {color: lightgrey;}
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
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
               <strong>Success!</strong> '. $showSucc . '
               
             </div>';
     }
    ?>
   <center> <div class="container my-4">
      <h2 class="text-center">Add a new account by filling the form below</h2>
      <h6 class="text-center">*Make sure the customer is already added</h6>
      <p><span class="error">* required field</span></p>
    </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
        Customer id: <input type="text" name="sno" value="<?php echo $sno;?>">
        <!-- <span type="color:blue" class="error">* <?php echo $snoErr;?></span> -->
        <br><br>
        Customer Name: <input type="text" name="name" value="<?php echo $name;?>">
        <!-- <span type="color:blue" class="error">* <?php echo $nameErr;?></span> -->
        <br><br>
        Account type: <select type="acc_type" name="acc_type">
                        <option value="current">Current</option>
                        <option value="savings">Savings</option>
                      </select>
        <br><br>
        Initial Deposit: <input type ="number" name="ini_deposit" value="<?php echo $ini_deposit;?>">
        <span type="color:blue" class="error">* <?php echo $ini_depositErr; ?></span>
        <br><br>
        <input type="submit" name="Submit" value="Submit">
        <input type="submit" name="Reset" value="Reset">
       
          <?php
          if(isset($_POST['Reset']))
        {
            header("location:addaccount.php");
        }
        ?>
</form>
</center>
</body>
</html>