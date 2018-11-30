<?php include ("../../session.php"); ?>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Paciento Ligos</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../../Styles/styles.css">
    </head>
    
    </body>
    <nav class="navbar fixed-top navbar-light navbar-expand-lg mt-0" style="background: #fff">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="btn btn-outline-dark" href=\unDzifted>Atgal</a>
            </li>
        </div>
    </nav>
    <br><br><br>
    <?php
        if (isset($_GET['laikas1']) && isset($_GET['laikas2']))
        {
            if (strtotime($_GET['laikas1']) && strtotime($_GET['laikas2']) && strtotime($_GET['laikas1']) <= strtotime($_GET['laikas2'])){
                $_SESSION['success'] = true;
                $_SESSION['message'] = "Operacija sėkminga. Rodomi laikai tarp: " . $_GET['laikas1'] . " ir " . $_GET['laikas2'] . ".";
            }
            else{
                $_SESSION['success'] = false;
                $_SESSION['message'] = "Blogai įvesti laikai. Atvaizdavymui nenaudojami filtrai";
            }
        }
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
            <div class='form-group login'>
            <form method='GET' action='PatientIlnesses.php?'>
                <?php
                echo "<input type='hidden' name='id' value='{$_GET['id']}'>";
                ?>
                <div style="text-align: left;">
                    <label for="vardas">Ligų istorija nuo:</label>
                    <input name='laikas1' type='date' class='form-control' value='' oninvalid="this.setCustomValidity('Nepasirinkta pradžios data')" oninput="this.setCustomValidity('')" required>
                </div>
                <br>
                <div style="text-align: left;">
                    <label for="vardas">Ligų istorija iki:</label>
                    <input name='laikas2' type='date' class='form-control' value='' oninvalid="this.setCustomValidity('Nepasirinkta pabaigos data')" oninput="this.setCustomValidity('')" required>
                </div>
                <br>
                <input class='btn btn-outline-dark' type='submit' value='Filtruoti'>
            </form>
        </div>
        <br>
        <table class="table table-light table-bordered table-hover" style="width: 80%; margin: 0 auto; text-align: center">
        <thead class="thead-dark">
            <th>Ligos Pavadinimas</th>
            <th>Diagnozės kodas</th>
            <th>Ligos aprašymas</th>
            <th>Data</th>
            <th>Išvados</th>
            <th>Nustatęs gydytojas</th>
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
                if (isset($_GET['laikas1']) && isset($_GET['laikas2']) && strtotime($_GET['laikas1']) && strtotime($_GET['laikas2']) )
                    $query = "SELECT * FROM " . TBL_LIGOS_APRASAS ." WHERE fk_PACIENTO_LIGOSid_PACIENTO_LIGOS = '{$val['id_PACIENTO_LIGOS']}' AND " . TBL_LIGOS_APRASAS.".data BETWEEN '{$_GET['laikas1']}' AND '{$_GET['laikas2']}'";// AND ".TBL_VAISTU_ISRASAS .".israsymo_data <= '{$_GET['laikas2']}'";
                else
                    $query = "SELECT * FROM " . TBL_LIGOS_APRASAS ." WHERE fk_PACIENTO_LIGOSid_PACIENTO_LIGOS = '{$val['id_PACIENTO_LIGOS']}'";
                $aprasas = mysqli_fetch_array($database->query($query));

                /* Jeigu SELECT operacija buvo sėkminga */
                if (mysqli_num_rows($database->query($query)) > 0)  { 
                    /* Paimamas Daktaros vardas ir pavardė */
                    $query = "SELECT vardas, pavarde FROM " . TBL_VARTOTOJAS . " WHERE id_VARTOTOJAS = '{$aprasas['fk_GYDYTOJASid_VARTOTOJAS']}'";
                    $gydytojas = mysqli_fetch_array($database->query($query));
                   
                    echo "<tr><td>{$liga['pavadinimas']}</td>"
                    ."<td>{$aprasas['diagnozes_kodas']}</td>"
                    ."<td>{$aprasas['aprasymas']}</td>"
                    ."<td>{$aprasas['data']}</td>"
                    ."<td>{$aprasas['isvada']}</td>"
                    ."<td>{$gydytojas['vardas']} {$gydytojas['pavarde']}</td></tr>";
                }
            }
        ?>
        </tbody>
        </table>
    </body>
</html>