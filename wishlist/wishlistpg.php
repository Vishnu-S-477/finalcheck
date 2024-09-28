<?php 
session_start();
if(isset($_SESSION['userid'])){
    echo('login status Green');
    $_SESSION['backupsite'] = '';
}
else{
    
    $_SESSION['backupsite'] = '../wishlist/wishlistpg.php';
    session_write_close();
    header("Location:../frontend_authentication/Login.php");
    exit();
}
ob_end_clean();
$input = file_get_contents('php://input');
$array = json_decode($input,true);
$action = $array['action'];
if($action === 'insert'){
    $productid = $array['productid'];
    $productownerid = $array['pownerid'];
    $housemode = $array['housemode'];
    $clientuserid = $array['clientUserid'];
    
    include '../database/database.php';
    database::$db_name = 'roomhunt';
    database::connection();
    
    $sql = database::$connection->prepare("INSERT INTO  wishlistpg(productid,productownerid,housemode,clientuserid)VALUES(?,?,?,?);");
    $sql->bind_param("ssss",$productid,$productownerid,$housemode,$clientuserid);
    $sql->execute();
}
elseif($action === 'remove'){
    $userid = $array['userid'];
    $productid = $array['productid'];
    include '../database/database.php';
    database::$db_name = 'roomhunt';
    database::connection();
    $sql=database::$connection->prepare("DELETE FROM wishlistpg WHERE clientuserid=? AND productid=?");
    $sql->bind_param("ss",$userid,$productid);
    $sql->execute();
}

?>