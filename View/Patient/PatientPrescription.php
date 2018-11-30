
  <?php    include ("../../session.php"); ?>
<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Paciento receptų istorija</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../Styles/styles.css">
  </head>
  <body>
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
    <br>
    <?php 
        if (isset($_GET['laikas1']) && isset($_GET['laikas2']))
        {
            if (strtotime($_GET['laikas1']) && strtotime($_GET['laikas2']) && strtotime($_GET['laikas1']) <= strtotime($_GET['laikas2'])){
                $query = "SELECT * FROM ". TBL_VAISTU_ISRASAS ." WHERE fk_PACIENTASid_VARTOTOJAS = '{$_GET['id']}' AND " . TBL_VAISTU_ISRASAS.".israsymo_data BETWEEN '{$_GET['laikas1']}' AND '{$_GET['laikas2']}'";// AND ".TBL_VAISTU_ISRASAS .".israsymo_data <= '{$_GET['laikas2']}'";
                $_SESSION['success'] = true;
                $_SESSION['message'] = "Operacija sėkminga. Rodomi laikai tarp: " . $_GET['laikas1'] . " ir " . $_GET['laikas2'] . ".";
            }
            else{
                $_SESSION['success'] = false;
                $_SESSION['message'] = "Blogai įvesti laikai. Atvaizdavymui nenaudojami filtrai";
                $query = "SELECT * FROM ". TBL_VAISTU_ISRASAS ." WHERE fk_PACIENTASid_VARTOTOJAS = '{$_GET['id']}'";
            }
        }
        else
        {
            $query = "SELECT * FROM ". TBL_VAISTU_ISRASAS ." WHERE fk_PACIENTASid_VARTOTOJAS = '{$_GET['id']}'";
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
        <form method='GET' action='PatientPrescription.php?'>
            <?php
            echo "<input type='hidden' name='id' value='{$_GET['id']}'>";
            ?>
            <div style="text-align: left;">
                <label for="vardas">Receptų istorija nuo:</label>
                <input name='laikas1' type='date' class='form-control' value='' oninvalid="this.setCustomValidity('Nepasirinkta pradžios data')" oninput="this.setCustomValidity('')" required>
            </div>
            <br>
            <div style="text-align: left;">
                <label for="vardas">Receptų istorija iki:</label>
                <input name='laikas2' type='date' class='form-control' value='' oninvalid="this.setCustomValidity('Nepasirinkta pabaigos data')" oninput="this.setCustomValidity('')" required>
            </div>
            <br>
            <input class='btn btn-outline-dark' type='submit' value='Filtruoti'>
        </form>
    </div>
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
            $vaistu_israsai = $database->query($query);
            foreach($vaistu_israsai as $key => $val){
                $query = "SELECT * FROM ". TBL_VAISTAS. " WHERE id_VAISTAS = '{$val['fk_VAISTASid_VAISTAS']}' AND receptinis='1'";
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
</html