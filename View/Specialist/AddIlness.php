<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Naujas ligos aprašas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../Styles/styles.css">
  </head>
  <body>

    <br>
    <nav class="navbar fixed-top navbar-light navbar-expand-lg mt-0" style="background: #fff">
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="btn btn-outline-dark" href=PatientIlnesses.php>Atgal</a>
            </li>
        </div>
    </nav>
    <br> 
    <br>
    <div class="form-group login">
        <form method='post'>
            <center><b>Ligos aprašas</b></center><br>
            <div style="text-align: left;">
                <label for="pacientas">Pacientas:</label>
                <input name='pacientas' type='text' class="form-control" readonly>
            </div style="text-align: left;">
            <br>
            <div style="text-align: left;">
                <label for="liga">Liga:</label>
                <select name="liga" class="form-control">
                    <option value="Liga1">1-a liga</option>
                    <option value="Liga2">2-a liga</option>
                </select>
            </div>
            <br>
            <div style="text-align: left;">
                <label for="data">Ligos nustatymo data:</label>
                <input name='data' type='date' class="form-control" oninvalid="this.setCustomValidity('Neužpildyta ligos nustatymo liga')" oninput="this.setCustomValidity('')" required>
            </div style="text-align: left;">
            <br>
            <div style="text-align: left;">
                <label for="diagnozes_kodas">Diagnozės kodas:</label>
                <input name='diagnozes_kodas' type='text' class="form-control" oninvalid="this.setCustomValidity('Neužpildytas diagnozės kodas')" oninput="this.setCustomValidity('')" required>
            </div style="text-align: left;">
            <br>
            <div style="text-align: left;">
                <label for="aprasymas">Aprašymas:</label>
                <textarea class="form-control" rows="3" name="aprasymas" oninvalid="this.setCustomValidity('Neužpildytas ligos aprašymas')" oninput="this.setCustomValidity('')" required></textarea>
            </div style="text-align: left;">
            <br>
            <div style="text-align: left;">
                <label for="isvada"">Išvados:</label>
                <textarea class="form-control" rows="3" name="isvada" oninvalid="this.setCustomValidity('Neužpildytos ligos išvados')" oninput="this.setCustomValidity('')" required></textarea>
            </div style="text-align: left;">
            <br>
            <input class="btn btn-outline-dark" type="submit" value="Pridėti ligos aprašą">
        </form>
    </div>
</body>
</html>
