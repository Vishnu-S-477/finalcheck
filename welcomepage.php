<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoomHunt</title>
    <style>
        body{
            background-color: pink; 
            color: #ecf0f1; 
            display:flex;
            flex-direction: column;
            align-items: center;
            padding-top:65px;
        }
        .heading{
        font-family: 'Poppins', sans-serif;
        font-size:2.5rem;
        margin-bottom:80px;
        }
        .login-button,.signup-button{
            height:auto;
            width:auto;
            padding:15px 18px;
            border:none;
            font-family:Cambria;
            font-size:1.5rem;
            cursor:pointer;
            color:white;
            background-color:orange;
            border-radius:7px;  
            margin-bottom:30px;
            transition:background-color 0.3s,font-size 0.3s;  
        }
        .signup-button{
            background-color: #007bff;
        }
        .login-button:hover{
            background-color:rgb(226, 9, 154);
            font-size:1.7rem;
        }
        .signup-button:hover{
            background-color:rgb(41, 197, 2);
            font-size:1.7rem;
        }
        .logo-design{
            height:70px;
            width:70px;
            margin-bottom:30px;
            border:2.5px solid white;
            border-radius:50%;

        }
        @media only screen and (min-width:0px) and (max-width:740px){
            .heading{
                font-size:1.7rem;
            }
            .login-button,.signup-button{
                font-size:1rem;
            }
            .login-button:hover,.signup-button:hover{
                font-size:1.3rem;
            }
        }
        @media only screen and (min-width:742px) and (max-width:1000px){
            .heading{
                font-size:2.1rem;
            }
            .login-button,.signup-button{
                font-size:1.3rem;
            }
            .login-button:hover,.signup-button:hover{
                font-size:1.6rem;
            }
        }
    </style>
</head>
<body>
    <img src="images/logo-roomhunt.png" class="logo-design">
    <header class="heading">Welcome To RoomHunt</header>
    <a style="text-decoration:none;" href="frontend_authentication/Login.php"><button class="login-button">Click To Login</button></a>
    <a style="text-decoration:none;" href="frontend_authentication/Signup.php"><button title="Signup" class="signup-button">New User</button></a>
</body>
</html>