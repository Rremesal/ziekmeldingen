<?php 
    include("ziekmeldingendb.php"); 
    $conn = verbindDB();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
        <?php require("menu.php");?>
        <div class="content">
            <table>
                <tr>
                    <th>Voornaam</th>
                    <th>Tussenvoegsel</h>
                    <th>Achternaam</th>
                    <th>Geboortedatum</th>
                    <th></th>
                </tr>
                <?php 
                    $selecteerStudentenQuery = "SELECT * FROM studenten";
                    $stm = $conn->prepare($selecteerStudentenQuery);
                    $stm->execute();
                    $studenten = $stm->fetchAll(PDO::FETCH_OBJ);
                    foreach($studenten as $student) {
                ?>      <tr>
                            <td><?= $student->voornaam?></td>
                            <td><?=$student->tussenvoegsel?></td>
                            <td><?=$student->achternaam?></td>
                            <td><?=$student->geboortedatum?></td>
                            <td>
                                <a class="statusLink" href="meldingen.php?id=<?=$student->sid?>">Z</a>
                                <a  class="statusLink" href="beter.php?id=">B</a>
                            </td>
                        </tr>
                <?php } ?>
            </table>
        </div>
</body>
</html>