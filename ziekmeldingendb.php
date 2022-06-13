<?php

function connectToDB() {
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ziekmelden";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
        return $conn;
    } catch (Exception $ex) {
        echo "verbinding mislukt";
    }

}