<?php    include ("../../session.php"); ?>
<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Paciento tyrimai</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../Styles/styles.css">
  </head>
  <body>

<?php 
    global $database;
    $result = $database->getId($_GET['id']);
    $isSelected = 0;

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
        </div>
    </nav>
    <br>
    <br>

    <?php 
        if (isset($_GET['laikas1']) && isset($_GET['laikas2']))
        {
            if (strtotime($_GET['laikas1']) && strtotime($_GET['laikas2']) && strtotime($_GET['laikas1']) <= strtotime($_GET['laikas2'])){
                $isSelected = 1;
                $_SESSION['success'] = true;
                $_SESSION['message'] = "Operacija sėkminga. Rodomi laikai tarp: " . $_GET['laikas1'] . " ir " . $_GET['laikas2'] . ".";
            }
            else{
                $isSelected = 0;
                $_SESSION['success'] = false;
                $_SESSION['message'] = "Blogai įvesti laikai. Atvaizdavimui nenaudojami filtrai";
                }
        }
        else
        {
            $query = "SELECT * FROM ". TBL_TYRIMAS ." WHERE fk_PACIENTASid_VARTOTOJAS = '{$_GET['id']}'";
        }

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

    <div class='form-group login'>
        <form method='GET' action='patientTests.php?'>
            <?php
            echo "<input type='hidden' name='id' value='{$_GET['id']}'>";
            ?>
            <div style="text-align: left;">
                <label for="vardas">Tyrimai nuo:</label>
                <input name='laikas1' type='date' class='form-control' value='' oninvalid="this.setCustomValidity('Nepasirinkta pradžios data')" oninput="this.setCustomValidity('')" required>
            </div>
            <br>
            <div style="text-align: left;">
                <label for="vardas">Tyrimai iki:</label>
                <input name='laikas2' type='date' class='form-control' value='' oninvalid="this.setCustomValidity('Nepasirinkta pabaigos data')" oninput="this.setCustomValidity('')" required>
            </div>
            <br>
            <input class='btn btn-outline-dark' type='submit' value='Filtruoti'>
        </form>
    </div>
    <br>

    <table class="table table-light table-bordered table-hover" style="width: 80%; margin: 0 auto; text-align: center">
        <thead class="thead-dark">
            <th style="width: 25%;">Tyrimo data</th>
            <th style="width: 25%;">Aprašymas</th>
            <th style="width: 25%;">Išvados</th>
        </thead>
        <tbody>
        <?php      
            global $database;
            if($isSelected == 0){
            $getSpecifiedTests = $database->getAllPatientsTests($_GET['id']);
            while($row = mysqli_fetch_array($getSpecifiedTests)){
                echo "<tr><td>{$row['data']}</td>"
                        ."<td>{$row['aprasymas']}</td>"
                        ."<td>{$row['isvada']}</td></tr>";
                }
            } else {
                $getSpecifiedTests = $database->getAllTestsWithSetTime($_GET['id'], $_GET['laikas1'], $_GET['laikas2']);
                while($row2 = mysqli_fetch_array($getSpecifiedTests)){
                    echo "<tr><td>{$row2['data']}</td>"
                            ."<td>{$row2['aprasymas']}</td>"
                            ."<td>{$row2['isvada']}</td></tr>";
                    }
            
            }
       ?>
        </tbody>
    </table>

    <?php 
   
   

    ?>
</body>
</html>