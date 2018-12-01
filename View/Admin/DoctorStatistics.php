<?php include("../../session.php")?>
<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Gydytojo statistika</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../Styles/styles.css">
  </head>
  <body>

    <br>
    <nav class="navbar fixed-top navbar-light navbar-expand-lg mt-0" style="background: #fff">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="btn btn-outline-dark" href=doctorList.php>Atgal</a>
            </li>
        </div>
    </nav>
    <br>
    <br>
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
    <table class="table table-light table-bordered table-hover" style="width: 55%; margin: 0 auto; text-align: center;">
        <thead class="thead-dark">
            <th>Statistika</th>
            <th>Duomenys</th>
        </thead>
        <tbody>
        <?php 
                global $database;
                $query = "SELECT * FROM " . TBL_VARTOTOJAS . " WHERE id_VARTOTOJAS='{$_GET['id']}'";
                $result = $database->query($query);
                $row = $result->fetch_assoc();
                if ($row['typeSelector'] == FAMILY_DOCTOR_NAME)
                        {
                            $patientCount =  "SELECT COUNT(*) as patientCount FROM " . TBL_GYDYMAS . " WHERE fk_GYDYTOJASid_VARTOTOJAS='{$_GET['id']}'";
                            $pc = $database->query($patientCount);
                            $rowpc = $pc->fetch_assoc();
                            echo "<tr><td>Pacientų kiekis</td>"
                            ."<td>{$rowpc['patientCount']}</td></tr>";

                            $sickListCount =  "SELECT COUNT(*) as sickListCount FROM " . TBL_BIULETENIS . " WHERE fk_SEIMOS_GYDYTOJASid_SEIMOS_GYDYTOJAS='{$_GET['id']}'";
                            $slc = $database->query($sickListCount);
                            $rowslc = $slc->fetch_assoc();
                            echo "<tr><td>Išrašytų nedarbingumo lapelių kiekis</td>"
                            ."<td>{$rowslc['sickListCount']}</td></tr>";
                            
                            $minimumWage =  "SELECT TRUNCATE(MIN(alga),2) as minimumWage FROM " . TBL_ALGA . " WHERE fk_VARTOTOJASid_VARTOTOJAS='{$_GET['id']}'";
                            $mw = $database->query($minimumWage);
                            $rowmw = $mw->fetch_assoc();
                            echo "<tr><td>Mažiausias gautas atlyginimas</td>"
                            ."<td>{$rowmw['minimumWage']}</td></tr>";

                            $maximumWage =  "SELECT TRUNCATE(MAX(alga),2) as maximumWage FROM " . TBL_ALGA . " WHERE fk_VARTOTOJASid_VARTOTOJAS='{$_GET['id']}'";
                            $maw = $database->query($maximumWage);
                            $rowmaw = $maw->fetch_assoc();
                            echo "<tr><td>Didžiausias gautas atlyginimas</td>"
                            ."<td>{$rowmaw['maximumWage']}</td></tr>";

                            $averageWage =  "SELECT TRUNCATE(AVG(alga),2) as averageWage FROM " . TBL_ALGA . " WHERE fk_VARTOTOJASid_VARTOTOJAS='{$_GET['id']}'";
                            $aw = $database->query($averageWage);
                            $rowaw = $aw->fetch_assoc();
                            echo "<tr><td>Vidutinis atlyginimas</td>"
                            ."<td>{$rowaw['averageWage']}</td></tr>";
                        }
                    else
                        {
                            $patientCount =  "SELECT COUNT(*) as patientCount FROM " . TBL_SIUNTIMAS . " WHERE fk_SPECIALISTASid_SPECIALISTAS='{$_GET['id']}'";
                            $pc = $database->query($patientCount);
                            $rowpc = $pc->fetch_assoc();
                            echo "<tr><td>Pacientų kiekis</td>"
                            ."<td>{$rowpc['patientCount']}</td></tr>";

                            $testsCount =  "SELECT COUNT(*) as testsCount FROM " . TBL_TYRIMAS . " WHERE fk_SPECIALISTASid_SPECIALISTAS='{$_GET['id']}'";
                            $tc = $database->query($testsCount);
                            $rowtc = $tc->fetch_assoc();
                            echo "<tr><td>Atliko tyrimų</td>"
                            ."<td>{$rowtc['testsCount']}</td></tr>";

                            $proceduresCount =  "SELECT COUNT(*) as proceduresCount FROM " . TBL_PROCEDURA . " WHERE fk_SPECIALISTASid_SPECIALISTAS='{$_GET['id']}'";
                            $proc = $database->query($proceduresCount);
                            $rowproc = $proc->fetch_assoc();
                            echo "<tr><td>Paskyrė procedūrų</td>"
                            ."<td>{$rowproc['proceduresCount']}</td></tr>";

                            $minimumWage =  "SELECT TRUNCATE(MIN(alga),2) as minimumWage FROM " . TBL_ALGA . " WHERE fk_VARTOTOJASid_VARTOTOJAS='{$_GET['id']}'";
                            $mw = $database->query($minimumWage);
                            $rowmw = $mw->fetch_assoc();
                            echo "<tr><td>Mažiausias gautas atlyginimas</td>"
                            ."<td>{$rowmw['minimumWage']}</td></tr>";

                            $maximumWage =  "SELECT TRUNCATE(MAX(alga),2) as maximumWage FROM " . TBL_ALGA . " WHERE fk_VARTOTOJASid_VARTOTOJAS='{$_GET['id']}'";
                            $maw = $database->query($maximumWage);
                            $rowmaw = $maw->fetch_assoc();
                            echo "<tr><td>Didžiausias gautas atlyginimas</td>"
                            ."<td>{$rowmaw['maximumWage']}</td></tr>";

                            $averageWage =  "SELECT TRUNCATE(AVG(alga),2) as averageWage FROM " . TBL_ALGA . " WHERE fk_VARTOTOJASid_VARTOTOJAS='{$_GET['id']}'";
                            $aw = $database->query($averageWage);
                            $rowaw = $aw->fetch_assoc();
                            echo "<tr><td>Vidutinis atlyginimas</td>"
                            ."<td>{$rowaw['averageWage']}</td></tr>";
                        }

                    
            ?>
        </tbody>
    </table>
</body>
</html>