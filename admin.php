<?php
session_start();
require "db/QueryBuild.php";

if (!empty($_SESSION['id'])){
    $queryBuild = new QueryBuilds();
    $reviews = $queryBuild->getReviews(true, 1);
    include "views/admin.show.php";
}
else{
    header("Location: ../login.php");
    die;
}