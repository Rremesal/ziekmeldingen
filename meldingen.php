
<?php
    include("ziekmeldingendb.php");
    $conn = verbindDB();
    $query = "SELECT sid FROM studenten WHERE sid=".$_GET['id']."";
    $stm = $conn->prepare($query);
    $stm->execute();
    $studentId = $stm->fetch(PDO::FETCH_OBJ);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/style.css"/>
    <title>Ziekmelden</title>
</head>
<body>
    <?php require("menu.php");?>
    <div class="content" id="meldingenContent">
        <div id="meldingForm">
            <form method="POST">
                <h2>Ziek Melden</h2>
                <label for="startdatum">Begindatum:</label>
                <div><input type="date" name="txtStartdatum" id="startdatum"/></div>
                <label for="txtOpmerking">Opmerkingen:</label>
                <div><textarea name="txtOpmerking" id="txtOpmerking" rows="13" cols="70"></textarea></div>
                <div><input type="submit" name="btnZiek"/></div>
            </form>
        </div>
    </div>

    <?php 
        if(isset($_POST['btnZiek'])) {
            $toevoegenMeldingQuery = "INSERT INTO ziekmelding (sid,startdatum,opmerking,status) ". 
            "VALUES (:sid,:startdatum,:opmerking,'Ziek')";
            $stm = $conn->prepare($toevoegenMeldingQuery);
            $stm->bindParam(":sid",$studentId->sid);
            $stm->bindParam(":startdatum",$_POST['txtStartdatum']);
            $stm->bindParam(":opmerking",$_POST['txtOpmerking']);
            $stm->execute();
        }
    ?>
    
</body>
</html>