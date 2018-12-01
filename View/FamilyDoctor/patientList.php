<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Šeimos gydytojo pacientai</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../Styles/styles.css">
  </head>
  <body>
  <?php 
    include '../../session.php';
    global $database;
    $result = $database->GetAllPatients($_SESSION['id']);
    $id = $_GET['id'];
  ?>
    <br>
    <nav class="navbar fixed-top navbar-light navbar-expand-lg mt-0" style="background: #fff">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="btn btn-outline-dark" href=\unDzifted>Atgal</a>
            </li>
        </div>
    </nav>
    <br>
    <br>

    <table class="table table-light table-bordered table-hover" style="width: 95%; margin: 0 auto; text-align: center">
        <thead class="thead-dark">
            <th style="width: 8%;">Vardas</th>
            <th style="width: 8%;">Pavardė</th>
            <th>Asmens kodas</th>
            <th>Gimimo data</th>
            <th>Siuntimo išrašymas</th>
            <th style="width: 8%;">Receptinis vaistas</th>
            <th>Nereceptinis vaistas</th>
            <th>Biuletenio išrašymas</th>
            <th>Ligų istorija</th>
            <th>Tyrimų ataskaita</th>
        </thead>
        <tbody>
        <?php
         while($row = mysqli_fetch_array($result)){
        ?>
       
            <tr>
                <td><?php echo $row[1];?></td>
                <td><?php echo $row[2];?></td>
                <td><?php echo $row[3];?></td>
                <td><?php echo $row[4];?></td>
                <td>
                <?php
                  echo "<a class='btn btn-link' href='patientConsultations.php?id={$row['id_VARTOTOJAS']}'>Siuntimų sąrašas</a>";
                  /* echo "<a class='btn btn-link' href='addPatientConsultation.php?id={$row['id_VARTOTOJAS']}'>Siuntimų sąrašas</a>";*/
                ?>
                </td>
                <td>
                <?php
                  echo "<a class='btn btn-link' href='patientPrescriptionMedicines.php?id={$row['id_VARTOTOJAS']}'>Receptinių vaistų sąrašas</a>";
                  /* echo "<a class='btn btn-link' href='addPatientConsultation.php?id={$row['id_VARTOTOJAS']}'>Siuntimų sąrašas</a>";*/
                ?>
                </td>
                <td>
                <?php
                  echo "<a class='btn btn-link' href='patientMedicines.php?id={$row['id_VARTOTOJAS']}'>Nereceptinių vaistų sąrašas</a>";
                  /* echo "<a class='btn btn-link' href='addPatientConsultation.php?id={$row['id_VARTOTOJAS']}'>Siuntimų sąrašas</a>";*/
                ?>
                </td>
                <td>
                <?php
                  echo "<a class='btn btn-link' href='patientSickList.php?id={$row['id_VARTOTOJAS']}'>Biuletenių sąrašas</a>";
                  /* echo "<a class='btn btn-link' href='addPatientConsultation.php?id={$row['id_VARTOTOJAS']}'>Siuntimų sąrašas</a>";*/
                ?>
                </td>
                <td>
                <?php
                  echo "<a class='btn btn-link' href='patientIlnesses.php?id={$row['id_VARTOTOJAS']}'>Ligų aprašai</a>";
                  /* echo "<a class='btn btn-link' href='addPatientConsultation.php?id={$row['id_VARTOTOJAS']}'>Siuntimų sąrašas</a>";*/
                ?>
                </td>
                <td>
                <?php
                  echo "<a class='btn btn-link' href='patientTests.php?id={$row['id_VARTOTOJAS']}'>Tyrimų sąrašas</a>";
                  /* echo "<a class='btn btn-link' href='addPatientConsultation.php?id={$row['id_VARTOTOJAS']}'>Siuntimų sąrašas</a>";*/
                ?>
                </td>
            </tr>
         <?php }
            ?>
        </tbody>
    </table>

</body>
</html