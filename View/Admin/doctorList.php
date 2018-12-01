<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Gydytojų sąrašas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../Styles/styles.css">
  </head>
  <body>
  <?php 
    include '../../session.php';
    global $database;
    $result = $database->GetAllDoctors($_SESSION['id']);
    $index = 0;
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
            <th>Licencijos galiojimas</th>
            <th>Specialybe</th>
            <th>Redagavimas</th>
            <th>Pašalinimas</th>
            <th>Alga</th>
            <th>Grafikas</th>
            <th>Statistika</th>
        </thead>
        <tbody>
        <?php
         while($row = mysqli_fetch_array($result)){
        ?>
        
            <tr>
                <td><?php echo $row['vardas'];?></td>
                <td><?php echo $row['pavarde'];?></td>
                <td><?php echo $row['asmens_kodas'];?></td>
                <td><?php echo $row['licencija_iki'];?></td>
                <td><?php
                    if ($row['typeSelector'] == FAMILY_DOCTOR_NAME)
                        {
                            echo "Šeimos gydytojas";
                        }
                    else
                        {
                          echo "Specialistas";
                        }
        ?></td>
                <td>
                <?php
                  echo "<a class='btn btn-link' href='DoctorEdit.php?id={$row['id_VARTOTOJAS']}'>Redaguoti</a>";
                  /* echo "<a class='btn btn-link' href='addPatientConsultation.php?id={$row['id_VARTOTOJAS']}'>Siuntimų sąrašas</a>";*/
//getSpecialisation
?>
                </td>
                <td>
                <?php
                  echo "<a class='btn btn-link' href='DoctorRemove.php?id={$row['id_VARTOTOJAS']}'>Pašalinti</a>";
                  /* echo "<a class='btn btn-link' href='addPatientConsultation.php?id={$row['id_VARTOTOJAS']}'>Siuntimų sąrašas</a>";*/
                ?>
                </td>
                <td>
                <?php
                  echo "<a class='btn btn-link' href='DoctorSalary.php?id={$row['id_VARTOTOJAS']}'>Alga</a>";
                  /* echo "<a class='btn btn-link' href='addPatientConsultation.php?id={$row['id_VARTOTOJAS']}'>Siuntimų sąrašas</a>";*/
                ?>
                </td>
                <td>
                <?php
                  echo "<a class='btn btn-link' href='DoctorSchedule.php?id={$row['id_VARTOTOJAS']}'>Grafikas</a>";
                  /* echo "<a class='btn btn-link' href='addPatientConsultation.php?id={$row['id_VARTOTOJAS']}'>Siuntimų sąrašas</a>";*/
                ?>
                </td>
                <td>
                <?php
                  echo "<a class='btn btn-link' href='DoctorStatistics.php?id={$row['id_VARTOTOJAS']}'>Statistika</a>";
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