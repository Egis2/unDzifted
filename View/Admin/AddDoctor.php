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
        <form method='POST' action='../../Controller/AdminController.php'>
            <center><b>Gydytojo pridėjimas</b></center><br>
            <div style="text-align: left;">
                <label for="vardas">Gydytojo vardas:</label>
                <input name='vardas' type='text' class="form-control" oninvalid="this.setCustomValidity('Neužpildytas gydytojo vardas')" oninput="this.setCustomValidity('')" required>
            </div>
            <br>
            <div style="text-align: left;">
                <label for="pavarde">Gydytojo pavardė:</label>
                <input name='pavarde' type='text' class="form-control" oninvalid="this.setCustomValidity('Neužpildyta gydytojo pavardė')" oninput="this.setCustomValidity('')" required>
            </div>
            <br>
            <div style="text-align: left;">
                <label for="asmens_kodas">Asmens kodas:</label>
                <input name='asmens_kodas' type='number' class="form-control" oninvalid="this.setCustomValidity('Neužpildytas gydytojo asmens kodas')" oninput="this.setCustomValidity('')" required>
            </div>
            <br>
            <div style="text-align: left;">
                <label for="el_pastas">El. paštas:</label>
                <input name='el_pastas' type='email' class="form-control" oninvalid="this.setCustomValidity('Neužpildytas gydytojo el.paštas')" oninput="this.setCustomValidity('')" required>
            </div>
            <br>
            <div style="text-align: left;">
                <label for="slaptazodis">Slaptažodis:</label>
                <input name='slaptazodis' type='password' class="form-control" oninvalid="this.setCustomValidity('Neužpildytas gydytojo slaptažodis')" oninput="this.setCustomValidity('')" required>
            </div>
            <br>
            <div style="text-align: left;">
                <label for="telefonas">Telefono numeris:</label>
                <input name='telefonas' type='text' class="form-control" oninvalid="this.setCustomValidity('Neužpildytas gydytojo telefono numeris')" oninput="this.setCustomValidity('')" required>
            </div>
            <br>
            <div style="text-align: left;">
                <label for="gimimo_data">Gimimo data:</label>
                <input name='gimimo_data' type='date' class="form-control" oninvalid="this.setCustomValidity('Nepasirinkta gydytojo gimimo data')" oninput="this.setCustomValidity('')" required>
            </div>
            <br>
            <div style="text-align: left;">
                <label for="licencija_iki">Licencija galioja iki:</label>
                <input name='licencija_iki' type='date' class="form-control" oninvalid="this.setCustomValidity('Nepasirinkta gydytojo licencijos galiojimo pabaigos data')" oninput="this.setCustomValidity('')" required>
            </div>
            <br>
            <div style="text-align: left;">
                <label for="specialybe">Gydyto specializacija:</label>
                <select class="form-control" name='specializacija'>
                    <option value="Seimos_gydytojas">Šeimos gydytojas</option>
                    <option value="Chirurgas">Chirurgas</option>
                    <option value="Oftalmologas">Oftalmologas</option>
                    <option value="Odontologas">Odontologas</option>
                    <option value="Pulmonologas">Pulmonologas</option>
                </select>
            </div>
            <br>
            <input class="btn btn-outline-dark" type="submit" name='addDoctor' value="Pridėti gydytoją">
        </form>
    </div>
</body>
</html>
