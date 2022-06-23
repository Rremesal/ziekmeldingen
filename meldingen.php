<?php
    include("ziekmeldingendb.php");
    $conn = verbindDB();
    $query = "SELECT * FROM studenten WHERE sid NOT IN (SELECT sid FROM ziekmelding ". 
    "WHERE status = 'Ziek');";
    $stm = $conn->prepare($query);
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
        <div id="meldingDiv">
            <form method="POST" class="forms">
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
                <div><textarea name="txtOpmerking" id="txtOpmerking"></textarea></div>
                <div><input type="submit" name="btnZiek" class="btnForm"/></div>
            </form>
        </div>
    </div>

    <?php 
        if(isset($_POST['btnZiek'])) toevoegenZiekmelding($_POST['selectStudent'],$_POST['txtStartdatum'],$_POST['txtOpmerking'])
    ?>
    
</body>
</html>