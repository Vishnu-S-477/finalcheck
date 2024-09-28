<?php
session_start();
ob_start();
$email = $_POST['email'];
$password = $_POST['password'];


include '../database/database.php';
database::$db_name = 'roomhunt';
database::connection();

$sql = database::$connection->prepare("SELECT mailid FROM Authorization WHERE mailid = ?");
$sql->bind_param("s",$email,);
$sql->execute();
$sql->store_result(); 


if ($sql->num_rows > 0){
    print('valid emailid');
}
else{
    $_SESSION['emailerror'] = 'Email Not Exists';
    $sql->close();
    header("Location:../frontend_authentication/Login.php");
    exit();
}

$sql = database::$connection->prepare("SELECT password,userid,username FROM Authorization WHERE mailid = ?");
$sql->bind_param("s",$email);
$sql->execute();
$sql->bind_result($variable,$userid,$username);
if($sql->fetch()){
    echo("Data Retrieved Successfully <br> ");
}
else{
    echo("Not Found");
}
if(password_verify($password,$variable)){
    echo("Password Match Successfully");
    $_SESSION['userid'] = $userid;
    $_SESSION['username'] = $username;
    $sql->close();
   if(empty($_SESSION['backupsite'])){
      header("Location:../welcome/home.php");
      exit();
     }
       else{
        header("Location:".$_SESSION['backupsite']);
       }
       exit();
    }


else{
    $_SESSION['emailidbackup'] = $_POST['email'];
 $_SESSION['passerror'] = 'INCORRECT_PASSWORD';
 $sql->close();
 header("Location:../frontend_authentication/Login.php");
 exit();
}
ob_end_clean();
?>