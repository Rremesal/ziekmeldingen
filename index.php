<?php 
    include("ziekmeldingendb.php"); 
    $conn = verbindDB();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Overzicht</title>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
    <?php require("menu.php");?>
    <div class="content">
        <!-- <h2 class="homeHeader">Presentie</h2> -->
        <div id="tabs"><button id="btnPresentie" onclick="veranderTabel()" disabled>Presentie</button><button id="btnZiekmelding" onclick="veranderTabel()">Ziekmeldingen</button></div>
        <table id="presentieTabel">
            <tr>
                <th>Voornaam</th>
                <th>Achternaam</th>
                <th>Geboortedatum</th>
            </tr>
            <?php 
                $query = "SELECT * FROM studenten WHERE sid NOT IN (SELECT sid FROM ziekmelding ". 
                "WHERE status = 'Ziek') ORDER BY voornaam ASC;";
                $stm = $conn->prepare($query);
                $stm->execute();
                $studenten = $stm->fetchAll(PDO::FETCH_OBJ);
                foreach($studenten as $student) {
            ?>      <tr>
                        <td><?= $student->voornaam?></td>
                        <td><?=$student->achternaam,$student->tussenvoegsel?></td>
                        <td><?=$student->geboortedatum?></td>
                    </tr>
            <?php } ?>
        </table>
        
        <!-- <h2 class="homeHeader">Ziekmeldingen</h2> -->
        <table id="ziekmeldingTabel">
            <tr>
                <th>Voornaam</th>
                <th>Achternaam</th>
                <th>Startdatum</th>
                <th>Status</th>
                <th>Opmerkingen</th>
                <th></th>
            </tr>
            <?php 
                $query = "SELECT * FROM studenten s JOIN ziekmelding z ON s.sid = z.sid WHERE einddatum IS NULL";
                $stm = $conn->prepare($query);
                $stm->execute();
                $ziekeStudenten = $stm->fetchAll(PDO::FETCH_OBJ);
                foreach($ziekeStudenten as $ziekeStudent) {
            ?>      <tr>
                        <td><?= $ziekeStudent->voornaam?></td>
                        <td><?=$ziekeStudent->achternaam,$ziekeStudent->tussenvoegsel?></td>
                        <td><?=$ziekeStudent->startdatum?></td>
                        <td><?=$ziekeStudent->status?></td>
                        <td><?=$ziekeStudent->opmerking?></td>
                        <td><a href="beter.php?id=<?=$ziekeStudent->sid?>">Beter melden</a></td>
                    </tr>
            <?php
                }
            ?>
        </table>
    </div>
    <script src="javascript/script.js"></script>
</body>
</html>