<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
?>
<?php
// define variables and set to empty values
include '..\loginsys\partials\_dbconnect.php';
$nameErr = $genderErr=$dobErr= $addressErr= $cityErr= $stateErr=$pinErr=$m_noErr =$emailErr="";
$name = $gender = $dob = $address = $city = $state = $pin = $m_no =$email=$namez=$emailz= $num=$flag="";
$showError= false;
$showSucc= false;

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;}
  
  if(empty($_POST["name"])){
    $nameErr= "Customer Name is Required";
  }
  else{
    $name = test_input($_POST["name"]);
  }
  if(!preg_match("/^[a-zA-Z-' ]*$/",$name))                     
         { $nameErr = "Only letters and white space allowed";}
  
  if(empty($_POST["gender"])){
    $genderErr= "gender is Required";
  }
  else{
    $gender = test_input($_POST["gender"]);
  }
  if(empty($_POST["name"])){
    $dobErr= "Date of birth is Required";
  }
  else{
    $dob = test_input($_POST["dob"]);
  }
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
  
  if($nameErr == "" && $genderErr == "" && $dobErr == "" && $addressErr == "" &&$cityErr == "" && $stateErr == "" && $pinErr == "" && $m_noErr == "" && $emailErr == ""){
    $m_id=$_SESSION['m_id'];
    $sql="INSERT INTO add_customer(`cname`, `gender`, `dob`, `address`, `city`, `state`, `pin`, `m_no`, `email`, `m_id`) 
    VALUES ('$name','$gender','$dob','$address','$city','$state','$pin','$m_no','$email','$m_id')";
    // $result=mysqli_query($conn, $sql);
    // if($result!==FALSE && mysqli_num_rows($result)){
    //Lesson: you wasted 5 hours in doing this silly mistake, in the if condition in the next line you can't enter mysqli_num_rows as the query which we ran is a INSERT query which returns just either true or false and if u want to use mysqli_num_rows then the sql statement should be SELECT one not the INSERT one
    if(mysqli_query($conn, $sql)){
      $sql2="SELECT * FROM `add_customer` WHERE `cname`='$name' AND `m_id`='$m_id'";
      $result2=mysqli_query($conn, $sql2);
      
      if($result2!==FALSE && mysqli_num_rows($result2)){
      $row=mysqli_fetch_assoc($result2);
      $cuid=$row['sno'];
      $sql3="INSERT INTO `loginpage`(`userid`, `password`, `m_id`) VALUES ('$cuid','$m_no','$m_id')";
        
        if(mysqli_query($conn, $sql3)){
            $showSucc= "Customer added successfully";
          }
          else{
            $showError="Error3: " . $sql3 . "<br>" . mysqli_error($conn);
            exit;
          }
      }
      else{
       $showError= "Error2: " . $sql2 . "<br>" . mysqli_error($conn);
        exit;
      }
    }
    else{
     $showError= "Error1: " . $sql . "<br>" . mysqli_error($conn);
      exit;
    }
  }  
}

?>
<html>
<head>
  <title>
Add Customer</title>
  <style>
  .error{color:red}

  h1 {color: lightgrey;}
  form{ color: darkgreen;
      font-size: 18px;
}
body {
        background-image: url("https://images.unsplash.com/photo-1537724326059-2ea20251b9c8?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NXx8YmFua2luZ3xlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=60");
        background-size: cover;
        height: 100vh;
        /* viewport height */
        width: auto;
       }
.bimg1{
   margin-left: 20px;
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
      <h1 class="text-center">Add a new customer by filling the form below</h1>
      <p><span class="error">* required field</span></p>
    </div>
    <div class="bimg1">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
        Customer Name: <input type="text" name="name" value="<?php echo $name;?>">
        <span type="color:blue" class="error">* <?php echo $nameErr;?></span>
        <br><br>
        Gender:
        <input type="radio" name="gender" <?php if(isset($gender) && $gender=="female"){echo "checked";} ?> value="female">Female
        <input type="radio" name="gender" <?php if(isset($gender) && $gender=="male"){echo "checked";} ?> value="male">Male
        <input type="radio" name="gender" <?php if(isset($gender) && $gender=="other"){echo "checked";} ?> value="other">Other
        <span class="error">* <?php echo $genderErr;?></span>
        <br><br>
        Date of birth: <input type="date" name="dob" value="<?php echo $dob;?>" >
        <span class="error">* <?php echo $dobErr;?></span>
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
        <input type="submit" name="submit" value="Reset">  
        <?php
          if(isset($_POST['Reset']))
        {
        
          header("location:\guru99\manager\addcustomer.php");
        }
        ?>
      </div>

</form>
</center>
</body>
</html> 