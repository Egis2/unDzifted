<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Paciento ligų aprašai</title>
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
				echo "<a class='nav-link' href='AddIlness.php'>Pridėti naują ligos aprašą</a>";
            ?>
            </li>
        </div>
    </nav>
    <br>
    <br>

    <table class="table table-light table-bordered table-hover" style="width: 80%; margin: 0 auto; text-align: center">
        <thead class="thead-dark">
            <th style="width: 12%">Ligos kodas</th>
            <th style="width: 12%">Diagnozės kodas</th>
            <th style="width: 12%">Data</th>
            <th style="width: 22%">Aprašymas</th>
            <th style="width: 22%">Išvados</th>
        </thead>
        <tbody>
            <tr>
                <td>test</td>
                <td>test</td>
                <td>test</td>
                <td>test</td>
                <td>test</td>
            </tr>
        </tbody>
    </table>
</body>
</html>