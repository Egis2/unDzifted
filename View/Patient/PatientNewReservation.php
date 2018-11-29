<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Registracija pas gydytoją</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../Styles/styles.css">
  </head>
  <body>

    <br>
    <nav class="navbar fixed-top navbar-light navbar-expand-lg mt-0" style="background: #fff">
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="btn btn-outline-dark" href=PatientReservations.php>Atgal</a>
            </li>
        </div>
    </nav>
    <br> 
    <br>
    <div class="form-group login">
        <form method='post'>
            <center><b>Registracija pas gydytoją</b></center><br>
            <div style="text-align: left;">
                <label for="vardas">Pasirinkti laiką:</label>
                <select name="pavarde" class="form-control">
                    <option value="Laikas1">1-as laisvas laikas</option>
                    <option value="Laikas2">2-as laisvas laikas</option>
                </select>
            </div>
            <br>
            <div style="text-align: left;">
                <label for="pavarde">Kabinetas:</label>
                <input name='pavarde' type='text' class="form-control" readonly>
            </div style="text-align: left;">
            <br>
            <input class="btn btn-outline-dark" type="submit" value="Registruotis pas gydytoją">
        </form>
    </div>
</body>
</html>
