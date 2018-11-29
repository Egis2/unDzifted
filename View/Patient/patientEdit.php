<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Paciento informacijos redagavimas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../Styles/styles.css">
  </head>
  <body>

    <br>
    <nav class="navbar fixed-top navbar-light navbar-expand-lg mt-0" style="background: #fff">
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="btn btn-outline-dark" href=PatientInfo.php>Atgal</a>
            </li>
        </div>
    </nav>
    <br> 
    <br>
    <div class="form-group login">
        <form method='post'>
            <center><b>Paciento informacijos redagavimas</b></center><br>
            <div style="text-align: left;">
                <label for="vardas">Paciento vardas:</label>
                <input name='vardas' type='text' class="form-control">
            </div>
            <br>
            <div style="text-align: left;">
                <label for="pavarde">Paciento pavardė:</label>
                <input name='pavarde' type='text' class="form-control">
            </div style="text-align: left;">
            <br>
            <div style="text-align: left;">
                <label for="asmens_kodas">Paciento asmens kodas:</label>
                <input name='asmens_kodas' type='text' class="form-control">
            </div style="text-align: left;">
            <br>
            <div style="text-align: left;">
                <label for="el_pastas">Paciento el. paštas:</label>
                <input name='el_pastas' type='email' class="form-control">
            </div style="text-align: left;">
            <br>
            <div style="text-align: left;">
                <label for="slaptazodis">Paciento slaptažodis:</label>
                <input name='slaptazodis' type='password' class="form-control">
            </div style="text-align: left;">
            <br>
            <div style="text-align: left;">
                <label for="telefonas">Paciento telefono numeris:</label>
                <input name='telefonas' type='text' class="form-control">
            </div style="text-align: left;">
            <br>
            <div style="text-align: left;">
                <label for="gimimo_data">Paciento gimimo data:</label>
                <input name='gimimo_data' type='date' class="form-control">
            </div style="text-align: left;">
            <br>
            <div style="text-align: left;">
                <label for="adresas">Paciento telefono numeris:</label>
                <input name='adresas' type='text' class="form-control">
            </div>
            <br>
            <input class="btn btn-outline-dark" type="submit" value="Užbaigti redagavimą">
        </form>
    </div>
</body>
</html>
