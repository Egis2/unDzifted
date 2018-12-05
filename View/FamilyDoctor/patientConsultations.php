<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Paciento siuntimai</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../Styles/styles.css">
  </head>
  <body>

<?php 
    include '../../session.php';
    global $database;
    $result = $database->getId($_GET['id']);
    $index = 0;
    $consultations = $database->getConsultations($_GET['id']);

    $specialistInfo;
    while($row = mysqli_fetch_array($result)){
        $id = $row['id_VARTOTOJAS'];
    }

    $specList = array();
    $getInfoAboutSpecialist = $database->getSpecialisation($_GET['id']);
                
                while($name = mysqli_fetch_array($getInfoAboutSpecialist)){
                  $specList[] = $name['spec'];
                }
            $localIndex = 0;?>
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
				echo "<a class='nav-link' href='addPatientConsultation.php?id={$id}'>Išrašyti siuntimą</a>";
            ?>
            </li>
        </div>
    </nav>
    <br><br>
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

    <table class="table table-light table-bordered table-hover" style="width: 80%; margin: 0 auto; text-align: center">
        <thead class="thead-dark">
            <th style="width: 15%;">Gydytojas specialistas</th>
            <th style="width: 25%">Specialybė</th>
            <th style="width: 25%;">Priežastis</th>
            <th style="width: 25%;">Komentaras</th>
        </thead>
        <tbody>

         <?php
        
        while($row = mysqli_fetch_array($consultations)){
       ?>
           <tr>
               <td><?php
               $localID = 0;
                $getSpecialization = $database->getInfoAboutSpecialist($specList[$localIndex]);
                while($spec = mysqli_fetch_array($getSpecialization)){
                    echo $spec['fullName'];
                    $localID = $spec['id_VARTOTOJAS'];
                }
                $localIndex++;
                ?></td>
               <td>
              <?php $rez = $specialistSpecialization = $database->specialistSpecialization($localID);
              while($specNotName = mysqli_fetch_array($rez)){
                echo $specNotName['specialybe'];
            }
              
              
              ?>
               
                </td>
               <td><?php echo $row['priezastis'];?></td>
               <td><?php echo $row['komentaras'];?></td>
               
           </tr>
        <?php }
           ?>
        </tbody>
    </table>
</body>
</html>