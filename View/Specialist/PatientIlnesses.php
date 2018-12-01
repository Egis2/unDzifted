<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Paciento ligų aprašai</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../Styles/styles.css">
  </head>
  <body>

<?php 
    include '../../database.php';
    global $database;
    $result = $database->getId($_GET['id']);
    $index = 0;
    $consultations = $database->getConsultations($_GET['id']);

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
				echo "<a class='nav-link' href='AddIlness.php?id={$id}'>Pridėti naują ligos aprašą</a>";
            ?>
            </li>
        </div>
    </nav>
    <br>
    <br>

    <table class="table table-light table-bordered table-hover" style="width: 80%; margin: 0 auto; text-align: center">
        <thead class="thead-dark">
            <th style="width: 12%">Ligos kodas</th>
            <th style="width: 12%">Diagnozės kodas</th>
            <th style="width: 12%">Data</th>
            <th style="width: 22%">Aprašymas</th>
            <th style="width: 22%">Išvados</th>
        </thead>
        <tbody>
        <?php 
            global $database;
            $query = "SELECT * FROM " . TBL_PACIENTO_LIGOS . " WHERE fk_PACIENTASid_VARTOTOJAS='{$_GET['id']}'";
            $paciento_ligos = $database->query($query);
            foreach ($paciento_ligos as $key => $val){
                /* Paima liga */
                $query = "SELECT * FROM " . TBL_LIGA . " WHERE id_LIGA = '{$val['fk_LIGAid_LIGA']}'";
                $liga = mysqli_fetch_array($database->query($query));

                /* Jeigu laikų laukai buvo įvesti */
                if (isset($_GET['laikas1']) && isset($_GET['laikas2']))
                    $query = "SELECT * FROM " . TBL_LIGOS_APRASAS ." WHERE fk_PACIENTO_LIGOSid_PACIENTO_LIGOS = '{$val['id_PACIENTO_LIGOS']}' AND " . TBL_LIGOS_APRASAS.".data BETWEEN '{$_GET['laikas1']}' AND '{$_GET['laikas2']}'";// AND ".TBL_VAISTU_ISRASAS .".israsymo_data <= '{$_GET['laikas2']}'";
                else
                    $query = "SELECT * FROM " . TBL_LIGOS_APRASAS ." WHERE fk_PACIENTO_LIGOSid_PACIENTO_LIGOS = '{$val['id_PACIENTO_LIGOS']}'";
                $aprasas = mysqli_fetch_array($database->query($query));

                /* Jeigu SELECT operacija buvo sėkminga */
                if (mysqli_num_rows($database->query($query)) > 0)  { 
                    /* Paimamas Daktaros vardas ir pavardė */
                    $query = "SELECT vardas, pavarde FROM " . TBL_VARTOTOJAS . " WHERE id_VARTOTOJAS = '{$aprasas['fk_GYDYTOJASid_VARTOTOJAS']}'";
                    $gydytojas = mysqli_fetch_array($database->query($query));
                   
                    echo "<tr><td>{$liga['ligos_kodas']}</td>"
                    ."<td>{$aprasas['diagnozes_kodas']}</td>"
                    ."<td>{$aprasas['data']}</td>"
                    ."<td>{$aprasas['aprasymas']}</td>"
                    ."<td>{$aprasas['isvada']}</td></tr>";
                }
            }
        ?>
        </tbody>
    </table>
</body>
</html>