<?php
session_start();
ob_start();
if(isset($_SESSION['userid'])){
    echo('login status Green');
}
else{
    header("Location:../frontend_authentication/Login.php");
    exit();
}

$userid = $_SESSION['userid'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$name = $fname.' '.$lname;
$mailid = $_POST['mailid'];
$contactno = $_POST['contactno'];
$image =empty($_FILES['image'])?null:$_FILES['image'];
$tempimage = empty($_FILES['image'])?null:$_FILES['image']['tmp_name'];
$mimetype=!empty($tempimage)?$_FILES['image']['type']:null;
$blobimage = !empty($tempimage)?file_get_contents($tempimage):null;



include '../database/database.php';
database::$db_name = 'roomhunt';
database::connection();

$sql = database::$connection->prepare("SELECT mailid FROM Authorization WHERE userid != ? AND  mailid = ? ");
$sql->bind_param("ss",$userid,$mailid);
$sql->execute();
$sql->store_result();
if($sql->num_rows >0){
    $_SESSION['mailidexist'] = 'Oops! mailid ID already exists';
    header("Location:editfrontend.php");
    exit();
}

$sqls = database::$connection->prepare("SELECT mobileno FROM Authorization WHERE userid != ? AND mobileno = ? ");
$sqls->bind_param("ss",$userid,$contactno);
$sqls->execute();
$sqls->store_result();
if($sqls->num_rows >0){
    $_SESSION['mobilenoexist'] = 'Oops! mobileno already exists';
    header("Location:editfrontend.php");
    exit();
}

if(!empty($tempimage)){
    $query = database::$connection->prepare("UPDATE Authorization SET username = ?, mailid = ?,mobileno = ?,imagetype = ?,profilepic =?  WHERE userid = ?");
    $query->bind_param("ssssss",$name,$mailid,$contactno,$mimetype,$blobimage,$userid);
    $query->execute();
    header("Location:../profile/myprofile.php");
    exit();
}

else if(empty($tempimage)){
    $query = database::$connection->prepare("UPDATE Authorization SET username = ?, mailid = ?,mobileno = ?  WHERE userid = ?");
    $query->bind_param("ssss",$name,$mailid,$contactno,$userid);
    $query->execute();
    header("Location:../profile/myprofile.php");
    exit();
}
ob_end_clean();
?>