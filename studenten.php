<?php include("ziekmeldingendb.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/style.css"/>
    <title>Studenten toevoegen</title>
</head>
<body>
    <?php include("menu.php");?>
    <div class="content" id="studentenContent">
        <div id="studentenDiv">
            <h2>Studenten Toevoegen</h2>
            <form method="POST" class="forms">
                <label for="txtVoornaam">Voornaam:</label>
                <div><input type="text" name="txtVoornaam" id="txtVoornaam" required/></div>
                <label for="txtTussenvoegsel">Tussenvoegsel:</label>
                <div><input type="text" name="txtTussenvoegsel" id="txtTussenvoegsel"/></div>
                <label for="txtAchternaam">Achternaam:</label>
                <div><input type="text" name="txtAchternaam" id="txtAchternaam" required/></div>
                <label for="txtGeboortedatum">Geboortedatum:</label>
                <div><input type="date" name="txtGeboortedatum" id="txtGeboortedatum" required/></div>
                <input type="submit" class="btnForm" name="btnSaveStudent"/><br/>
                <?php 
                    if(isset($_POST['btnSaveStudent'])) {
                        if(toevoegenStudent($_POST['txtVoornaam'],$_POST['txtTussenvoegsel'],$_POST['txtAchternaam'],$_POST['txtGeboortedatum']) == true) {
                            echo "student opgeslagen";
                ?>          </form>
                <?php
                        } else echo "er ging iets mis";
                    }    
                ?>
            </form>
        </div>
    </div>

    
    
</body>
</html>