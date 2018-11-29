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
        <div class="jumbotron text-center header">
            <h1>Gydymo įstaiga</h1>
        </div>
        <?php
            if ($session->logged_in)
            {
                include("include/meniu.php");
                ?>
                <div style="text-align: center;color:purple">
                    <br><br>
                    <h1>Lažybų punktas</h1>
                    <h2>Egidijus Kutko IFF-6/12</h2>
                </div><br>
                <?php
                //Jei vartotojas neprisijungęs, rodoma prisijungimo forma
                //Jei atsiranda klaidų, rodomi pranešimai.
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
