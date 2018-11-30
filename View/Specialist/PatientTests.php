<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Paciento tyrimai</title>
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
				echo "<a class='nav-link' href='AddPatientTest.php'>Pridėti tyrimą</a>";
            ?>
            </li>
        </div>
    </nav>
    <br>
    <br>

    <table class="table table-light table-bordered table-hover" style="width: 80%; margin: 0 auto; text-align: center">
        <thead class="thead-dark">
            <th style="width: 25%;">Tyrimo data</th>
            <th style="width: 25%;">Aprašymas</th>
            <th style="width: 25%;">Išvados</th>
            <th>Siuntimas šeimos gydytojui</th>
        </thead>
        <tbody>
            <tr>
                <td>test</td>
                <td>test</td>
                <td>test</td>
                <form action="SendPatientTestToFamilyDoctor.php">
                  <td><input class="btn btn-link" type="submit" value="Siųsti šeimos gydytojui" name="tyrimas"></td>
                </form>
            </tr>
        </tbody>
    </table>
</body>
</html>