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
$city = trim(strtolower($_POST['city']));
$area = trim(strtolower($_POST['area']));
$address = ($_POST['address']);
$rentrate = $_POST['price'];
$deposit = $_POST['deposit'];
$sqft = $_POST['sqft'];
$modeofhouse = ($_POST['ModeOfHouse']);
$roomtype = !empty($_POST['RoomType']) ? $_POST['RoomType'] :'';
$allowedtenant = ($_POST['TenantFor']);
$furnish = ($_POST['furnish']);
$propertytype = ($_POST['propertytype']);
$allowedfood = ($_POST['showonly']);
$floor = $_POST['floors'];
$parkingtype = ($_POST['parkingStatus']);
$metro = ($_POST['metrofm']);
$bathroom = $_POST['bathroomfacility'];
$image = $_FILES['housepics'];

//roomtype 
if(empty($roomtype)){
    $_SESSION['fmerrorroom'] = 'Select RoomType';
    $_SESSION['databackup'] = [
        'city' => $city,
        'area' => $area,
        'address' => $address,
        'rentrate' => $rentrate,
        'deposit' => $deposit,
        'sqft' => $sqft,
        'modeofhouse' => $modeofhouse,
        'roomtype' => $roomtype,
        'allowedtenant' => $allowedtenant,
        'furnish' => $furnish,
        'propertytype' => $propertytype,
        'allowedfood' => $allowedfood,
        'floor' => $floor,
        'parkingstatus' => $parkingtype,
        'metro' => $metro,
        'bathroom' => $bathroom,
    ];
    $_SESSION['errormessage'] = 'Dear User Some Input Field Missing';
    $_SESSION['optionpick'] = 'flathouse';
    header("Location:../php_upload/upload.php");
    exit();
}
//allowed tenant
if(empty($allowedtenant)){
    $_SESSION['fmerrorallowedtenant'] = 'Select Eligble Tenant';
    $_SESSION['databackup'] = [
        'city' => $city,
        'area' => $area,
        'address' => $address,
        'rentrate' => $rentrate,
        'deposit' => $deposit,
        'sqft' => $sqft,
        'modeofhouse' => $modeofhouse,
        'roomtype' => $roomtype,
        'allowedtenant' => $allowedtenant,
        'furnish' => $furnish,
        'propertytype' => $propertytype,
        'allowedfood' => $allowedfood,
        'floor' => $floor,
        'parkingstatus' => $parkingtype,
        'metro' => $metro,
        'bathroom' => $bathroom,
    ];
    $_SESSION['errormessage'] = 'Dear User Some Input Field Missing';
    $_SESSION['optionpick'] = 'flathouse';
    header("Location:../php_upload/upload.php");
    exit();
}
//furnish
if(empty($furnish)){
    $_SESSION['fmerrorfurnish'] = 'Select Furnish Field';
    $_SESSION['databackup'] = [
        'city' => $city,
        'area' => $area,
        'address' => $address,
        'rentrate' => $rentrate,
        'deposit' => $deposit,
        'sqft' => $sqft,
        'modeofhouse' => $modeofhouse,
        'roomtype' => $roomtype,
        'allowedtenant' => $allowedtenant,
        'furnish' => $furnish,
        'propertytype' => $propertytype,
        'allowedfood' => $allowedfood,
        'floor' => $floor,
        'parkingstatus' => $parkingtype,
        'metro' => $metro,
        'bathroom' => $bathroom,
    ];
    $_SESSION['errormessage'] = 'Dear User Some Input Field Missing';
    $_SESSION['optionpick'] = 'flathouse';
    header("Location:../php_upload/upload.php");
    exit();
}
//Property Type
if(empty($propertytype)){
    $_SESSION['fmerrorproperty'] = 'Select PropertyType';
    $_SESSION['databackup'] = [
        'city' => $city,
        'area' => $area,
        'address' => $address,
        'rentrate' => $rentrate,
        'deposit' => $deposit,
        'sqft' => $sqft,
        'modeofhouse' => $modeofhouse,
        'roomtype' => $roomtype,
        'allowedtenant' => $allowedtenant,
        'furnish' => $furnish,
        'propertytype' => $propertytype,
        'allowedfood' => $allowedfood,
        'floor' => $floor,
        'parkingstatus' => $parkingtype,
        'metro' => $metro,
        'bathroom' => $bathroom,
    ];
    $_SESSION['errormessage'] = 'Dear User Some Input Field Missing';
    $_SESSION['optionpick'] = 'flathouse';
    header("Location:../php_upload/upload.php");
    exit();
}
// allowed food
if(empty($allowedfood )){
    $_SESSION['fmerrorfood'] = 'Select Food Field';
    $_SESSION['databackup'] = [
        'city' => $city,
        'area' => $area,
        'address' => $address,
        'rentrate' => $rentrate,
        'deposit' => $deposit,
        'sqft' => $sqft,
        'modeofhouse' => $modeofhouse,
        'roomtype' => $roomtype,
        'allowedtenant' => $allowedtenant,
        'furnish' => $furnish,
        'propertytype' => $propertytype,
        'allowedfood' => $allowedfood,
        'floor' => $floor,
        'parkingstatus' => $parkingtype,
        'metro' => $metro,
        'bathroom' => $bathroom,
    ];
    $_SESSION['errormessage'] = 'Dear User Some Input Field Missing';
    $_SESSION['optionpick'] = 'flathouse';
    header("Location:../php_upload/upload.php");
    exit();
}
// Floor
if(empty($floor)){
    $_SESSION['fmerrorfloor'] = 'Select Floor';
    $_SESSION['databackup'] = [
        'city' => $city,
        'area' => $area,
        'address' => $address,
        'rentrate' => $rentrate,
        'deposit' => $deposit,
        'sqft' => $sqft,
        'modeofhouse' => $modeofhouse,
        'roomtype' => $roomtype,
        'allowedtenant' => $allowedtenant,
        'furnish' => $furnish,
        'propertytype' => $propertytype,
        'allowedfood' => $allowedfood,
        'floor' => $floor,
        'parkingstatus' => $parkingtype,
        'metro' => $metro,
        'bathroom' => $bathroom,
    ];
    $_SESSION['errormessage'] = 'Dear User Some Input Field Missing';
    $_SESSION['optionpick'] = 'flathouse';
    header("Location:../php_upload/upload.php");
    exit();
}
// Parking 
if(empty($parkingtype)){
    $_SESSION['fmerrorparking'] = 'Select Parking Field';
    $_SESSION['databackup'] = [
        'city' => $city,
        'area' => $area,
        'address' => $address,
        'rentrate' => $rentrate,
        'deposit' => $deposit,
        'sqft' => $sqft,
        'modeofhouse' => $modeofhouse,
        'roomtype' => $roomtype,
        'allowedtenant' => $allowedtenant,
        'furnish' => $furnish,
        'propertytype' => $propertytype,
        'allowedfood' => $allowedfood,
        'floor' => $floor,
        'parkingstatus' => $parkingtype,
        'metro' => $metro,
        'bathroom' => $bathroom,
    ];
    $_SESSION['errormessage'] = 'Dear User Some Input Field Missing';
    $_SESSION['optionpick'] = 'flathouse';
    header("Location:../php_upload/upload.php");
    exit();
}
//Metro
if(empty($metro)){
    $_SESSION['fmerrormetro'] = 'Select Metro';
    $_SESSION['databackup'] = [
        'city' => $city,
        'area' => $area,
        'address' => $address,
        'rentrate' => $rentrate,
        'deposit' => $deposit,
        'sqft' => $sqft,
        'modeofhouse' => $modeofhouse,
        'roomtype' => $roomtype,
        'allowedtenant' => $allowedtenant,
        'furnish' => $furnish,
        'propertytype' => $propertytype,
        'allowedfood' => $allowedfood,
        'floor' => $floor,
        'parkingstatus' => $parkingtype,
        'metro' => $metro,
        'bathroom' => $bathroom,
    ];
    $_SESSION['errormessage'] = 'Dear User Some Input Field Missing';
    $_SESSION['optionpick'] = 'flathouse';
    header("Location:../php_upload/upload.php");
    exit();
}
//Bathroom
if(empty($bathroom)){
    $_SESSION['fmerrorbathroom'] = 'Select Bathroom Facility';
    $_SESSION['databackup'] = [
        'city' => $city,
        'area' => $area,
        'address' => $address,
        'rentrate' => $rentrate,
        'deposit' => $deposit,
        'sqft' => $sqft,
        'modeofhouse' => $modeofhouse,
        'roomtype' => $roomtype,
        'allowedtenant' => $allowedtenant,
        'furnish' => $furnish,
        'propertytype' => $propertytype,
        'allowedfood' => $allowedfood,
        'floor' => $floor,
        'parkingstatus' => $parkingtype,
        'metro' => $metro,
        'bathroom' => $bathroom,
    ];
    $_SESSION['errormessage'] = 'Dear User Some Input Field Missing';
    $_SESSION['optionpick'] = 'flathouse';
    header("Location:../php_upload/upload.php");
    exit();
}
//images
if (empty($_FILES['housepics']['tmp_name'])) {
    $_SESSION['databackup'] = [
        'city' => $city,
        'area' => $area,
        'address' => $address,
        'rentrate' => $rentrate,
        'deposit' => $deposit,
        'sqft' => $sqft,
        'modeofhouse' => $modeofhouse,
        'roomtype' => $roomtype,
        'allowedtenant' => $allowedtenant,
        'furnish' => $furnish,
        'propertytype' => $propertytype,
        'allowedfood' => $allowedfood,
        'floor' => $floor,
        'parkingstatus' => $parkingtype,
        'metro' => $metro,
        'bathroom' => $bathroom,
    ];
    $_SESSION['errormessage'] = 'Dear User Please Upload Image';
    $_SESSION['optionpick'] = 'flathouse';
    header("Location:../php_upload/upload.php");
    exit();
}

$tempimage = $_FILES['housepics']['tmp_name'];
$imagename = $_FILES['housepics']['name'];
$imagetype=$_FILES['housepics']['type'];
$bimage = file_get_contents($tempimage);
if (isset($_POST['RoomType'])) {
    $roomtype = implode(',', $_POST['RoomType']);
} else {
    $roomtype = ''; 
}

include '../database/database.php';
database::$db_name = 'roomhunt';
database::connection();

$sql= database::connection()->prepare("INSERT INTO housedataflathouse(deposit, sqft, userid, city, area, address, rentrate, modeofhouse, roomtype, allowedtenant, furnish, propertytype, allowedfood, floor, parkingtype, bathroom, blobimage, mimetype,metro) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
$sql->bind_param("iissssissssssssssss",$deposit, $sqft, $userid, $city, $area, $address, $rentrate, $modeofhouse, $roomtype, $allowedtenant, $furnish, $propertytype, $allowedfood, $floor, $parkingtype, $bathroom, $bimage, $imagetype,$metro);
$sql->execute();
$sql->close();
header("Location:../frontend_houses/mysellhouse.php");
exit();
ob_end_clean();

?>