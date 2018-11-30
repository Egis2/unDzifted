
<html>
  <?php    include ("../../database.php"); ?>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Paciento receptų istorija</title>
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
        </div>
    </nav>
    <br> 
    <br>
    <?php
    echo "<div class='form-group login'>";
        echo "<form method='GET' action='PatientPrescription.php?'>";
        echo "<input type='hidden' name='id' value='{$_GET['id']}'>";
        echo "<input name='laikas1' type='date' class='form-control' value=''>";
        echo "<input name='laikas2' type='date' class='form-control' value=''>";
        echo "<input class='btn btn-outline-dark' type='submit' value='Filtruoti'></form>";
    echo "</div>";
    ?>
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
            if (isset($_GET['laikas1']) && isset($_GET['laikas2']))
            {
                if (strtotime($_GET['laikas1']) && strtotime($_GET['laikas2']) && strtotime($_GET['laikas1']) <= strtotime($_GET['laikas2'])){
                    $query = "SELECT * FROM ". TBL_VAISTU_ISRASAS ." WHERE fk_PACIENTASid_VARTOTOJAS = '{$_GET['id']}' AND " . TBL_VAISTU_ISRASAS.".israsymo_data BETWEEN '{$_GET['laikas1']}' AND '{$_GET['laikas2']}'";// AND ".TBL_VAISTU_ISRASAS .".israsymo_data <= '{$_GET['laikas2']}'";
                    //$_SESSION['success'] = true;
                    //$_SESSION['message'] = "Operacija sėkminga";
                }
                else{
                    //$_SESSION['success'] = false;
                    //$_SESSION['message'] = "Blogai įvesti laikai. Atvaizdavymui nenaudojami filtrai";
                    $query = "SELECT * FROM ". TBL_VAISTU_ISRASAS ." WHERE fk_PACIENTASid_VARTOTOJAS = '{$_GET['id']}'";
                }
            }
            else{
                $query = "SELECT * FROM ". TBL_VAISTU_ISRASAS ." WHERE fk_PACIENTASid_VARTOTOJAS = '{$_GET['id']}'";
            }
            $vaistu_israsai = $database->query($query);
            foreach($vaistu_israsai as $key => $val){
                $query = "SELECT * FROM ". TBL_VAISTAS. " WHERE id_VAISTAS = '{$val['fk_VAISTASid_VAISTAS']}'";
                $vaistas = mysqli_fetch_array($database->query($query));
                $query = "SELECT * FROM ". TBL_RECEPTAS ." WHERE fk_VAISTU_ISRASASid_VAISTU_ISRASAS ='{$val['id_VAISTU_ISRASAS']}' ";
                $receptas = mysqli_fetch_array($database->query($query));
                echo "<tr><td>{$vaistas['pavadinimas']}</td>"
                        ."<td>{$vaistas['kiekis_mg']}</td>"
                        ."<td>{$vaistas['vartojimo_instrukcija']}</td>"
                        ."<td>{$val['israsymo_data']}</td>"
                        ."<td>{$receptas['galioja_iki']}</td></tr>";
            }
            // Nereceptinis - 0, Receptinis - 1
       ?>
        </tbody>
    </table>
</body>
</html