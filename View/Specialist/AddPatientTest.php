<?php include("../../session.php")?>
<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Naujas tyrimas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../Styles/styles.css">
  </head>
  <body>

    <br>
    <nav class="navbar fixed-top navbar-light navbar-expand-lg mt-0" style="background: #fff">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
            <?php echo "<a class=\"btn btn-outline-dark\" href='PatientTests.php?id={$_GET['id']}'>Atgal</a>" ?>
            </li>
        </div>
    </nav>
    <br> 
    <br>
    <?php 
        global $database;
        $query = "SELECT vardas"
    ?>
    <div class="form-group login">
        <form method='post'>
            <center><b>Naujas tyrimas</b></center><br>
            <div style="text-align: left;">
                <label for="pacientas">Pacientas:</label>
                <input name='pacientas' type='text' class="form-control" readonly>
            </div style="text-align: left;">
            <br>
            <div style="text-align: left;">
                <label for="data">Tyrimo atlikimo data:</label>
                <input class="form-control" type="date" name="data" oninvalid="this.setCustomValidity('Neužpildyta tyrimo atlikimo data')" oninput="this.setCustomValidity('')" required>
            </div>
            <br>
            <div style="text-align: left;">
                <label for="aprasymas">Tyrimo aprašymas:</label>
                <textarea class="form-control" rows="3" name="aprasymas" oninvalid="this.setCustomValidity('Neužpildyta siuntimo priežastis')" oninput="this.setCustomValidity('')" required></textarea>
            </div style="text-align: left;">
            <br>
            <div style="text-align: left;">
                <label for="isvada">Tyrimo išvados:</label>
                <textarea class="form-control" rows="3" name="isvada" oninvalid="this.setCustomValidity('Neužpildytas siuntimo komentaras')" oninput="this.setCustomValidity('')" required></textarea>
            </div style="text-align: left;">
            <br>
            <input class="btn btn-outline-dark" type="submit" value="Pridėti tyrimą">
        </form>
    </div>
</body>
</html