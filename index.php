<?php
include("session.php");
?>
<html>
    <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Projektas</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="Styles/styles.css">
    </head>
    <body>

        <?php
            if (isset($_SESSION['prisijunges']))
            {
                include("View/meniu.php");

                if ($session->isAdmin()){
                    echo "adminas";
                }
                if ($session->isPatient()){
                    echo "pacientas";
                }
                if ($session->isFamilyDoctor()){
                    echo "seimos daktaras";
                }
                if ($session->isDoctorSpecialist()){
                    echo "daktaras spec";
                }

                var_dump($_SESSION);
            }
            else 
            {
                if ($form->num_errors > 0)
                {
                    echo "<font size=\"3\" color=\"#ff0000\">Klaidų: " . $form->num_errors . "</font>";
                }
                include("View/User/login.php");
            }
        ?>
    </body>
</html>
