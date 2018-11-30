
<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Paciento rezervacijos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../Styles/styles.css">
  </head>
  <body>
  <br>

    <nav class="navbar fixed-top navbar-light navbar-expand-lg mt-0" style="background: #fff">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="btn btn-outline-dark" href=\unDzifted>Atgal</a>
            </li>
            <li>
            <?php
                echo "<a class='nav-link' href='PatientNewReservation.php?id={$_GET['id']}'>Registracija pas gydytoją</a>";
             ?>
            </li>
        </div>
    </nav>
    <br>
    <br>
        <?php 
        include("../errorDisplay.php");
    ?>

    <div class='form-group login'>
        <form method='GET' action='PatientReservations.php?'>
            <?php
            echo "<input type='hidden' name='id' value='{$_GET['id']}'>";
            ?>
            <div style="text-align: left;">
                <label for="vardas">Apsilankymų istorija nuo:</label>
                <input name='laikas1' type='date' class='form-control' value='' oninvalid="this.setCustomValidity('Nepasirinkta pradžios data')" oninput="this.setCustomValidity('')" required>
            </div>
            <br>
            <div style="text-align: left;">
                <label for="vardas">Apsilankymų istorija iki:</label>
                <input name='laikas2' type='date' class='form-control' value='' oninvalid="this.setCustomValidity('Nepasirinkta pabaigos data')" oninput="this.setCustomValidity('')" required>
            </div>
            <br>
            <input class='btn btn-outline-dark' type='submit' value='Filtruoti'>
        </form>
    </div>
    <br>

    <table class="table table-light table-bordered table-hover" style="width: 80%; margin: 0 auto; text-align: center">
        <thead class="thead-dark">
            <th>Gydytojas</th>
            <th>Laikas</th>
            <th>Kabinetas</th>
            <th>Rezervacijos atšaukimas</th>
        </thead>
        <tbody>
        <?php
            global $database;
            $result = $database->getPatientReservations($_GET['id']);
            foreach($result as $key => $val ){
                $query = "SELECT vardas, pavarde FROM " . TBL_VARTOTOJAS . " where id_VARTOTOJAS='{$val['fk_SEIMOS_GYDYTOJASid_SEIMOS_GYDYTOJAS']}'";
                $result2 = $database->query($query);
                $secondary = mysqli_fetch_assoc($result2);
                echo "<form action='../../Controller/PatientController.php' method='POST'>";
                echo "<input type='hidden' name='reservacijos_id' value='{$val['id_REZERVACIJA']}'>";
                echo "<input type='hidden' name='id' value='{$_GET['id']}'>";
                echo "<tr>";
                echo "<td>{$secondary['vardas']} {$secondary['pavarde']}</td><td>{$val['data']}</td><td>{$val['vieta']}</td>";
                if ( (strtotime(date("Y-m-d h:m:s"))) > (strtotime($val['data']))){
                    echo "<td>Susitikimas jau praėjo</td>";
                }
                else if ((strtotime(date("Y-m-d h:m:s")) + 86400) < strtotime($val['data']))
                {
                    echo "<td><input class='btn btn-link' name='deleteReservation' type='submit' value='Atšaukti rezervaciją'></td>";
                }
                else{
                    echo "<td>Atšaukti nebegalima</td>";
                }
                echo "</tr>";
                echo "</form>";
            }
        ?>
        </tbody>
    </table>

</body>
</html