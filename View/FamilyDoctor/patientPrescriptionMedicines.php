<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Paciento receptiniai vaistai</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../Styles/styles.css">
  </head>
  <body>

<?php 
    include '../../session.php';
    global $database;
    $result = $database->getId($_GET['id']);
    $index = 0;

    while($row = mysqli_fetch_array($result)){
        $id = $row['id_VARTOTOJAS'];
    }
?>
    <br>
    <nav class="navbar fixed-top navbar-light navbar-expand-lg mt-0" style="background: #fff">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="btn btn-outline-dark" href=PatientList.php>Atgal</a>
            </li>
            <li>
			<?php
				echo "<a class='nav-link' href='addPatientPrescriptionMedicine.php?id={$id}'>Priskirti receptinį vaistą</a>";
            ?>
            </li>
        </div>
    </nav>
    <br><br>
    <?php 

    /* ALERT MENIU */
    if (isset($_SESSION['success']) && !$_SESSION['success']) 
    {
        echo "<div class='alert alert-danger mb-0 text-center' role='alert'>".
                "<strong>{$_SESSION['message']}</strong>".
            "</div>";
    }
    else if (isset($_SESSION['success']) && $_SESSION['success'])
    {
        echo "<div class='alert alert-success mb-0 text-center' role='alert'>".
        "<strong>{$_SESSION['message']}</strong>".
        "</div>";
    }
    unset($_SESSION['success']);
    unset($_SESSION['message']);
    ?>
    <br>

    <table class="table table-light table-bordered table-hover" style="width: 80%; margin: 0 auto; text-align: center">
        <thead class="thead-dark">
        <th>Pavadinimas</th>
            <th>Kiekis (mg)</th>
            <th>Vartojimo instrukcija</th>
            <th>Išrašymo data</th>
            <th>Galioja iki</th>
        </thead>
        <tbody>
        <?php 
            global $database;
            $query = "SELECT * FROM ". TBL_VAISTU_ISRASAS ." WHERE fk_PACIENTASid_VARTOTOJAS = '{$_GET['id']}'";
            $vaistu_israsai = $database->query($query);
            foreach($vaistu_israsai as $key => $val){
                $query = "SELECT * FROM ". TBL_VAISTAS. " WHERE receptinis='1' and id_VAISTAS=".$val['fk_VAISTASid_VAISTAS'];
                $rows = mysqli_num_rows($database->query($query));
                $vaistas = mysqli_fetch_array($database->query($query));
                if (mysqli_num_rows($database->query($query)) > 0){
                    $query = "SELECT * FROM ". TBL_RECEPTAS ." WHERE fk_VAISTU_ISRASASid_VAISTU_ISRASAS ='{$val['id_VAISTU_ISRASAS']}' ";
                    $receptas = mysqli_fetch_array($database->query($query));
                    echo "<tr><td>{$vaistas['pavadinimas']}</td>"
                            ."<td>{$vaistas['kiekis_mg']}</td>"
                            ."<td>{$vaistas['vartojimo_instrukcija']}</td>"
                            ."<td>{$val['israsymo_data']}</td>"
                            ."<td>{$receptas['galioja_iki']}</td></tr>";
                }
            }
            // Nereceptinis - 0, Receptinis - 1
       ?>
        </tbody>
    </table>
</body>
</html>