
<?php
    include("ziekmeldingendb.php");
    $conn = verbindDB();
    $studentenQuery = "SELECT * FROM studenten";
    $stm = $conn->prepare($studentenQuery);
    $stm->execute();
    $studenten = $stm->fetchAll(PDO::FETCH_OBJ);
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
                <h2>Ziek melden</h2>
                <label>Student:</label>
                <select name="selectStudent">
                    <?php 
                        foreach($studenten as $student) {
                    ?>      <option value="<?=$student->sid?>"><?=$student->voornaam." ".$student->achternaam?></option>
                    <?php
                        }
                    ?>
                </select>
                <div><label for="startdatum">Datum afwezigheid</label><div>
                <div><input type="date" name="txtStartdatum" id="startdatum"/></div>
                <label for="txtOpmerking">Opmerkingen:</label>
                <div><textarea name="txtOpmerking" id="txtOpmerking" rows="13" cols="70"></textarea></div>
                <div><input type="submit" name="btnZiek" id="btnZiek"/></div>
            </form>
        </div>
    </div>

    <?php 
        if(isset($_POST['btnZiek'])) {
            $toevoegenMeldingQuery = "INSERT INTO ziekmelding (sid,startdatum,opmerking,status) ". 
            "VALUES (:sid,:startdatum,:opmerking,'Ziek')";
            
            $stm = $conn->prepare($toevoegenMeldingQuery);
            $stm->bindParam(":sid",$_POST['selectStudent']);
            $stm->bindParam(":startdatum",$_POST['txtStartdatum']);
            $stm->bindParam(":opmerking",$_POST['txtOpmerking']);
            $stm->execute();
        }
    ?>
    
</body>
</html>