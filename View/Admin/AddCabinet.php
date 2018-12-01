<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Naujo kabineto pridėjimas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../Styles/styles.css">
  </head>
  <body>

<?php
    include '../../session.php';
    global $database;
    $getDoctors = $database->getDoctors();

    $doctors = array();
    $indexofDoctors = 0;
    while($row = mysqli_fetch_array($getDoctors)){
        $doctors[]= $row;
    }
?>
    <br>
    <nav class="navbar fixed-top navbar-light navbar-expand-lg mt-0" style="background: #fff">
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <?php
                    echo "<a class='btn btn-outline-dark' href='CabinetList.php'>Atgal</a>";
                ?>
            </li>
        </div>
    </nav>
    <br> 
    <br>
    <div class="form-group login">
        <form method='POST' action='../../Controller/AdminController.php'>
            <center><b>Kabineto priskyrimas</b></center><br>
            <div style="text-align: left;">
                <label for="kabinetas">Kabineto numeris:</label>
                <input name='kabinetas' type='number' class="form-control" min='1' max='20' value='1'>
            </div style="text-align: left;">
            <br>
            <div style="text-align: left;">
                <label for="gydytojas">Gydytojas:</label>
                <?php
                echo "<select name='gydytojas' class='form-control'>";
                    foreach($doctors as $doctor)
                    {
                     //   echo "<input type='hidden name='id_daktaras' value='".$doctor[$indexofDoctors]['id_VARTOTOJAS']."'>";
                        echo "<option value='".$doctors[$indexofDoctors]['id_VARTOTOJAS']."'>".$doctors[$indexofDoctors]['gydytojas']."</option>";
                        $indexofDoctors = $indexofDoctors + 1;
                    }
                    echo "</select>";
                ?>
            </div>
            <br>
            <div style="text-align: left;">
                <label for="uzimta_nuo">Užimti kabinetą nuo:</label>
                <input name='uzimta_nuo' type='datetime-local' class="form-control" oninvalid="this.setCustomValidity('Neužplidyta kabineto užimtumo pradžios data')" oninput="this.setCustomValidity('')" required>
            </div style="text-align: left;">
            <br>
            <div style="text-align: left;">
                <label for="uzimta_iki">Užimti kabinetą iki:</label>
                <input name='uzimta_iki' type='datetime-local' class="form-control" oninvalid="this.setCustomValidity('Neužplidyta kabineto užimtumo pabaigos data')" oninput="this.setCustomValidity('')" required>
            </div style="text-align: left;">
            <br>
            <div style="text-align: left;">
                <label for="skyrius">Skyrius:</label>
                <select class="form-control" name='skyrius'>
                    <option value="seimos_gydytojas">Konsultacinis</option>
                    <option value="chirurgas">Chirurgijos</option>
                    <option value="oftalmologas">Oftalmologijos</option>
                    <option value="odontologas">Odontologijos</option>
                    <option value="pulmonologas">Pulmonologijos</option>
                </select>
            </div style="text-align: left;">
            <br>
            <div style="text-align: left;">
                <label for="irangos_aprasymas">Įrangos aprašymas:</label>
                <textarea class="form-control" rows="3" name="irangos_aprasymas" oninvalid="this.setCustomValidity('Neužpildytas reikalingos įrangos aprašymas')" oninput="this.setCustomValidity('')" required></textarea>
            </div style="text-align: left;">
            <br>
            <input class="btn btn-outline-dark" type="submit" name='assignCabinet' value="Priskirti kabinetą gydytojui">
        </form>
    </div>
</body>
</html>
