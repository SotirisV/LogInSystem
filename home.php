<?php

    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogInProject</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    

<div class="banner">
    <div class="navbar">
    <a href="index.php"><h1>LogIn Project</h1> </a>
       <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>

       </ul>
    </div>

    
    <div class="content">
        
      

        <?php
        if(isset($_SESSION["email"])){
            echo "<p>Hello there " . $_SESSION["email"] . "</p>";
            echo "<a href='profile.php'><button type='button'><span></span>PROFILE PAGE</button></a>";
            echo  "<a href='logout-detailes.php'><button type='button'><span></span>LOG OUT</button></a>";
        }
        else{
            echo "<h2>Create your account here</h2>";
        echo "<p>If you already have one login</p>";
            echo "<a href='signup.php'><button type='button'><span></span>SIGN UP</button></a>";
            echo  "<a href='login.php'><button type='button'><span></span>LOG IN</button></a>";
        }


    ?>

        </div>
    </div>
</div>
</body>
</html>