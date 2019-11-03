<?php
    require "../DB/QueryBuild.php";

    $queryBuild = new QueryBuilds;

    $idRev = $_GET['idRev'];
    $idModRev = $_GET['idModRev'];
    $checked = $_GET['checked'];
    $reviewMod = $_POST['reviewMod']."<br>Изменено администратором";
    $queryBuild->editCheck($idRev, $checked);
    $queryBuild->editReview($idModRev, $reviewMod);
    header('Location: ../admin.php'); 
die;