<?php

class DB
{
    public function dbConnect(){
        $pdo = new PDO("mysql:host=localhost;dbname=db_test", "root", "");
        return $pdo;
    }
}