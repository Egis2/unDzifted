<?php  include('../../session.php');?>
<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Kabinetų sąrašas</title>
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
                    echo "<a class='nav-link' href='AddCabinet.php'>Priskirti kabinetą gydytojui</a>";
                ?>
                </li>
            </ul>
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

    <table class="table table-light table-bordered table-hover" style="width: 80%; margin: 0 auto; text-align: center">
        <thead class="thead-dark">
            <th>Numeris</th>
            <th>Skyrius</th>
            <th>Įrangos aprašymas</th>
            <th>Užimta nuo</th>
            <th>Užimta iki</th>
            <th>Gydytojas</th>
        </thead>
        <tbody>
        <?php 
            global $database;
            $query = "SELECT * FROM " . TBL_KABINETAS . " ";
            $result = $database->query($query);
            foreach($result as $key => $val){
                $query = "SELECT * FROM ". TBL_VARTOTOJAS. " WHERE id_VARTOTOJAS='{$val['fk_GYDYTOJASid_VARTOTOJAS']}'";
                $rows = mysqli_num_rows($database->query($query));
                $gydytojas = mysqli_fetch_array($database->query($query));
                echo "<tr><td>{$val['numeris']}</td>"
                    ."<td>{$val['skyrius']}</td>"
                    ."<td>{$val['irangos_aprasymas']}</td>"
                    ."<td>{$val['uzimta_nuo']}</td>"
                    ."<td>{$val['uzimta_iki']}</td>"
                    ."<td>{$gydytojas['vardas']} {$gydytojas['pavarde']}</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>