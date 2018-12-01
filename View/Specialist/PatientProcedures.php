<?php include("../../session.php")?>
<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Paciento gydymo procedūros</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../Styles/styles.css">
  </head>
  <body>

    <br>
    <nav class="navbar fixed-top navbar-light navbar-expand-lg mt-0" style="background: #fff">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="btn btn-outline-dark" href=PatientList.php>Atgal</a>
            </li>
            <li>
			<?php
				echo "<a class='nav-link' href='AddProcedure.php?id={$_GET['id']}'>Priskirti gydymo procedūrą</a>";
            ?>
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
    <table class="table table-light table-bordered table-hover" style="width: 75%; margin: 0 auto; text-align: center;">
        <thead class="thead-dark">
            <th>Gydymo procedūros data</th>
            <th style="width: 20%;">Vieta</th>
            <th style="width: 50%;">Aprašymas</th>
        </thead>
        <tbody>
        <?php 
                global $database;
                $query = "SELECT * FROM " . TBL_PROCEDURA . " WHERE fk_PACIENTASid_VARTOTOJAS='{$_GET['id']}'";
                $result = $database->query($query);
                foreach($result as $key => $val){
                    echo "<tr><td>{$val['data']}</td>"
                        ."<td>{$val['vieta']}</td>"
                        ."<td>{$val['aprasymas']}</td></tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>