<?php
    session_start();
    require "db/QueryBuild.php";
    $queryBuild = new QueryBuilds();
    $_GET['sort'] != NULL ? $sort = $_GET['sort']: $sort = 1;
    $reviews = $queryBuild->getReviews(false, $sort);
    include "views/index.show.php";
    unset($_SESSION['validCheck']);
?>