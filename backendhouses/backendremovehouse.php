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
$array = json_decode($input,true);
$modeofhouse = $array['modeofhouse'];
$productid = $array['productid'];
$userid = $array['userid'];
include '../database/database.php';
 database::$db_name = 'roomhunt';
 database::connection();
if($modeofhouse === 'fullhouse'){
    $sql = database::$connection->prepare("DELETE FROM housedatafullhouse WHERE userid = ? AND pid = ?");
    $sql->bind_param("ss",$userid,$productid);
    if($sql->execute()){
        echo("Success");
    }
    else{
        echo("SomeThing Went Wrong Try Later");
    }
    $sql->close();
}
else if($modeofhouse === 'flatmates'){
    $sql = database::$connection->prepare("DELETE FROM housedataflathouse WHERE userid = ? AND pid = ?");
    $sql->bind_param("ss",$userid,$productid);
    if($sql->execute()){
        echo("Success");
    }
    else{
        echo("SomeThing Went Wrong Try Later");
    }
    $sql->close();
}
else if($modeofhouse === 'pg'){
    $sql = database::$connection->prepare("DELETE FROM housedatapg WHERE userid = ? AND pid = ?");
    $sql->bind_param("ss",$userid,$productid);
    if($sql->execute()){
        echo("Success");
    }
    else{
        echo("SomeThing Went Wrong Try Later");
    }
    $sql->close();
}
ob_end_clean();
?>