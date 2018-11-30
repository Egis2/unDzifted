<?php
    include("../../database.php");
?>
<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Registracija pas gydytoją</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../Styles/styles.css">
  </head>
  <body>

    <br>
    <nav class="navbar fixed-top navbar-light navbar-expand-lg mt-0" style="background: #fff">
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
            <?php
                echo "<a class='btn btn-outline-dark' href='PatientReservations.php?id={$_GET['id']}'>Atgal</a>";
             ?>
            </li>
        </div>
    </nav>
    <br> 
    <br>
    <?php 
        $query = "SELECT * FROM ".TBL_VARTOTOJAS." WHERE id_VARTOTOJAS = (SELECT fk_GYDYTOJASid_VARTOTOJAS FROM " . TBL_GYDYMAS . " where fk_PACIENTASid_VARTOTOJAS='{$_GET['id']}')";
        $result = $database->query($query);
    ?>
    <div class="form-group login">
        <form method='POST' action='../../Controller/PatientController.php'>
        <?php
            echo "<input type='hidden' name='id' value='{$_GET['id']}'>";
        ?>
            <center><b>Registracija pas gydytoją</b></center><br>
            <div style="text-align: left;">
                <label for="vardas">Pasirinkti gydytoją:</label>
                <!-- <select name="gydytojas" class="form-control"> -->
                <?php
                    $row = mysqli_fetch_array($result);
                    echo "<input type='hidden' name='gydytojas' value='{$row['id_VARTOTOJAS']}'>";
                    echo "<input type='text' class='form-control' readonly value='{$row['vardas']} {$row['pavarde']}'>";
                    //foreach($result as $key => $val){
                        //echo "<option name=gydytojas value='{$val['id_VARTOTOJAS']}'>{$val['vardas']} {$val['pavarde']}</option>";
                    //}
                ?>
                </select>
            </div>
            <div style="text-align: left;">
                <label for="vardas">Pasirinkti laiką:</label>
                <?php
                    echo "<input name='laikas' type='datetime-local' class='form-control' value=''>";
                ?>
            </div>
            <br>
            <input class="btn btn-outline-dark" type="submit" name='addReservation' value="Registruotis pas gydytoją">
        </form>
    </div>
</body>
</html>
