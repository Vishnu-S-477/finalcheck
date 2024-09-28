
<?php
session_start();
ob_start();
$emailerror = '';
$passerror ='';
$mobileno = '';
$dob = '';
$email = '';
$firstname = '';
$lastname = '';
$mobilenoe = '';
$userid = '';
$useridlength = '';


if(isset($_SESSION['useridlength'])){
    $useridlength = $_SESSION['useridlength'];
}
else if(isset($_SESSION['useridexist'])){
    $useridlength = $_SESSION['useridexist'];
}
if(isset($_SESSION['emailerror'])){
 $emailerror = $_SESSION['emailerror'];
 
}

if(isset($_SESSION['mobilenoerror'])){
    $mobilenoe = $_SESSION['mobilenoerror'];
}

if(isset($_SESSION['passerror'])){
$passerror = $_SESSION['passerror'];
}
if(isset($_SESSION['info'])){
$temp = $_SESSION['info'];
$mobileno = $temp['mobileno'];
$dob = $temp['dob'];
$firstname = $temp['firstname'];
$lastname = $temp['lastname'];
$userid = $temp['userid'];
$email = $temp['email'];
session_unset();
}
ob_end_clean();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="stylesheet" type="text/css" href="../css_authentication/signup.css">
    <style>
        body{
            background-color:black;
        }
    </style>
</head>
<body>
    <form class="main-container" action = "../backend_authentication/backendsignup.php" method = "post" enctype="multipart/form-data">
        <div class="heading"><h1>SignUp</h1></div>
        <input type="text" class="fname" name="First_Name" value = "<?php echo (htmlspecialchars(isset($firstname)?$firstname:'' ));?>" placeholder="First Name" required>
        <input type="text" class="lname" name="Last_Name" value = "<?php echo (htmlspecialchars(isset($lastname)?$lastname:'' ));?>" placeholder="Last Name" required>
        <input type="date" class="date" name="Date-of-Birth" value = "<?php echo (htmlspecialchars(isset($dob)?$dob:'' ));?>" required placeholder="Enter DOB">
        <input type="text" class="userid" name="userid" value = "<?php echo (htmlspecialchars(isset($userid)?$userid:'' ));?>" placeholder="Enter Userid" required>
        <span class="span-style"> <?php
            if($useridlength){
                echo($useridlength);
            }
            ?></span>
        <input type="text" class="mailid" name="Email_Id" value = "<?php echo (htmlspecialchars(isset($email)?$email:'' ));?>" placeholder="mailid" required>
        <span class="span-style"><?php
            if($emailerror){
                echo($emailerror);
            }
            ?></span>
        <input type="text" class="contactno" name="Phone_Number"  pattern="[0-9]{10}" value = "<?php echo (htmlspecialchars(isset($mobileno)?$mobileno:'' ));?>" placeholder="contactno" required>
        <span class="span-style"> <?php
            if($mobilenoe){
                echo($mobilenoe);
            }
           ?></span>
        <input type="password" class="cpassword" name="Create_Password" placeholder="Create Password" required>
        <input type="password" class="lpassword" name="Confirm_Password" placeholder="Confirm Password" required>
        <span class="span-style"><?php
            if(isset($passerror)){
              echo($passerror);
            }
          ?></span>
        <input type="file" class="upload-field" name="image">
        <div class="upload-button-container">
            <button type="button" class="upload-button">Upload Image</button>
        </div>
        <div class="response-button-container">
           <div class="login-container"><a style="text-decoration:none" href="Login.php"><button type="button" class="login-link">Login</button></a></div>
            <input type="submit" class="submit-button" value="Create Account">
            
        </div>
    </form>
</body>
<script>
    const originalupload = document.querySelector('.upload-field');
    const pseudoupload = document.querySelector('.upload-button');
    pseudoupload.addEventListener('click',function(){
        originalupload.click();
    });
</script>
</html>