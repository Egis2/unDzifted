<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Šeimos gydytojo pacientai</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../Styles/styles.css">
  </head>
  <body>
  <?php include '../../database.php';
    global $database;
    $result = $database->GetAllPatients($id);
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

    <table class="table table-light table-bordered table-hover" style="width: 90%; margin: 0 auto; text-align: center">
        <thead class="thead-dark">
            <th>Vardas</th>
            <th>Pavardė</th>
            <th>Asmens kodas</th>
            <th>Gimimo data</th>
            <th>Siuntimo išrašymas</th>
            <th>Receptinis vaistas</th>
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
                <td><?php echo $row['vardas'];?></td>
                <td><?php echo $row['pavarde'];?></td>
                <td><?php echo $row['asmens_kodas'];?></td>
                <td><?php echo $row['gimimo_data'];?></td>
                
                
                <form action="patientConsultation.php">
                  <td>
                  <?php
                    echo "<a class='btn btn-link' href='patientConsultation.php?id={$row['id_VARTOTOJAS']}'>Išrašyti siuntimą</a>";
                  ?>
                  </td>
                </form>
                <form action="patientPrescriptionMedicine.php">
                  <td><input class="btn btn-link" type="submit" value="Receptinis" name="receptinis"></td>
                </form>
                <form action="">
                  <td><input class="btn btn-link" type="submit" value="Nereceptinis" name="Nereceptinis"></td>
                </form>
                </form>
                <form action="../../Controller/FamilyDoctorsController.php">
                  <td><input class="btn btn-link" type="submit" value="Išrašyti biuletenį" name="biuletenis"></td>
                </form>
                <form action="../../Controller/FamilyDoctorsController.php">
                  <td><input class="btn btn-link" type="submit" value="Nauja liga" name="liga"></td>
                </form>
                <form action="../../Controller/FamilyDoctorsController.php">
                  <td><input class="btn btn-link" type="submit" value="Peržiūrėti tyrimus" name="tyrimas"></td>
                </form>
                
            </tr>
         <?php }
            ?>
        </tbody>
    </table>

</body>
</html