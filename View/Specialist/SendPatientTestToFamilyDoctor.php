<?php include("../../session.php") ?>
<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Siųsti tyrimą šeimos gydytojui</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../Styles/styles.css">
  </head>
  <body>

    <br>
    <nav class="navbar fixed-top navbar-light navbar-expand-lg mt-0" style="background: #fff">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
            <?php 
                echo "<a class=\"btn btn-outline-dark\" href='PatientTests.php?id={$_GET['id']}'>Atgal</a>";
            ?>
            </li>
        </div>
    </nav>
    <br> 
    <br>
    <?php 
        global $database;
        $result = $database->getNameAndSurname($_GET['id']);
        $nameSurname = '';
        while($row = mysqli_fetch_array($result)){
            $nameSurname= $row['fullName'];
        }
        
        $query = "SELECT * FROM " . TBL_TYRIMAS . " WHERE id_TYRIMAS='{$_GET['id_tyrimas']}'";
        $result = $database->query($query);
        $tyrimas = mysqli_fetch_array($result);
    ?>
    <div class="form-group login">
        <form method='post' action='../../Controller/SpecialistController.php'>
            <?php echo "<input type='hidden' name='id_tyrimas' value='{$_GET['id_tyrimas']}'>";
                  echo "<input type='hidden' name='id' value='{$_GET['id']}'>"; ?>
            <center><b>Siųsti tyrimo rezultatus šeimos gydytojui</b></center><br>
            <div style="text-align: left;">
                <label for="pacientas">Pacientas:</label>
                <input name='pacientas' type='text' class="form-control" readonly value='<?php echo $nameSurname; ?>'>
            </div style="text-align: left;">
            <br>
            <div style="text-align: left;">
                <label for="data">Tyrimo atlikimo data:</label>
                <?php echo "<input class=\"form-control\" type=\"date\" name=\"data\" readonly value='{$tyrimas['data']}'>"; ?>
            </div>
            <br>
            <div style="text-align: left;">
                <label for="aprasymas">Tyrimo aprašymas:</label>
                <?php echo "<textarea class=\"form-control\" rows=\"3\" name=\"aprasymas\" readonly>{$tyrimas['aprasymas']}</textarea>"; ?>
            </div style="text-align: left;">
            <br>
            <div style="text-align: left;">
                <label for="isvada">Tyrimo išvados:</label>
                <?php  echo "<textarea class=\"form-control\" rows=\"3\" name=\"isvada\" readonly>{$tyrimas['isvada']}</textarea>";  ?>
            </div style="text-align: left;">
            <br>
            <input class="btn btn-outline-dark" type="submit" name='sendToFamilyDoctor' value="Siųsti šeimos gydytojui">
        </form>
    </div>
</body>
</html