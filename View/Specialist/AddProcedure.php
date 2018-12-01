<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Gydymo procedūros priskyrimas</title>
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
            <?php echo "<a class=\"btn btn-outline-dark\" href='PatientProcedures.php?id={$_GET['id']}'>Atgal</a>" ?>
            </li>
        </div>
    </nav>
    <br> 
    <br>
    <div class="form-group login">
        <form method='post'>
            <center><b>Gydymo procedūra</b></center><br>
            <div style="text-align: left;">
                <label for="pacientas">Pacientas:</label>
                <input name='pacientas' type='text' class="form-control" value='<?php echo $nameSurname; ?>' readonly >
            </div style="text-align: left;">
            <br>
            <div style="text-align: left;">
                <label for="data">Gydymo procedūros atlikimo data:</label>
                <input name='data' type='date' class="form-control" oninvalid="this.setCustomValidity('Nepriskirta gydymo procedūros atlikimo data')" oninput="this.setCustomValidity('')" required>
            </div>
            <br>
            <div style="text-align: left;">
                <label for="vieta">Vieta:</label>
                <input name='vieta' type='text' class="form-control"  oninvalid="this.setCustomValidity('Nepriskirta gydymo procedūros atlikimo vieta')" oninput="this.setCustomValidity('')" required>
            </div style="text-align: left;">
            <br>
            <div style="text-align: left;">
                <label for="aprasymas">Aprašymas:</label>
                <textarea class="form-control" rows="3" name="aprasymas" oninvalid="this.setCustomValidity('Neužpildytas gydymo procedūros aprašymas')" oninput="this.setCustomValidity('')" required></textarea>
            </div style="text-align: left;">
            <br>
            <input class="btn btn-outline-dark" type="submit" value="Priskirti gydymo procedūrą">
        </form>
    </div>
</body>
</html>
