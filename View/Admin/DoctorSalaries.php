<?php include("../../session.php")?>
<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Gydytojo algos</title>
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
            <li>
			<?php
				echo "<a class='nav-link' href='DoctorSalary.php?id={$_GET['id']}'>Nustatyti algą</a>";
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
    <table class="table table-light table-bordered table-hover" style="width: 55%; margin: 0 auto; text-align: center;">
        <thead class="thead-dark">
            <th>Alga</th>
            <th>Išmokėjimo data</th>
        </thead>
        <tbody>
        <?php 
                global $database;
                $query = "SELECT * FROM " . TBL_ALGA . " WHERE fk_VARTOTOJASid_VARTOTOJAS='{$_GET['id']}'";
                $result = $database->query($query);
                foreach($result as $key => $val){
                    echo "<tr><td>{$val['alga']} &euro; </td>"
                        ."<td>{$val['ismokejimo_data']}</td></tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>