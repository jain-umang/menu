<?php

include '..\loginsys\partials\_dbconnect.php';
session_start();
$sno=$_SESSION["sno"];
$name=$_SESSION["name"];
$gender=$_SESSION["gender"];
$dob=$_SESSION["dob"];
$address=$_SESSION["address"];
$city=$_SESSION["city"];
$state=$_SESSION["state"];
$pin=$_SESSION["pin"];
$m_no=$_SESSION["m_no"];
$email=$_SESSION["email"];
$m_id=$_SESSION['m_id'];

$addressErr=$cityErr=$stateErr=$pinErr=$m_noErr=$emailErr="";
$showError= false;
$showSucc= false;
// this time $name, $address will not be null because iss baare name, address ki values apn table se sidha idhar form me display karvayenge
// $name = $gender = $dob = $address = $city = $state = $pin = $m_no =$email= "";

function test_input($data)
{
   $data=trim($data);
   $data=htmlspecialchars($data);
   $data=stripcslashes($data);
   return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){


  
  
  if(empty($_POST["address"])){
    $addressErr= "Address is Required";
  }
  else{
    $address = test_input($_POST["address"]);
  }
  // if(!preg_match("/^[a-zA-Z-0-9]*$/",$address))                     
  //        { $addressErr = "Only letters and white space allowed";}
  
  if(empty($_POST["city"])){
    $cityErr= "City is Required";
  }
  else{
    $city = test_input($_POST["city"]);
  }
  if(!preg_match("/^[a-zA-Z- ]*$/",$city))                     
         { $cityErr = "Only letters and white space allowed";}
  if(empty($_POST["state"])){
    $stateErr= "State is Required";
  }
  else{
    $state = test_input($_POST["state"]);
  }
  if(!preg_match("/^[a-zA-Z-' ]*$/",$state))                     
         { $stateErr = "Only letters and white space allowed";}
  if(empty($_POST["pin"])){
    $pinErr= "PIN is Required";
  }
  else{
    $pin = test_input($_POST["pin"]);
  }
  if(empty($_POST["m_no"])){
    $m_noErr= "Mobile Number is Required";
  }
  else{
    $m_no = test_input($_POST["m_no"]);
  }
  if(empty($_POST["email"])){
    $emailErr= "Email is Required";
  }
  else{
    $email = test_input($_POST["email"]);
  }
  
  if($addressErr == "" && $cityErr == "" && $stateErr == "" && $pinErr == "" && $m_noErr == "" && $emailErr == ""){
    $sql="UPDATE `add_customer` SET `address`='$address',`city`='$city',`state`='$state',`pin`='$pin',`m_no`='$m_no',`email`='$email' WHERE `sno`='$sno' AND `m_id`='$m_id'";

    if (mysqli_query($conn, $sql)) {
      $showSucc= "Customer's Profile Updated Successfully";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }
  
}
?>


<html>
<head>
<style>

  h1 {color: white;}
  .error{color:red;}
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
      <h1 class="text-center">Edit details of <?php echo "$name";?> here </h1>
      <p><span class="error">* required field</span></p>
    </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
        Customer Name: <?php echo $name;?>
        <br><br>
       
        Gender: <?php echo $gender;?>
        <br><br>
        Date of birth: <?php echo $dob;?>
        <br><br>
        Address: </br><textarea name="address" rows="5" cols="40"><?php echo $address;?></textarea>
        <span class="error">* <?php echo $addressErr;?></span>
        <br><br>
        City: <input type="text" name="city" value="<?php echo $city;?>" >
        <span class="error">* <?php echo $cityErr;?></span>
        <br><br>
        State: <input type="text" name="state" value="<?php echo $state;?>">
        <span class="error">* <?php echo $stateErr;?></span>
        <br><br>
        PIN: <input type="number" name="pin" value="<?php echo $pin;?>" maxlength="6">
        <span class="error">* <?php echo $pinErr;?></span>
        <br><br>
        Mobile Number: <input type="number" name="m_no" value="<?php echo $m_no;?>" maxlength="10">
        <span class="error">* <?php echo $m_noErr;?></span>
        <br><br>
        E-mail: <input type="email" name="email" value="<?php echo $email;?>">
        <span class="error">* <?php echo $emailErr;?></span>
        <br><br>
        
        <input type="submit" name="submit" value="Submit">  
        <input type="submit" name="reset" value="Reset">  
        <?php
          if(isset($_POST['reset']))
        {
          header("location:editcustomer2.php");
        }
?>
</form>
</center>
</body>
</html>


 






