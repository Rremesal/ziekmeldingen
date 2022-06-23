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
        <h2 class="homeHeader">Presentie</h2>
        <table>
            
            <tr>
                <th>Voornaam</th>
                <th>Achternaam</th>
                <th>Geboortedatum</th>
            </tr>
            <?php 
                $studentenQuery = "SELECT * FROM studenten WHERE sid NOT IN (SELECT sid FROM ziekmelding ". 
                "WHERE status = 'Ziek') ORDER BY voornaam ASC;";
                $stm = $conn->prepare($studentenQuery);
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
        
        <h2 class="homeHeader">Ziekmeldingen</h2>
        <table>
            
            <tr>
                <th>Voornaam</th>
                <th>Achternaam</th>
                <th>Startdatum</th>
                <th>Status</th>
                <th>Opmerkingen</th>
                <th></th>
            </tr>
            <?php 
                $ziekeStudent = "SELECT * FROM studenten s JOIN ziekmelding z ON s.sid = z.sid WHERE einddatum IS NULL";
                $stm = $conn->prepare($ziekeStudent);
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
</body>
</html>