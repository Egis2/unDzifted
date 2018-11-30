<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Paciento nedarbingumas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../Styles/styles.css">
  </head>
  <body>

<?php 
    include '../../database.php';
    global $database;
    $result = $database->getId($_GET['id']);
    $index = 0;
    $sicklist = $database->getSickList($_GET['id']);

    while($row = mysqli_fetch_array($result)){
        $id = $row['id_VARTOTOJAS'];
    }
?>
  
    <br>
    <nav class="navbar fixed-top navbar-light navbar-expand-lg mt-0" style="background: #fff">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="btn btn-outline-dark" href=PatientList.php>Atgal</a>
            </li>
            <li>
			<?php
				echo "<a class='nav-link' href='addPatientSickList.php?id={$id}'>Išrašyti nedarbingumo lapelį</a>";
            ?>
            </li>
        </div>
    </nav>
    <br>
    <br>

    <table class="table table-light table-bordered table-hover" style="width: 80%; margin: 0 auto; text-align: center">
        <thead class="thead-dark">
            <th>Pradžios data</th>
            <th>Pabaigos data</th>
            <th>Priežastis</th>
            <th>Diagnozės kodas</th>
        </thead>
        <tbody>

         <?php
        
        while($row = mysqli_fetch_array($sicklist)){
       ?>
           <tr>
               <td><?php echo $row['data_pradzios'];?></td>
               <td><?php echo $row['data_pabaigos'];?></td>
               <td><?php echo $row['priezastis'];?></td>
               <td><?php echo $row['diagnozes_kodas'];?></td>
           </tr>
        <?php }
           ?>
        </tbody>
    </table>
</body>
</html>