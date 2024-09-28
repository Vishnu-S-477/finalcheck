<?php
ob_start();
session_start();
$emailerroR = '';
$passerror = '';
$email = '';
if(isset($_SESSION['emailerror'])){
$emailerroR = $_SESSION['emailerror'];
}
if(isset($_SESSION['passerror'])){
    $passerror = $_SESSION['passerror'];
    $email = $_SESSION['emailidbackup'];
}
$backupsite = $_SESSION['backupsite'];
session_unset();
$_SESSION['backupsite'] = $backupsite;
ob_end_clean();
?>
    
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css_authentication/login.css">
    <style>
        body{
            background-color:white;
        }
    </style>
</head>
<body>
    <form class="main-container" action = "../backend_authentication/backendlogin.php" method = "post" enctype="multipart/form-data">
        <div class="heading"><h1>Login</h1></div>


        <input type="email" class="mailid" name="email" value ="<?php echo(htmlspecialchars(($email)?$email:'')); ?>"  placeholder="mailid" required>
        
        <span class="span-style">
            <?php 
        if(isset($emailerroR)){
            echo($emailerroR);
        }
        ?>
        </span>
        <input type="password" class="password" name="password" placeholder="Password" required>
        <span class="span-style">
            <?php 
            if(isset($passerror)){
                echo($passerror);
            }
            ?>
        </span>
    
        <div class="response-button-container">
            <div class="login-container"><a style="text-decoration: none;" href="Signup.php"><button type="button" class="signup-link">Signup</button></a></div>
            <input type="submit" class="submit-button" value="Login">
            
        </div>
    </form>
</body>
</html>