<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Receptinio vaisto priskyrimas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../Styles/styles.css">
  </head>
  <body>
  <?php
    include '../../session.php';
    $id = $_GET['id'];
    global $database;
    $result = $database->getNameAndSurname($_GET['id']);
    $nameSurname = '';

    while($row = mysqli_fetch_array($result)){
        $nameSurname= $row['fullName'];
    }
?>
    <br>
    <nav class="navbar fixed-top navbar-light navbar-expand-lg mt-0" style="background: #fff">
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
            <?php
				echo "<a class='btn btn-outline-dark' href='PatientPrescriptionMedicines.php?id={$id}'>Atgal</a>";
            ?>
            </li>
        </div>
    </nav>
    <br> 
    <br>
    <div class="form-group login">
        <form method='post'>
            <center><b>Receptinis vaistas</b></center><br>
            <div style="text-align: left;">
                <label for="pacientas">Pacientas:</label>
                <input name='pacientas' type='text' class="form-control" value='<?php echo $nameSurname; ?>' readonly >
            </div style="text-align: left;">
            <br>
            <div style="text-align: left;">
                <label for="pavadinimas">Vaisto pavadinimas:</label>
                <input name='pavadinimas' type='text' class="form-control" oninvalid="this.setCustomValidity('Neužpildytas vaisto pavadinimas')" oninput="this.setCustomValidity('')" required>
            </div>
            <br>
            <div style="text-align: left;">
                <label for="kiekis_mg">Kiekis (mg):</label>
                <input name='kiekis_mg' type='number' value="1" min="1" max="1000" class="form-control">
            </div style="text-align: left;">
            <br>
            <div style="text-align: left;">
                <label for="vartojimo_instrukcija">Vartojimo instrukcija:</label>
                <textarea class="form-control" rows="3" name="vartojimo_instrukcija" oninvalid="this.setCustomValidity('Neužpildyta vartojimo instrukcija')" oninput="this.setCustomValidity('')" required></textarea>
            </div style="text-align: left;">
            <br>
            <div style="text-align: left;">
                <label for="galioja_iki">Receptas galioja iki:</label>
                <input name='galioja_iki' type='date' class="form-control" oninvalid="this.setCustomValidity('Nepasirinkta recepto galiojimo pabaigos data')" oninput="this.setCustomValidity('')" required>
            </div style="text-align: left;">
            <br>
            <input class="btn btn-outline-dark" type="submit" name="newMedicine" value="Priskirti receptinį vaistą">
        </form>
    </div>
    <?php 
        if(isset($_POST['newMedicine'])){
            $data = date("Y-m-d");
            $pacientInfo = explode(" ", $_POST['pacientas']);
            $result = $database->addNewMedicine($_POST['pavadinimas'],$_POST['vartojimo_instrukcija'],$_POST['kiekis_mg'],1);
            $getMedicineExtract = $database->MedicineExtract($data,$pacientInfo[0],$pacientInfo[1],$_SESSION['vardas'],$_SESSION['pavarde']);
            $getMaximumID = $database->getMaxId();
            while($maxVaistuIsrasasID = mysqli_fetch_array($getMaximumID)){
                $recipeID = $maxVaistuIsrasasID;
            }
            $insertNew = $database->insertNewRecipe($_POST['galioja_iki'],$recipeID[0]);

            if($result == true && $getMedicineExtract == true  && $insertNew == true){
                echo "<div>Sėkmingai įtrepta</div>";
            } else {
                echo "<div>Nesėkmingai įtrepta</div>";
            }
            
        }
        ?>
</body>
</html>
