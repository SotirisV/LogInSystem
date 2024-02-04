<?php

if (isset($_POST["submit"])){
 
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];

    require_once 'dbdetails.php';
    require_once 'functions.php';

    if (emptyInputSignup($name, $email, $pwd, $pwdRepeat) !== false){
        header("location: signup.php?error=emptyinput");
        exit();
    }
    
    if(invalidEmail($email) !== false){
        header("location: signup.php?error=choosecorrectemail");
        exit();
    }

    if(invalidName($name) !== false){
        header("location: signup.php?error=errorinputname");
        exit();
    }

    if(pwdMatch($pwd, $pwdRepeat) !== false){
        header("location: signup.php ?error=passwordsdontmatch");
        exit();
    }

    if(emailExists($conn, $email) !== false){
        header("location: signup.php?error=emailtaken");
        exit();
    }

    createUser($conn, $name, $email, $pwd);
    
}
else {
    header("location: login.php");
    
}