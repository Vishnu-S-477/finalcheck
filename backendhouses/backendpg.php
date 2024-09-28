<?php
session_start();
ob_start();
if(!empty($_SESSION['userid'])){
    echo('login status Green');
}
else{
    header("Location:../frontend_authentication/Login.php");
    exit();
}

$userid =$_SESSION['userid'];
$city = trim(strtolower($_POST['city']));
$area = trim(strtolower($_POST['area']));
$furnish = ($_POST['furnishpg']);
$address = ($_POST['address']);
$rentrate = $_POST['price'];
$deposit = $_POST['deposit'];
$sqft = $_POST['sqft'];
$modeofhouse = ($_POST['ModeOfHouse']);
$pgfor = ($_POST['pgfor']);
$preferredpg = !empty($_POST['Preferredforpg']) ? $_POST['Preferredforpg'] : '';
$parking = ($_POST['parkingStatuspg']);
$bathroomfacility = $_POST['bathroomfacilitypg'];
$metro = ($_POST['metropg']);
$image = $_FILES['housepicpg'];
$pgroomtype = !empty($_POST['roomtypes']) ? $_POST['roomtypes'] : '';
$foodpg = !empty($_POST['Foodincluded']) ? $_POST['Foodincluded'] : '';

// PG for 
if(empty($pgfor)){
  
  $_SESSION['databackup'] = [
    'city' => $city,
    'area' => $area,
    'furnish' => $furnish,
    'address' => $address,
    'rentrate' => $rentrate,
    'deposit' => $deposit,
    'sqft' => $sqft,
    
    'preferpg' => $preferredpg,
    'modeofhouse' => $modeofhouse,
    'foodpg' => $foodpg,
    'parkingstatus' => $parking,
    'bathroom' => $bathroomfacility,
    'metro' => $metro,
    'pgroomtype' => $pgroomtype
];
$_SESSION['errorpgforpg'] = 'Select Pg For';
$_SESSION['errormessage'] = 'Some Input Field Missing';
$_SESSION['optionpick'] = 'pg';
header("Location:../php_upload/upload.php");
exit();
}

// Furnish

if(empty($furnish)){
  
    $_SESSION['databackup'] = [
      'city' => $city,
      'area' => $area,
     
      'address' => $address,
      'rentrate' => $rentrate,
      'deposit' => $deposit,
      'sqft' => $sqft,
      'preferredtenates' => $pgfor,
      'preferpg' => $preferredpg,
      'modeofhouse' => $modeofhouse,
      'foodpg' => $foodpg,
      'parkingstatus' => $parking,
      'bathroom' => $bathroomfacility,
      'metro' => $metro,
      'pgroomtype' => $pgroomtype
  ];
  $_SESSION['errorfurnishpg'] = 'Select Furnish';
  $_SESSION['errormessage'] = 'Some Input Field Missing';
  $_SESSION['optionpick'] = 'pg';
  header("Location:../php_upload/upload.php");
  exit();
  }
  //Room Type
  if(empty($pgroomtype)){
  
    $_SESSION['databackup'] = [
      'city' => $city,
      'area' => $area,
      'furnish' => $furnish,
      'address' => $address,
      'rentrate' => $rentrate,
      'deposit' => $deposit,
      'sqft' => $sqft,
      'preferredtenates' => $pgfor,
      'preferpg' => $preferredpg,
      'modeofhouse' => $modeofhouse,
      'foodpg' => $foodpg,
      'parkingstatus' => $parking,
      'bathroom' => $bathroomfacility,
      'metro' => $metro,
     
  ];
  $_SESSION['errorroomtypepg'] = 'Select RoomType';
  $_SESSION['errormessage'] = 'Some Input Field Missing';
  $_SESSION['optionpick'] = 'pg';
  header("Location:../php_upload/upload.php");
  exit();
  }

  // Preferred for 

  if(empty($preferredpg)){
  
    $_SESSION['databackup'] = [
      'city' => $city,
      'area' => $area,
      'furnish' => $furnish,
      'address' => $address,
      'rentrate' => $rentrate,
      'deposit' => $deposit,
      'sqft' => $sqft,
      'preferredtenates' => $pgfor,
      
      'modeofhouse' => $modeofhouse,
      'foodpg' => $foodpg,
      'parkingstatus' => $parking,
      'bathroom' => $bathroomfacility,
      'metro' => $metro,
      'pgroomtype' => $pgroomtype
  ];
  $_SESSION['errorpreferredpg'] = 'Select Preferred Field';
  $_SESSION['errormessage'] = 'Some Input Field Missing';
  $_SESSION['optionpick'] = 'pg';
  header("Location:../php_upload/upload.php");
  exit();
  }
// food
if(empty($foodpg)){
  
    $_SESSION['databackup'] = [
      'city' => $city,
      'area' => $area,
      'furnish' => $furnish,
      'address' => $address,
      'rentrate' => $rentrate,
      'deposit' => $deposit,
      'sqft' => $sqft,
      'preferredtenates' => $pgfor,
      'preferpg' => $preferredpg,
      'modeofhouse' => $modeofhouse,
      
      'parkingstatus' => $parking,
      'bathroom' => $bathroomfacility,
      'metro' => $metro,
      'pgroomtype' => $pgroomtype
  ];
  $_SESSION['errorfoodpg'] = 'Select Food';
  $_SESSION['errormessage'] = 'Some Input Field Missing';
  $_SESSION['optionpick'] = 'pg';
  header("Location:../php_upload/upload.php");
  exit();
  }

  // metro
  if(empty($metro)){
  
    $_SESSION['databackup'] = [
      'city' => $city,
      'area' => $area,
      'furnish' => $furnish,
      'address' => $address,
      'rentrate' => $rentrate,
      'deposit' => $deposit,
      'sqft' => $sqft,
      'preferredtenates' => $pgfor,
      'preferpg' => $preferredpg,
      'modeofhouse' => $modeofhouse,
      'foodpg' => $foodpg,
      'parkingstatus' => $parking,
      'bathroom' => $bathroomfacility,
     
      'pgroomtype' => $pgroomtype
  ];
  $_SESSION['errormetropg'] = 'Select Metro';
  $_SESSION['errormessage'] = 'Some Input Field Missing';
  $_SESSION['optionpick'] = 'pg';
  header("Location:../php_upload/upload.php");
  exit();
  }

  //parking type
  if(empty($parking)){
  
    $_SESSION['databackup'] = [
      'city' => $city,
      'area' => $area,
      'furnish' => $furnish,
      'address' => $address,
      'rentrate' => $rentrate,
      'deposit' => $deposit,
      'sqft' => $sqft,
      'preferredtenates' => $pgfor,
      'preferpg' => $preferredpg,
      'modeofhouse' => $modeofhouse,
      'foodpg' => $foodpg,
     
      'bathroom' => $bathroomfacility,
      'metro' => $metro,
      'pgroomtype' => $pgroomtype
  ];
  $_SESSION['errorparkingpg'] = 'Select Parking';
  $_SESSION['errormessage'] = 'Some Input Field Missing';
  $_SESSION['optionpick'] = 'pg';
  header("Location:../php_upload/upload.php");
  exit();
  }

  // Bathroom Facility
  if(empty($bathroomfacility)){
  
    $_SESSION['databackup'] = [
      'city' => $city,
      'area' => $area,
      'furnish' => $furnish,
      'address' => $address,
      'rentrate' => $rentrate,
      'deposit' => $deposit,
      'sqft' => $sqft,
      'preferredtenates' => $pgfor,
      'preferpg' => $preferredpg,
      'modeofhouse' => $modeofhouse,
      'foodpg' => $foodpg,
      'parkingstatus' => $parking,
     
      'metro' => $metro,
      'pgroomtype' => $pgroomtype
  ];
  $_SESSION['errorbathroompg'] = 'Select Bathroom Facility';
  $_SESSION['errormessage'] = 'Some Input Field Missing';
  $_SESSION['optionpick'] = 'pg';
  header("Location:../php_upload/upload.php");
  exit();
  }

  // file upload

if (empty($_FILES['housepicpg']['tmp_name'])) {
    $_SESSION['databackup'] = [
        'city' => $city,
        'area' => $area,
        'furnish' => $furnish,
        'address' => $address,
        'rentrate' => $rentrate,
        'deposit' => $deposit,
        'sqft' => $sqft,
        'preferredtenates' => $pgfor,
        'preferpg' => $preferredpg,
        'modeofhouse' => $modeofhouse,
        'foodpg' => $foodpg,
        'parkingstatus' => $parking,
        'bathroom' => $bathroomfacility,
        'metro' => $metro,
        'pgroomtype' => $pgroomtype
    ];
    $_SESSION['errormessage'] = 'Dear User Please Upload Image';
    $_SESSION['optionpick'] = 'pg';
    header("Location:../php_upload/upload.php");
    exit();
}

$tempimage = $_FILES['housepicpg']['tmp_name'];
$imagename = $_FILES['housepicpg']['name'];
$imagetype=$_FILES['housepicpg']['type'];
$bimage = file_get_contents($tempimage);

















if (isset($_POST['roomtypes'])) {
    $roomtype = implode(',', $_POST['roomtypes']);
} else {
    $roomtype = ''; 
}

if (isset($_POST['Preferredforpg'])) {
  $preferredpg = implode(',', $_POST['Preferredforpg']);
} else {
  $preferredpg = ''; 
}

if (isset($_POST['Foodincluded'])) {
    $foodfacility = implode(',', $_POST['Foodincluded']);
} else {
    $foodfacility = ''; 
}







include '../database/database.php';
database::$db_name = 'roomhunt';
database::connection();

$sql= database::connection()->prepare("INSERT INTO housedatapg(deposit, sqft, userid, city, area, address, rentrate, pgfor, roomtype, preferredfor, foodfacility, bathroomfacility, blobimage, mimetype,furnish,parking,metro,modeofhouse) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"  );
$sql->bind_param("iissssisssssssssss",$deposit, $sqft, $userid, $city, $area, $address, $rentrate, $pgfor, $roomtype, $preferredpg, $foodfacility, $bathroomfacility, $bimage, $imagetype,$furnish,$parking,$metro,$modeofhouse);
$sql->execute();
$sql->close();
header("Location:../frontend_houses/mysellhouse.php");
exit();
ob_end_clean();
?>