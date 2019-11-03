<?php
session_start();
    require "../DB/QueryBuild.php";

    $queryBuild = new QueryBuilds();

    $login = $_POST['login'];
    $password = $_POST['password'];

    $userDate = $queryBuild->checkLogin($login, $password);

    if($userDate['login'] == $login && $userDate['password']==$password){
        $_SESSION['id'] = $userDate['id'];
        header("Location: ../admin.php");
        die;
    }
    else{
        header("Location: ../login.php");
        die;
    }
die;