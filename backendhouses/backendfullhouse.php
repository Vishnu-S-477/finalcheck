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

$city = trim(strtolower($_POST['city']));
$area = trim(strtolower($_POST['area']));
$address = ($_POST['address']);
$rentrate = $_POST['price'];
$deposit = $_POST['deposit'];
$sqft = $_POST['sqft'];
$modeofhouse = ($_POST['ModeOfHouse']);
$housetype = !empty($_POST['HousingType']) ? $_POST['HousingType'] :'';
$houseavailable = $_POST['houseavailable'];
$preferredtennets = !empty($_POST['preferredtenates']) ? $_POST['preferredtenates'] : null;
$propertytype = $_POST['propertytypefullhouse'];
$furnish = $_POST['furnishfullhouse'];
$parkingstatus = $_POST['parkingStatusfullhouse'];
$metro = $_POST['metrofh'];

//housetype
if(empty($housetype)){
    $_SESSION['fherrorhouse'] = 'Select House Type';
    $_SESSION['databackup'] = [
        'city' => $city,
        'area' => $area,
        'address' => $address,
        'rentrate' => $rentrate,
        'deposit' => $deposit,
        'sqft' => $sqft,
        'modeofhouse' => $modeofhouse,
        'housetype' => $housetype,
        'houseavailable' => $houseavailable,
        'preferredtenates' => $preferredtennets,
        'propertytype' => $propertytype,
        'furnish' => $furnish,
        'parkingstatus' => $parkingstatus,
        'metro' => $metro,
    ];
    $_SESSION['errormessage'] = 'Dear User Some Input Field Missing';
    $_SESSION['optionpick'] = 'fullhouse';
    header("Location:../php_upload/upload.php");
    exit();
}

//houseavailable
if(empty($houseavailable)){
    $_SESSION['fherroravailable'] = 'Select House Availability';
    $_SESSION['databackup'] = [
        'city' => $city,
        'area' => $area,
        'address' => $address,
        'rentrate' => $rentrate,
        'deposit' => $deposit,
        'sqft' => $sqft,
        'modeofhouse' => $modeofhouse,
        'housetype' => $housetype,
        'houseavailable' => $houseavailable,
        'preferredtenates' => $preferredtennets,
        'propertytype' => $propertytype,
        'furnish' => $furnish,
        'parkingstatus' => $parkingstatus,
        'metro' => $metro,
    ];
    $_SESSION['errormessage'] = 'Dear User Some Input Field Missing';
    $_SESSION['optionpick'] = 'fullhouse';
    header("Location:../php_upload/upload.php");
    exit();
}

//preferredtenants
if(empty($preferredtennets)){
    $_SESSION['fherrorperferred'] = 'Select Preferred Tenants';
    $_SESSION['databackup'] = [
        'city' => $city,
        'area' => $area,
        'address' => $address,
        'rentrate' => $rentrate,
        'deposit' => $deposit,
        'sqft' => $sqft,
        'modeofhouse' => $modeofhouse,
        'housetype' => $housetype,
        'houseavailable' => $houseavailable,
        'preferredtenates' => $preferredtennets,
        'propertytype' => $propertytype,
        'furnish' => $furnish,
        'parkingstatus' => $parkingstatus,
        'metro' => $metro,
    ];
    $_SESSION['errormessage'] = 'Dear User Some Input Field Missing';
    $_SESSION['optionpick'] = 'fullhouse';
    header("Location:../php_upload/upload.php");
    exit();
}

//property type
if(empty($propertytype)){
    $_SESSION['fherrorproperty'] = 'Select Property Type';
    $_SESSION['databackup'] = [
        'city' => $city,
        'area' => $area,
        'address' => $address,
        'rentrate' => $rentrate,
        'deposit' => $deposit,
        'sqft' => $sqft,
        'modeofhouse' => $modeofhouse,
        'housetype' => $housetype,
        'houseavailable' => $houseavailable,
        'preferredtenates' => $preferredtennets,
        'propertytype' => $propertytype,
        'furnish' => $furnish,
        'parkingstatus' => $parkingstatus,
        'metro' => $metro,
    ];
    $_SESSION['errormessage'] = 'Dear User Some Input Field Missing';
    $_SESSION['optionpick'] = 'fullhouse';
    header("Location:../php_upload/upload.php");
    exit();
}

//furnish
if(empty($furnish)){
    $_SESSION['fherrorfurnish'] = 'Select Furnish Info';
    $_SESSION['databackup'] = [
        'city' => $city,
        'area' => $area,
        'address' => $address,
        'rentrate' => $rentrate,
        'deposit' => $deposit,
        'sqft' => $sqft,
        'modeofhouse' => $modeofhouse,
        'housetype' => $housetype,
        'houseavailable' => $houseavailable,
        'preferredtenates' => $preferredtennets,
        'propertytype' => $propertytype,
        'furnish' => $furnish,
        'parkingstatus' => $parkingstatus,
        'metro' => $metro,
    ];
    $_SESSION['errormessage'] = 'Dear User Some Input Field Missing';
    $_SESSION['optionpick'] = 'fullhouse';
    header("Location:../php_upload/upload.php");
    exit();
}

//parking status
if(empty($parkingstatus)){
    $_SESSION['fherrorparking'] = 'Select Parking Info';
    $_SESSION['databackup'] = [
        'city' => $city,
        'area' => $area,
        'address' => $address,
        'rentrate' => $rentrate,
        'deposit' => $deposit,
        'sqft' => $sqft,
        'modeofhouse' => $modeofhouse,
        'housetype' => $housetype,
        'houseavailable' => $houseavailable,
        'preferredtenates' => $preferredtennets,
        'propertytype' => $propertytype,
        'furnish' => $furnish,
        'parkingstatus' => $parkingstatus,
        'metro' => $metro,
    ];
    $_SESSION['errormessage'] = 'Dear User Some Input Field Missing';
    $_SESSION['optionpick'] = 'fullhouse';
    header("Location:../php_upload/upload.php");
    exit();
}

//metro
if(empty($metro)){
    $_SESSION['fherrormetro'] = 'Select Metro Info';
    $_SESSION['databackup'] = [
        'city' => $city,
        'area' => $area,
        'address' => $address,
        'rentrate' => $rentrate,
        'deposit' => $deposit,
        'sqft' => $sqft,
        'modeofhouse' => $modeofhouse,
        'housetype' => $housetype,
        'houseavailable' => $houseavailable,
        'preferredtenates' => $preferredtennets,
        'propertytype' => $propertytype,
        'furnish' => $furnish,
        'parkingstatus' => $parkingstatus,
        'metro' => $metro,
    ];
    $_SESSION['errormessage'] = 'Dear User Some Input Field Missing';
    $_SESSION['optionpick'] = 'fullhouse';
    header("Location:../php_upload/upload.php");
    exit();
}

$image = $_FILES['housepic'];
if (empty($_FILES['housepic']['name'])) {
    $_SESSION['databackup'] = [
        'city' => $city,
        'area' => $area,
        'address' => $address,
        'rentrate' => $rentrate,
        'deposit' => $deposit,
        'sqft' => $sqft,
        'modeofhouse' => $modeofhouse,
        'housetype' => $housetype,
        'houseavailable' => $houseavailable,
        'preferredtenates' => $preferredtennets,
        'propertytype' => $propertytype,
        'furnish' => $furnish,
        'parkingstatus' => $parkingstatus,
        'metro' => $metro,
    ];
    $_SESSION['errormessage'] = 'Dear User Please Upload Image';
    $_SESSION['optionpick'] = 'fullhouse';
    header("Location:../php_upload/upload.php");
    exit();
}

$tempimage = $_FILES['housepic']['tmp_name'];
$imagename = $_FILES['housepic']['name'];
$imagetype=$_FILES['housepic']['type'];
$bimage = file_get_contents($tempimage);
$userid = $_SESSION['userid'];
if (!empty($_POST['HousingType'])) {
    $housetype = implode(',', $_POST['HousingType']);
} else {
    $housetype = ''; 
}

if (!empty($_POST['preferredtenates'])) {
    $preferredtennets = implode(',', $_POST['preferredtenates']);
} else {
    $preferredtennets = ''; 
}





include '../database/database.php';
database::$db_name = 'roomhunt';
database::connection();

$sql = database::$connection->prepare("INSERT INTO housedatafullhouse(deposit, sqft, city, area, address, rentrate, modeofhouse, housetype, availability, preferredtennets, propertytype, furnish, parkingstatus, blobimage, mimetype, userid,metro) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");

$sql->bind_param("iisssisssssssssss",$deposit, $sqft, $city, $area , $address, $rentrate, $modeofhouse, $housetype, $houseavailable, $preferredtennets, $propertytype, $furnish, $parkingstatus, $bimage, $imagetype, $userid,$metro);
$sql->execute();

$sql->close();
header("Location:../frontend_houses/mysellhouse.php");
exit();
ob_end_clean();
?>