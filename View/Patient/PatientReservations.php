
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
            include("../../session.php");
            if (isset($_GET['laikas1']) && isset($_GET['laikas2']))
            {
                if (strtotime($_GET['laikas1']) && strtotime($_GET['laikas2']) && strtotime($_GET['laikas1']) <= strtotime($_GET['laikas2'])){
                    $query = "SELECT * FROM ". TBL_REZERVACIJA ." WHERE fk_PACIENTASid_VARTOTOJAS = '{$_GET['id']}' AND " . TBL_REZERVACIJA.".data BETWEEN '{$_GET['laikas1']}' AND '{$_GET['laikas2']}'";
                    $_SESSION['success'] = true;
                    $_SESSION['message'] = "Operacija sėkminga. Rodomi laikai tarp: " . $_GET['laikas1'] . " ir " . $_GET['laikas2'] . ".";
                }
                else{
                    $_SESSION['success'] = false;
                    $_SESSION['message'] = "Blogai įvesti laikai. Atvaizdavymui nenaudojami filtrai";
                    $query = "SELECT * FROM ".TBL_REZERVACIJA." WHERE fk_PACIENTASid_VARTOTOJAS='{$_GET['id']}'"; 
                }
            }
            else if (isset($_GET['filtras']))
            {
                if ($_GET['filtras'] == 1 )
                {
                    $_SESSION['success'] = true;
                    $_SESSION['message'] = "Rodomi praėją vizitai";
                    $query = "SELECT * FROM ". TBL_REZERVACIJA ." WHERE fk_PACIENTASid_VARTOTOJAS = '{$_GET['id']}' AND " . TBL_REZERVACIJA.".data < CURDATE()";
                }
                else if ($_GET['filtras'] == 2)
                {
                    $_SESSION['success'] = true;
                    $_SESSION['message'] = "Rodomi ateinantys vizitai";
                    $query = "SELECT * FROM ". TBL_REZERVACIJA ." WHERE fk_PACIENTASid_VARTOTOJAS = '{$_GET['id']}' AND " . TBL_REZERVACIJA.".data >= CURDATE()";
                }
                else
                {
                    $query = "SELECT * FROM ".TBL_REZERVACIJA." WHERE fk_PACIENTASid_VARTOTOJAS='{$_GET['id']}'"; 
                    $_SESSION['success'] = false;
                    $_SESSION['message'] = "Nerastas filtras";
                } 
            }
            else
            {
                $query = "SELECT * FROM ".TBL_REZERVACIJA." WHERE fk_PACIENTASid_VARTOTOJAS='{$_GET['id']}'"; 
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
        <table class="table table-light table-bordered table-hover" style="width: 60%; margin: 0 auto; text-align: center">
            <tr>
            <td>
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
            </td> 
            <td valign='top'>
                <form method='GET' action='PatientReservations.php?'>
                    <?php
                        echo "<input type='hidden' name='id' value='{$_GET['id']}'>";
                    ?>
                    <br>
                    <select name="filtras" class="form-control">
                        <option name=filtras1 value='1'>Rodyti praėjusias rezervacijas</option>";
                        <option name=filtras2 value='2'>Rodyti ateinančias rezervacijas</option>";
                    </select>
                    <br>
                    <input class='btn btn-outline-dark' type='submit' value='Filtruoti'>
                </form>
            </td>
            </tr>
        </table>
    <br>

    <table class="table table-light table-bordered table-hover" style="width: 80%; margin: 0 auto; text-align: center">
        <thead class="thead-dark">
            <th>Gydytojas</th>
            <th>Laikas</th>
           <!-- <th>Kabinetas</th> -->
            <th>Rezervacijos atšaukimas</th>
        </thead>
        <tbody>
        <?php
            global $database;

            //$query = $query = "SELECT * FROM ".TBL_REZERVACIJA." WHERE fk_PACIENTASid_VARTOTOJAS='{$_GET['id']}'"; 
            $rezervacijos = $database->query($query);
            foreach($rezervacijos as $key => $val ){
                $query = "SELECT vardas, pavarde FROM " . TBL_VARTOTOJAS . " where id_VARTOTOJAS='{$val['fk_SEIMOS_GYDYTOJASid_SEIMOS_GYDYTOJAS']}'";
                $result2 = $database->query($query);
                $secondary = mysqli_fetch_assoc($result2);
                echo "<form action='../../Controller/PatientController.php' method='POST'>";
                echo "<input type='hidden' name='reservacijos_id' value='{$val['id_REZERVACIJA']}'>";
                echo "<input type='hidden' name='id' value='{$_GET['id']}'>";
                echo "<tr>";
                echo "<td>{$secondary['vardas']} {$secondary['pavarde']}</td><td>{$val['data']}</td>"; //<td>{$val['vieta']}</td>";
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