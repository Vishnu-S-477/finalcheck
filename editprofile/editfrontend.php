<?php 
session_start();
if(isset($_SESSION['userid'])){
    echo('login status Green');
    $_SESSION['backupsite'] = '';
}
else{
    
    $_SESSION['backupsite'] = '../editprofile/editfrontend.php';
    session_write_close();
    header("Location:../frontend_authentication/Login.php");
    exit();
}

$mailerror = isset($_SESSION['mailidexist'])?$_SESSION['mailidexist']:'';
$contacterror = isset($_SESSION['mobilenoexist'])?$_SESSION['mobilenoexist']:'';
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
session_unset();
$_SESSION['userid'] = $userid;
$_SESSION['username'] = $username;


$userid = $_SESSION['userid'];
$fname = '';
$lname = '';
$mailid = '';
$contactno = '';
$base64image = '';
$mimetype = '';

include '../database/database.php';
database::$db_name = 'roomhunt';
database::connection();

$sql=database::$connection->prepare("SELECT username,mailid,mobileno,imagetype,profilepic FROM Authorization WHERE userid = ? ");
$sql->bind_param("s",$userid);
$sql->execute();
$temp = $sql->get_result();
$storage = [];
while($sam = $temp->fetch_assoc()){
$sam['profilepic'] = base64_encode($sam['profilepic']);
$storage[] = $sam;

}
$base64image = $storage[0]['profilepic'];
$mimetype = $storage[0]['imagetype'];
$fullname = $storage[0]['username'];
$namesplit = explode(' ',$fullname);
$fname = $namesplit[0];
$lname = $namesplit[1];
$mailid = $storage[0]['mailid'];
$contactno = $storage[0]['mobileno'];
ob_end_clean();
?>






















<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
         body{
            display:flex;
            align-items:center;
            flex-direction: column;
            padding-top:65px;
            
        }
        /* css for start of header*/ 
 .header-main-container{
    display:flex;
    align-items:center;
    justify-content: space-between;
    height:62px;
    width:100%;
    background-color:black;
    color:white;
    font-family:arial,sans-serif;
    position:fixed;
    top:0;
    right:0;
    left:0;
  } 
  .logo-container{
  display: flex;
  align-items:center;
  justify-content:start;
  cursor:pointer;
  }
  .image-containersos{
    height:60px;
    width:60px;
  }
  .logo-img-stylesos{
    height:100%;
    width:100%;
    background-color:transparent;
  }
  .text-container{
    font-size:20px;
  }
  .filter-option{
    height:auto;
    font-size:20px;
    cursor:pointer;
  }
  .option-container{
    height:30px;
    width:30px;
    padding-right:10px;
    position:relative;
  }
  .menu-icon-style{
    height:100%;
    width:100%;
    background-color: transparent;
  }
  
  .option-main-container{
    height:auto;
    width:130px;
    border:1px solid black;
    border-radius:4px;
    padding:5px;
    font-family:arial;
    font-size:1rem;
    background-color:rgb(236, 233, 233);
    position:absolute;
    color:black;
    top:50px;
    left:-105px;
    display:none;
  }
  /* this is option container*/

        .main-container{
            height:auto;
            border:2px solid red;
            padding:15px;
            box-sizing: border-box;
            background-color:black;
            display:flex;
            flex-direction:column;
            align-items:center;
        }
        .profile-container{
            height:230px;
            width:68%;
          margin-bottom:20px;
        }
        .profile-style{
            height:100%;
            width:100%;
            border:2px solid red;
            border-radius:50%;
            object-fit:fill;
        }
        .heading{
            display:flex;
            justify-content:center;
            color:white;
        }
        .fname,.lname,.mailid,.contactno{
            height:40px;
            width:100%;
            box-sizing: border-box;
            margin-top:10px;
            margin-bottom:10px;
            font-family:arial;
            font-size:17px;
        }
        .upload-field{
            display:none;
        }
        .upload-button-container{
            display:flex;
            justify-content:space-between;
            height:40px;
            width:100%;
            margin-top:10px;
           margin-bottom:10px;
        
        }
        .upload-button,.submit-style{
            height:100%;
            width:45%;
            border:none;
            background-color:red;
            color:white;
            font-family:arial;
            font-size:18px;
        }
        .submit-style{
            background-color:green;
        }
            .span-style{
            font-family:arial;
            font-size:18px;
            color:red;
        }
        @media only screen and (max-width: 749px){
            .main-container{
                width:95%;
            }
            .profile-container{
            height:180px;
            width:180px;
            margin-bottom:20px;
        }
        .text-container{
            font-size:0px;
        }
        }
        @media only screen and (min-width:750px)  and (max-width: 950px){
            .main-container{
                width:55%;
            }
            .profile-container{
            height:190px;
            width:190px;
            margin-bottom:20px;
        }
        }

        @media only screen and (min-width:951px)  and (max-width: 1800px){
            .main-container{
                width:30%;
            }
            .profile-container{
            height:210px;
            width:210px;
            margin-bottom:20px;
        }
        }
        @media only screen and (min-width:1801px) and (max-width:3000px){
            .main-container{
                width:30%;
            }
            .profile-container{
            height:230px;
            width:230px;
            margin-bottom:20px;
        }
        }


    </style>
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
    <form class="main-container" action="editbackend.php" method="post" enctype="multipart/form-data">
        <div class="heading"><h1>Edit Profile</h1></div>
        <div class="profile-container"><img src="data:<?php echo($mimetype); ?>;base64,<?php echo($base64image);?>" class="profile-style"></div>
        <input type="text" class="fname" name="fname" value="<?php echo($fname); ?>"  placeholder="Edit First Name">
        <input type="text" class="lname" name="lname" value="<?php echo($lname); ?>" placeholder="Edit Last Name">
        <input type="text" class="mailid" name="mailid" value="<?php  !empty($mailerror) ? print('') : print($mailid); ?>" placeholder="Edit mailid">
        <span class="span-style">

        <?php isset($mailerror)?print($mailerror):print('') ?>
        </span>
        <input type="text" class="contactno" name="contactno" value="<?php !empty($contacterror)?print(''):print($contactno); ?>" placeholder="Edit contactno">
        <span class="span-style">
        <?php isset($contacterror)?print($contacterror):print('') ?>
        </span>
        <input type="file" class="upload-field" name="image">
        <div class="upload-button-container">
            <button type="button" class="upload-button">Edit Image</button>
            <input type="submit" class="submit-style" value="Save">
        </div>
    </form>
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

    const originalupload = document.querySelector('.upload-field');
    const pseudoupload = document.querySelector('.upload-button');
    pseudoupload.addEventListener('click',function(){
        originalupload.click();
    });
</script>
</html>