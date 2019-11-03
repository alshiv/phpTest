<?php

require 'DB.php';

    class QueryBuilds extends DB
    {
        private $pdo;

        public function __construct()
        {
            $this->pdo = $this->dbConnect();
        }

        public function addReview($data){
            $sql = "INSERT INTO review_tbl (userName, userMail, userReview, userImage) VALUES (:userName, :userMail, :userReview, :userImage)";
            $statement = $this->pdo->prepare($sql);
            $result = $statement->execute($data);
            return $result;
        }

        public function getReviews($checked = true, $sort=1){
            if ($sort == 1){
                $sql = "SELECT * FROM review_tbl WHERE adminCheck = '1' ORDER BY reviewDate DESC";
            }
            if ($sort == 2){
                $sql = "SELECT * FROM review_tbl WHERE adminCheck = '1' ORDER BY userName DESC";
            }
            if ($sort ==3 ){
                $sql = "SELECT * FROM review_tbl WHERE adminCheck = '1' ORDER BY userMail DESC";
            }
            if ($checked)
            {
                $sql = "SELECT * FROM review_tbl ORDER BY reviewDate DESC";
            }

            $statement = $this->pdo->query($sql);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }


        public function editCheck($idRev, $checked){
            $sql = "UPDATE review_tbl SET adminCheck=:checked WHERE id=:idRev";
            $statement = $this->pdo->prepare($sql);
            $result = $statement->execute(array(
                ':idRev' => $idRev,
                ':checked' => $checked
            ));
            return $result;
        }

        public function checkLogin($login, $password){
            $sql = "SELECT * FROM users_tbl WHERE login=:login AND password=:password";
            $statement = $this->pdo->prepare($sql);
            $statement ->execute(array(
                ':login'=>$login,
                ':password'=>$password
            ));
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        public function editReview($idRev, $reviewMod){
            $sql = "UPDATE review_tbl SET userReview=:reviewMod WHERE id=:idRev";
            $statement = $this->pdo->prepare($sql);
            $result = $statement->execute(array(
                ':idRev' => $idRev,
                ':reviewMod' => $reviewMod
            ));
            return $result;
        }
    }
    