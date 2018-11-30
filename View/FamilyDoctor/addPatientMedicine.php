<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Nereceptinio vaisto priskyrimas</title>
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
				echo "<a class='btn btn-outline-dark' href='patientMedicines.php?id={$id}'>Atgal</a>";
            ?>
            </li>
        </div>
    </nav>
    <br> 
    <br>
    <div class="form-group login">
        <form method='post'>
            <center><b>Nereceptinis vaistas</b></center><br>
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
                <textarea class="form-control" rows="3" id="vartojimo_instrukcija" oninvalid="this.setCustomValidity('Neužpildyta vartojimo instrukcija')" oninput="this.setCustomValidity('')" required></textarea>
            </div style="text-align: left;">
            <br>
            <input class="btn btn-outline-dark" type="submit" value="Priskirti nereceptinį vaistą">
        </form>
    </div>
</body>
</html>
