<html>
  <head>  
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"> 
    <title>Registracija</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../Styles/styles.css">
  </head>
 
    <div class="jumbotron text-center header">
        <h1>Gydymo įstaiga</h1>
    </div>
    <div class="form-group login">
        <form method="POST" action="../../Controller/UserController.php">              
            <center><b>Registracija</b></center>
		        <p style="text-align: left;">Vardas:<br>
                    <input class="form-control" name="vardas" type="text" value=""><br>
                </p>
                <p style="text-align: left;">Pavardė:<br>
                    <input class="form-control" name="pavarde" type="text" value=""><br>
                </p>
                <p style="text-align: left;">Asmens kodas:<br>
                    <input class="form-control" name="asmens_kodas" type="text" value=""><br>
                </p>
                <p style="text-align: left;">E-paštas:<br>
                    <input class="form-control" name="el_pastas" type="email" value=""><br>
                </p> 
                <p style="text-align: left;">Slaptažodis:<br>
                    <input class="form-control" name="slaptazodis" type="password" value=""><br>
                </p>   
		        <p style="text-align: left;">Telefonas:<br>
                    <input class="form-control" name="telefonas" type="text" value=""><br>
                </p>  
                <p>
                <input class="btn btn-outline-dark" type="submit" value="Registruotis">
                <input class="btn btn-outline-dark" type="hidden" name="register" value="2"/>
                </p>
            </form>

            <table>
                <tr>
                    <td>[<a href="../../index.php">Atgal</a>]</td>
                </tr>
            </table>
    </div>
</html>