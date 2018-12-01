<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Gydytojo algos nustatymas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../Styles/styles.css">
  </head>
  <body>
    
    <?php
         include '../../session.php';
        global $database;
        $query = "SELECT * FROM " . TBL_VARTOTOJAS . " WHERE id_VARTOTOJAS='{$_GET['id']}'";
        $result = $database->query($query);
        $row = $result->fetch_assoc();
    ?>
    <br>
    <nav class="navbar fixed-top navbar-light navbar-expand-lg mt-0" style="background: #fff">
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <?php
                    echo "<a class='btn btn-outline-dark' href='DoctorSalaries.php?id={$_GET['id']}'>Atgal</a>";
                ?>
            </li>
        </div>
    </nav>
    <br> 
    <br>
    <div class="form-group login">
        <form method='post'>
            <center><b>Gydytojo algos nustatymas</b></center><br>
            <div style="text-align: left;">
                <label for="vardas">Gydytojas:</label>
                <input name='vardas' type='text' class="form-control" value='<?php echo $row['vardas'], ' ', $row['pavarde']; ?>' readonly>
            </div>
            <br>
            <div style="text-align: left;">
                <label for="alga">Alga:</label>
                <input name='alga' type='number' value='400' min='400' max='10000' class="form-control" oninvalid="this.setCustomValidity('Neužpildyta gydytojo alga')" oninput="this.setCustomValidity('')" required>
            </div>
            <br>
            <div style="text-align: left;">
                <label for="ismokejimo_data">Išmokėjimo data:</label>
                <input name='ismokejimo_data' type='date' class="form-control" oninvalid="this.setCustomValidity('Nepasirinkta algos išmokėjimo data')" oninput="this.setCustomValidity('')" required>
            </div>
            <br>
            <input class="btn btn-outline-dark" type="submit" value="Nustatyti algą">
        </form>
    </div>
</body>
</html>
