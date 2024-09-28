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

$input = file_get_contents('php://input');
$phparray = json_decode($input,true);
$userid = $phparray['userid'];

include '../database/database.php';
database::$db_name = 'roomhunt';
database::connection();

$sql = database::$connection->prepare("SELECT imagetype,profilepic,username,mailid,mobileno FROM Authorization WHERE userid =?");
$sql->bind_param("s",$userid);
$sql->execute();
$variable = $sql->get_result();
$storage = [];
while($temp = $variable->fetch_assoc()){
    $temp['profilepic'] = base64_encode( $temp['profilepic']);
$storage[] = $temp;
}

$imagetype = $storage[0]['imagetype'];
$base64image = $storage[0]['profilepic'];
$username = $storage[0]['username'];
$mailid = $storage[0]['mailid'];
$mobileno = $storage[0]['mobileno'];

$jsarray = [
    'imagetype' => $imagetype,
   'base64image' => $base64image,
    'username' => $username,
    'mailid' => $mailid,
    'mobileno' => $mobileno
];


ob_end_clean();
echo(json_encode($jsarray));

?>