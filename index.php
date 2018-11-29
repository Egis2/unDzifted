<?php
include("session.php");
?>
<html>
    <head>
        <title>Projektas</title>

    </head>
    <body>
        <h1>  Informaciniu sistemu projektas </h1>
        <?php
        if ($session->logged_in) {
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
            } else {
                echo "<div align=\"center\">";
                if ($form->num_errors > 0) {
                    echo "<font size=\"3\" color=\"#ff0000\">Klaidų: " . $form->num_errors . "</font>";
                }
                echo "<table class=\"center\"><tr><td>";
                include("View/User/login.php");
                echo "</td></tr></table></div><br></td></tr>";
            }
            ?>
        <h1>  Informaciniu sistemu projektas </h1>
    </body>
</html>
