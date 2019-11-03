<?php
    session_start();
    
    require "../db/QueryBuild.php";

    $queryBuild = new QueryBuilds();

    $userName = $_POST['userName'];
    $userMail = $_POST['userMail'];
    $userReview = $_POST['userReview'];
    $fileName = loadImage($_FILES['userImage']);

    $validCheck = [];

    $data = [
        'userName' => $userName,
        'userMail' => $userMail,
        'userReview' => $userReview,
        'userImage' => $fileName
    ];

    function resizeimg($extension, $file) {
        switch($extension){
            case 'png':
            $img = imagecreatefrompng($file);
            break;

            case 'jpg':
            $img = imagecreatefromjpeg($file);
            break;
            
            case 'gif':
            $img = imagecreatefromgif($file);
            break;
        }
        $imgRes = imagecreatetruecolor(320, 240);
        imagecopyresampled($imgRes,$img,0,0,0,0,320,240,imagesx($img),imagesy($img));
        
        switch($extension){
            case 'png':
            $res = imagepng($imgRes, $file);
            break;

            case 'jpg':
            $res = imagejpeg($imgRes, $file);
            break;
            
            case 'gif':
            $res = imagegif($imgRes, $file);
            break;
        }
        imagedestroy($img);
        imagedestroy($imgRes);
        return $res;
    }

    function loadImage($file){
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        if (strlen($extension)>0 && ($extension=='png' || $extension == 'gif' || $extension == 'jpg')){   
            $fileName = uniqid().".".$extension;
            move_uploaded_file($file['tmp_name'], "../img/".$fileName);
            resizeimg($extension, "../img/".$fileName);
            return $fileName;
        }
        else{
            $fileName = '';
        }
    }

    if (strlen($userName) == 0)
    {
        $validCheck['userName']['msg'] = 'Заполните обязательное поле';
    }
    if (strlen($userMail) == 0)
    {
        $validCheck['userMail']['msg'] = 'Заполните обязательное поле';
    }
    if (strlen($userReview) == 0)
    {
        $validCheck['userReview']['msg'] = 'Заполните обязательное поле';
    }

    if (count($validCheck) > 0)
    {
        $_SESSION['validCheck'] = $validCheck;
        header('Location: ../index.php');
        die;
    }

    $queryBuild->addReview($data);

    header('Location: ../index.php'); 
die;
