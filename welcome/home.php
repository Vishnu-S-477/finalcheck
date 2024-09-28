<?php 
session_start();
ob_start();
if(isset($_SESSION['userid'])){
    echo('login status Green');
    $_SESSION['backupsite'] = '';
}
else{
    
    $_SESSION['backupsite'] = '../welcome/home.php';
    session_write_close();
    header("Location:../frontend_authentication/Login.php");
    exit();
}

ob_end_clean();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoomHunt</title>
    <link rel="stylesheet" href="home.css">
    <style>
        body{
            background-image: url('../images/background-image.jpg');
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
           
        }
    </style>
</head>
<body>
<header class="header-main-container">
    <div class="logo-container">
        <div class="image-containersos"><img src="../images/logo-roomhunt.png" class="logo-img-stylesos"></div>
        <div class="text-container">RoomHunt</div>
    </div>

    <div class="filter-option">Welcome <span style="color:#FFD700"> <?php echo($_SESSION['username']); ?></span>!</div>

    <div class="option-container"><img src="../images/menu-icon.png" class="menu-icon-style">
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

  
  

    

    <form class="form-data" action="../frontend_houses/fullhousepage.php" method="post">
    <input type="text" name="city" placeholder="Enter City" class="city-box"  title="Enter Correct Spelling of City" required>
    <input type="text" name="area"  placeholder="Enter Area(optional)" class="area-box" title="Enter Correct Spelling of Area">
    <select class="dropdown-style" required>
        <option value="fullhouse">FullHouse</option>
        <option value="flathouse">FlatHouse</option>
        <option value="pgroom">Pg Room</option>
    </select>
    <div class="container-forward"><input type="image" src="../images/readygo.png" class="forward-style" alt="submit"></div>
</form>
</body>


<script>
    
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

let formdata = document.querySelector('.form-data');

let houseoption = document.querySelector('.dropdown-style');
houseoption.addEventListener('change',function(){
    if(houseoption.value === 'fullhouse'){
      formdata.action = '../frontend_houses/fullhousepage.php';
    }
    else if(houseoption.value === 'flathouse'){
        formdata.action = '../frontend_houses/flatmatepage.php';
    }
    else if(houseoption.value === 'pgroom'){
        formdata.action = '../frontend_houses/pgpage.php';
    }
});
    </script>
</html>
 
