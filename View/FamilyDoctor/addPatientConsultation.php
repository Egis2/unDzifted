<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Siuntimo išrašymas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../Styles/styles.css">
  </head>
  <body>
    <?php
    include '../../database.php';
    $id = $_GET['id'];
    global $database;
    $result = $database->getNameAndSurname($_GET['id']);
    $nameSurname = '';
    $getAllSpecialists = $database->getAllSpecialists();

    while($row = mysqli_fetch_array($result)){
        $nameSurname= $row['fullName'];
    }

    $speclists = array();
    $indexofSpecialist = 0;
    while($row = mysqli_fetch_array($getAllSpecialists)){
        $speclists[]= $row;
    }

   ?>
    <br>
    <nav class="navbar fixed-top navbar-light navbar-expand-lg mt-0" style="background: #fff">
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
            <?php
				echo "<a class='btn btn-outline-dark' href='patientConsultations.php?id={$id}'>Atgal</a>";
            ?>
            </li>
        </div>
    </nav>
    <br> 
    <br>
    <div class="form-group login">
        <form method="POST" action="../../Controller/FamilyDoctorsController.php">
            <center><b>Siuntimas pas gydytoją specialistą</b></center><br>
            <div style="text-align: left;">
                <label for="pacientas">Pacientas:</label>
                <input name='pacientas' type='text' class="form-control" value='<?php echo $nameSurname; ?>' readonly >
            </div style="text-align: left;">
            <br>
            <div style="text-align: left;">
                <label for="vardas">Gydytojas specialistas:</label>
               <?php
                echo "<select name='specialistSelect[]' class='form-control'>";
            foreach($speclists as $speclist)
            {
                echo "<option value='".$speclists[$indexofSpecialist]['specialistFullName']."'>".$speclists[$indexofSpecialist]['specialistFullName']."</option>";
                $indexofSpecialist = $indexofSpecialist + 1;
            }
            echo "</select>";
        ?>
            </div>
            <br>
            <div style="text-align: left;">
                <label for="priezastis">Siuntimo priežastis:</label>
                <textarea class="form-control" rows="3" name="priezastis" oninvalid="this.setCustomValidity('Neužpildyta siuntimo priežastis')" oninput="this.setCustomValidity('')" required></textarea>
            </div style="text-align: left;">
            <br>
            <div style="text-align: left;">
                <label for="komentaras">Siuntimo komentaras:</label>
                <textarea class="form-control" rows="3" name="komentaras" oninvalid="this.setCustomValidity('Neužpildytas siuntimo komentaras')" oninput="this.setCustomValidity('')" required></textarea>
            </div style="text-align: left;">
            <br>

            <input class="btn btn-outline-dark" type="submit" value="Išrašyti siuntimą">
            <input class="btn btn-outline-dark" type="hidden" name="siuntimas" value="1"/>
        </form>

        <?php var_dump($_POST);?>
    </div>
</body>
</html>
