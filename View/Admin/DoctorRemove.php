<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Gydytojo pridėjimas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../Styles/styles.css">
  </head>
  <body>
    
    <?php
         include '../../session.php';
        global $database;
        $query = "SELECT * FROM " . TBL_VARTOTOJAS . " WHERE id_VARTOTOJAS='{$_GET['id']}'";
        $result = $database->query($query);
        $row = $result->fetch_assoc();
    ?>
    <br>
    <nav class="navbar fixed-top navbar-light navbar-expand-lg mt-0" style="background: #fff">
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <?php
                    echo "<a class='btn btn-outline-dark' href='doctorList.php'>Atgal</a>";
                ?>
            </li>
        </div>
    </nav>
    <br> 
    <br>
    <div class="form-group login">
        <form method='post'>
            <center><b>Gydytojo pašalinimas</b></center><br>
            <div style="text-align: left;">
                <label for="vardas">Gydytojo vardas ir pavarde:</label>
                <input name='vardas' readonly type='text' class="form-control" value='<?php echo $row['vardas'], " ", $row['pavarde']; ?>' oninvalid="this.setCustomValidity('Neužpildytas gydytojo vardas')" oninput="this.setCustomValidity('')" required>
            </div>
            <br>
            <div style="text-align: left;">
                <label for="asmens_kodas">Asmens kodas:</label>
                <input name='asmens_kodas'readonly type='number' class="form-control" value='<?php echo $row['asmens_kodas']; ?>' oninvalid="this.setCustomValidity('Neužpildytas gydytojo asmens kodas')" oninput="this.setCustomValidity('')" required>
            </div>
            <br>
            <input class="btn btn-outline-dark" type="submit" value="Pašalinti gydytoją">
        </form>
    </div>
</body>
</html>
