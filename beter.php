<?php 
    include("ziekmeldingendb.php");
    $conn = verbindDB();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/style.css"/>
    <title>Beter melden</title>
</head>
<body>
    <?php require("menu.php");?>
    <div class="content" id="beterContent">
        <div id="beterDiv">
            <h2>Beter melden</h2>
            <form method="POST" class="forms">
                <label for="einddatum">Datum beter:</label>
                <div><input type="date" name="einddatum" id="einddatum"/></div>
                <div><input type="submit" name="btnBeter" class="btnForm"></div>
            </form>
        </div>
    </div>

    <?php 
        if(isset($_POST['btnBeter'])) {
            $status = "Beter";
            $updateStatusQuery = "UPDATE ziekmelding SET einddatum=:einddatum ,status=:status WHERE sid=:id";
            $stm = $conn->prepare($updateStatusQuery);
            $stm->bindParam(":id",$_GET['id']);
            $stm->bindParam(":einddatum",$_POST['einddatum']);
            $stm->bindParam(":status",$status);
            $stm->execute();
        }
    ?>
    
</body>
</html>