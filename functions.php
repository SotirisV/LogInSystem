<?php

function emptyInputSignup($name, $email, $pwd, $pwdRepeat){
  
    return(empty($name) || empty($email) || empty($pwd) || empty($pwdRepeat));
       
}

function invalidName($name){
  
    return(!preg_match("/^[a-zA-Z0-9]*$/", $name));

}

function invalidEmail($email){
  
    return(!filter_var($email, FILTER_VALIDATE_EMAIL));

}

function pwdMatch($pwd, $pwdRepeat){
  
    if ($pwd !== $pwdRepeat) {
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function emailExists($conn, $email){
    $sql = "SELECT * FROM members WHERE membersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        mysqli_stmt_close($stmt); // Move this line outside the conditional blocks
        return $row;
    }
    else{
        mysqli_stmt_close($stmt); // Move this line outside the conditional blocks
        return false;
    }
}


function createUser($conn, $name, $email, $pwd){
    $sql = "INSERT INTO members (membersName, membersEmail, membersPwd) VALUES ( ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: login.php?youlogedin");
    exit();
}

function emptyInputLogin($email, $pwd){
   if(empty($email) || empty($pwd)){
    $result = true;
   }
   else{
    $return = false;
   }
   return $result;
}

function loginUser($conn, $email, $pwd){
  $emailExists = emailExists($conn, $email);

    if($emailExists === false){
        header("location: login.php?error=emptyinput");
        exit();
    }

    $pwdHashed = $emailExists["membersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if($checkPwd === false){
        header("location: login.php?error=wronglogin");
        exit();
    }
    elseif($checkPwd === true){
        session_start();
        $_SESSION["email"] = $emailExists["membersEmail"];
        header("location: index.php");
        exit();
    }
}