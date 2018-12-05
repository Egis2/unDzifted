
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
    <?php 
       
    ?>
    <div class="form-group login">
    <?php 
         include ("../../session.php");
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
        <form method="POST" action="../../Controller/UserController.php">              
            <center><b>Registracija</b></center>
		        <p style="text-align: left;">Vardas:<br>
                    <input class="form-control" name="vardas" type="text" value="" oninvalid="this.setCustomValidity('Neįvestas vartotojo vardas')" oninput="this.setCustomValidity('')" required><br>
                </p>
                <p style="text-align: left;">Pavardė:<br>
                    <input class="form-control" name="pavarde" type="text" value="" oninvalid="this.setCustomValidity('Neįvesta vartotojo pavardė')" oninput="this.setCustomValidity('')" required><br>
                </p>
                <p style="text-align: left;">Asmens kodas:<br>
                    <input class="form-control" name="asmens_kodas" type="text" value="" oninvalid="this.setCustomValidity('Neįvestas asmens kodas')" oninput="this.setCustomValidity('')" required><br>
                </p>
                <p style="text-align: left;">E-paštas:<br>
                    <input class="form-control" name="el_pastas" type="email" value="" oninvalid="this.setCustomValidity('Neįvestas elektroninis paštas')" oninput="this.setCustomValidity('')" required><br>
                </p> 
                <p style="text-align: left;">Slaptažodis:<br>
                    <input class="form-control" name="slaptazodis" type="password" value="" oninvalid="this.setCustomValidity('Neįvestas vartotojo slaptažodis')" oninput="this.setCustomValidity('')" required><br>
                </p>   
                <p style="text-align: left;">Patvirtinti slaptažį:<br>
                    <input class="form-control" name="Confslaptazodis" type="password" value="" oninvalid="this.setCustomValidity('Neįvestas vartotojo slaptažodis')" oninput="this.setCustomValidity('')" required><br>
                </p>   

		        <p style="text-align: left;">Telefonas:<br>
                    <input class="form-control" name="telefonas" type="text" value="" oninvalid="this.setCustomValidity('Neįvestas vartotojo telefono numeris')" oninput="this.setCustomValidity('')" required><br>
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