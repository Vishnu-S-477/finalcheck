<?php 
session_start();
ob_start();
$firstname = $_POST['First_Name'];
$lastname = $_POST['Last_Name'];
$dob = $_POST['Date-of-Birth'];
$userid = strval($_POST['userid']);
$email = $_POST['Email_Id'];
$mobileno = $_POST['Phone_Number'];
$fpassword = $_POST['Create_Password'];
$lpassword = $_POST['Confirm_Password'];
$image = $_FILES['image'];
$tempimage = $_FILES['image']['tmp_name'];
$mimetype = $_FILES['image']['type'];
$bimage = !empty($tempimage)?file_get_contents($tempimage):str_repeat('0', 10) ;
$mimetype = !empty($mimetype) ? $mimetype : 'application/octet-stream';
$name = ($firstname.' '.$lastname);
$useridlength = strlen($userid);

if ($useridlength < 4) {
   $_SESSION['useridlength'] = 'Userid should be at least 4 characters';
   $_SESSION['info'] = [
      'firstname' => $firstname,
      'lastname' => $lastname,
      'dob' => $dob,
      'email' => $email,
      'userid' => $userid,
      'mobileno' => $mobileno,
   ];
   header("Location:../frontend_authentication/Signup.php");
   exit();
} elseif ($useridlength > 8) {
   $_SESSION['useridlength'] = 'Userid should be at most 8 characters';
   $_SESSION['info'] = [
      'firstname' => $firstname,
      'lastname' => $lastname,
      'dob' => $dob,
      'email' => $email,
      'userid' => $userid,
      'mobileno' => $mobileno,
   ];
   header("Location:../frontend_authentication/Signup.php");
   exit();
}

include '../database/database.php';
database::$db_name = 'roomhunt';
database::connection();


$query = database::$connection->prepare("SELECT userid FROM Authorization WHERE userid = ?");
$query->bind_param("s", $userid);
$query->execute();
$query->store_result(); 

if ($query->num_rows > 0) {
   $query->close();
   $_SESSION['useridexist'] = 'Oops! User ID already exists';
   $_SESSION['info'] = [
      'firstname' => $firstname,
      'lastname' => $lastname,
      'dob' => $dob,
      'email' => $email,
      'userid' => $userid,
      'mobileno' => $mobileno,
   ];
   header("Location:../frontend_authentication/Signup.php");
   exit();
}
$query->close(); 


$query = database::$connection->prepare("SELECT mailid FROM Authorization WHERE mailid = ?");
$query->bind_param("s", $email);
$query->execute();
$query->store_result();

if ($query->num_rows > 0) {
   $query->close();
   $_SESSION['emailerror'] = 'Email already exists';
   $_SESSION['info'] = [
      'firstname' => $firstname,
      'lastname' => $lastname,
      'dob' => $dob,
      'mobileno' => $mobileno,
      'userid' => $userid,
      'email' => '',
   ];
   
   header("Location:../frontend_authentication/Signup.php");
   exit();
}
$query->close(); 


$query = database::$connection->prepare("SELECT mobileno FROM Authorization WHERE mobileno = ?");
$query->bind_param("s", $mobileno);
$query->execute();
$query->store_result(); 

if ($query->num_rows > 0) {
   $query->close();
   $_SESSION['mobilenoerror'] = 'Mobile number already exists';
   $_SESSION['info'] = [
      'firstname' => $firstname,
      'lastname' => $lastname,
      'dob' => $dob,
      'email' => $email,
      'userid' => $userid,
      'mobileno' => '',
   ];
   header("Location:../frontend_authentication/Signup.php");
   exit();
}
$query->close(); 
if ($fpassword !== $lpassword) {
    $_SESSION['passerror'] = 'Password mismatch';
    $_SESSION['info'] = [
        'firstname' => $firstname,
        'lastname' => $lastname,
        'dob' => $dob,
        'email' => $email,
        'userid' => $userid,
        'mobileno' => $mobileno,
    ];
    header("Location:../frontend_authentication/Signup.php");
    exit();
}

$hashedpassword = password_hash($fpassword, PASSWORD_DEFAULT);


$query = database::$connection->prepare("INSERT INTO Authorization(userid, username, mailid, password, mobileno, dob,imagetype,profilepic) VALUES(?,?,?,?,?,?,?,?)");
$query->bind_param("ssssssss", $userid, $name, $email, $hashedpassword, $mobileno, $dob,$mimetype,$bimage);

if ($query->execute()) {
   $_SESSION['userid'] = $userid;
   $_SESSION['username'] = $name;
    header("Location:../welcome/home.php");
} else {
    echo "Error in execution: " . database::$connection->error;
}
$query->close(); 
ob_end_clean();
?>
