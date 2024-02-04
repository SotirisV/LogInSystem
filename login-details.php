<?php

if (isset($_POST["submit"])) {

    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    
    require_once 'dbdetails.php';
    require_once 'functions.php';

    if (emptyInputLogin($email, $pwd) === false) {
        header("location: login.php?error=emptyinput");
        exit();
    }

    if (loginUser($conn, $email, $pwd) !== false) {
        header("location: login.php?error=wronginfo");
        exit();
    }

    loginUser($conn, $email, $pwd);

} else{
    header("location: login.php");
    exit();
}