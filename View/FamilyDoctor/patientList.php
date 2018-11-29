<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Šeimos gydytojo pacientai</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../Styles/styles.css">
  </head>
  <body>

    <br>
    <nav class="navbar fixed-top navbar-light navbar-expand-lg mt-0" style="background: #fff">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="btn btn-outline-dark" href=\unDzifted>Atgal</a>
            </li>
        </div>
    </nav>
    <br> 
    <br>

    <table class="table table-light table-bordered table-hover" style="width: 90%; margin: 0 auto; text-align: center">
        <thead class="thead-dark">
            <th>Vardas</th>
            <th>Pavardė</th>
            <th>Asmens kodas</th>
            <th>Gimimo data</th>
            <th>Siuntimo išrašymas</th>
            <th>Vaistų priskyrimas</th>
            <th>Biuletenio išrašymas</th>
            <th>Ligų istorija</th>
            <th>Tyrimų ataskaita</th>
        </thead>
        <tbody>
            <tr>
                <td>test</td>
                <td>test</td>
                <td>test</td>
                <td>test</td>
                <form action="patientConsultation.php">
                  <td><input class="btn btn-link" type="submit" value="Išrašyti siuntimą" name="siuntimas"></td>
                </form>
                <form action="">
                  <td><input class="btn btn-link" type="submit" value="Priskirti vaistus" name="vaistas"></td>
                </form>
                <form action="">
                  <td><input class="btn btn-link" type="submit" value="Išrašyti biuletenį" name="biuletenis"></td>
                </form>
                <form action="">
                  <td><input class="btn btn-link" type="submit" value="Nauja liga" name="liga"></td>
                </form>
                <form action="">
                  <td><input class="btn btn-link" type="submit" value="Peržiūrėti tyrimus" name="tyrimas"></td>
                </form>
                
            </tr>
        </tbody>
    </table>

</body>
</html