<?php
include("ziekmeldingendb.php");
$conn = verbindDB();

$query = "SELECT voornaam, tussenvoegsel, achternaam FROM studenten s WHERE s.sid=" . $_GET['id'];
$stm1 = $conn->prepare($query);
$stm1->execute();
$student = $stm1->fetch(PDO::FETCH_OBJ);

$query = "SELECT * FROM studenten s JOIN ziekmelding z ON s.sid = z.sid WHERE s.sid=" . $_GET['id'];
$stm2 = $conn->prepare($query);
$stm2->execute();
$ziekmeldingen = $stm2->fetchAll(PDO::FETCH_OBJ);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/style.css" />
    <title>Aanwezigheid</title>
</head>

<body>
    <?php require("menu.php"); ?>
    <div class="content">
        <h1><?= $student->voornaam . " " . $student->tussenvoegsel . " " . $student->achternaam ?></h1>

        <?php
        if ($ziekmeldingen != NULL) {
        ?>
            <table>
                <tr>
                    <th>Startdatum</th>
                    <th>Einddatum</th>
                    <th>Opmerking</th>
                    <th>Status</th>
                </tr>
                <?php
                foreach ($ziekmeldingen as $ziekmelding) {
                ?> <tr>
                        <td><?= $ziekmelding->startdatum ?></td>
                        <td><?= $ziekmelding->einddatum ?></td>
                        <td><?= $ziekmelding->opmerking ?></td>
                        <td><?= $ziekmelding->status ?></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        <?php
        }
        if ($ziekmeldingen == NULL) { ?> <h3><?= "Er zijn geen ziekmeldingen geregistreerd" ?></h3> <?php } ?>
    </div>

</body>

</html>