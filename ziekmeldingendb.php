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
    $query = "INSERT INTO studenten (voornaam,tussenvoegsel,achternaam,geboortedatum) ". 
    "VALUES (:voornaam,:tussenvoegsel,:achternaam,:geboortedatum)";
    $stm = $conn->prepare($query);
    $stm->bindParam(":voornaam",$voornaam);
    $stm->bindParam(":tussenvoegsel",$tussenvoegsel);
    $stm->bindParam(":achternaam",$achternaam);
    $stm->bindParam(":geboortedatum",$geboortedatum);
    return $stm->execute();
}

function toevoegenZiekmelding($sid,$startdatum,$opmerking) {
    $conn = verbindDB();
    $query = "INSERT INTO ziekmelding (sid,startdatum,opmerking,status) ". 
    "VALUES (:sid,:startdatum,:opmerking,'Ziek')";
    $stm = $conn->prepare($query);
    $stm->bindParam(":sid",$sid);
    $stm->bindParam(":startdatum",$startdatum);
    $stm->bindParam(":opmerking",$opmerking);
    $stm->execute();

}