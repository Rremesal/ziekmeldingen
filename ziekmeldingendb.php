<?php

function verbindDB() {
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

function toevoegenStudent($voornaam,$tussenvoegsel,$achternaam,$geboortedatum) {
    $conn = verbindDB();
    $toevoegingQuery = "INSERT INTO studenten (voornaam,tussenvoegsel,achternaam,geboortedatum) ". 
    "VALUES ('$voornaam','$tussenvoegsel','$achternaam','$geboortedatum')";
    $stm = $conn->prepare($toevoegingQuery);
    return $stm->execute();
}