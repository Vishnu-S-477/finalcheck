<?php 
session_start();
ob_start();
if(isset($_SESSION['userid'])){
    echo('login status Green');
    $_SESSION['backupsite'] = '';
}
else{
    
    $_SESSION['backupsite'] = '../profile/myprofile.php';
    session_write_close();
    header("Location:../frontend_authentication/Login.php");
    exit();
}
ob_end_clean();

$userid = $_SESSION['userid'];
include '../database/database.php';
database::$db_name = 'roomhunt';
database::connection();
$storage = [];
$sql = database::$connection->prepare("SELECT username,mailid,mobileno,profilepic,imagetype FROM Authorization WHERE userid=?");
$sql->bind_param("s",$userid);
$sql->execute();
$temp = $sql->get_result();
while($tempss =$temp->fetch_assoc()){
    $tempss['profilepic'] = base64_encode( $tempss['profilepic']);
    $storage[] = $tempss;
}

$jsstorage = json_encode($storage);
ob_end_clean();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="myprofile.css">
 
</head>
<body>
<header class="header-main-container">

<a href="../welcome/home.php" style="color:white;text-decoration:none;"><div class="logo-container">
    <div class="image-containersos"><img src="../images/logo-roomhunt.png" class="logo-img-stylesos"></div>
    <div class="text-container">RoomHunt</div>
</div>
</a>


<div class="filter-option"></div>

<div class="option-container" style="cursor:pointer"><img src="../images/menu-icon.png" class="menu-icon-style">

    <div class="option-main-container">
    <a href="../profile/myprofile.php" style="text-decoration:none; color:black"><div>My Profile</div></a>
            <hr>
            <a href="../frontend_houses/mysellhouse.php" style="text-decoration:none;color:black"><div>My SellHouse</div></a>
            <hr>
            <a href="../frontend_houses/mypage.php" style="text-decoration:none;color:black"><div>My RentalHouse</div></a>
            <hr>
            <a href="../php_upload/upload.php" style="text-decoration:none;color:black"><div>Upload Houses</div></a>
            <hr>
            <a href="../signout/signout.php" style="text-decoration:none;color:black"><div>Signout</div></a>
    </div>
</div>
</header>
    
    <div class="main-container">
        <h1>My Profile</h1>
       <div class="profile-container">
          <img src="../images/sample-profile.png" class="profile-style">
       </div>
       <hr class="hrlines">
       <div class="details-container">
       <div class="name-container">
            <p class="name-label">Name:</p>
            <p class="actual-name">Loading...</p>
       </div>
       <hr class="hrline">
       <div class="mailid-container">
            <p class="mailid-label">EmailId:</p>
            <p class="actual-mailid">Loading...</p>
       </div>
       <hr class="hrline">
       <div class="phonenumber-container">
        <p class="phone-label">Phone Number</p>
        <p class="actual-number">Loading...</p>
       </div>
       <div class="edit-button-container">
        <a style="text-decoration:none;color:white;" href="../editprofile/editfrontend.php"><button class="edit-buttonss">Edit</button></a>
       </div>
       </div>

    </div>
</body>
<script>
     // The js code for header interactive
   let menu = document.querySelector('.option-container');

let dropdown = document.querySelector('.option-main-container');
menu.addEventListener('click',function(){

    if(dropdown.style.display == 'block'){
        dropdown.style.display = 'none';
    }
    else{
        dropdown.style.display = 'block';
    }
});


// the js code for header interactive
    const jsarray = <?php echo($jsstorage); ?>;
    const imagetype = jsarray[0]['imagetype'];
    const base64image = jsarray[0]['profilepic'];
    const name = jsarray[0]['username'];
    const mailid = jsarray[0]['mailid'];
    const contactno = jsarray[0]['mobileno'];
    const srcs = `data:${imagetype};base64,${base64image}`;
    const imageaccess = document.querySelector('.profile-style');
    imageaccess.src = srcs;
    document.querySelector('.actual-name').innerHTML = name;
    document.querySelector('.actual-mailid').innerHTML = mailid;
    document.querySelector('.actual-number').innerHTML = contactno;
</script>
</html>