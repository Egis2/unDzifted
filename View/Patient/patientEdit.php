
<?php 
include("../../database.php");
?>

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
            <?php 
                echo "<a class='btn btn-outline-dark' href='PatientInfo.php?id={$_GET['id']}'>Atgal</a>";
            ?>
            </li>
        </div>
    </nav>
    <br> 
    <br>
    <?php
		global $database;
		$req_user_info = $database->GetUserInfo($_GET['id']);
	?>
    <div class="form-group login">
        <form action='../../Controller/PatientController.php' method='POST'>
            <center><b>Paciento informacijos redagavimas</b></center><br>
            <div style="text-align: left;">
                <label for="vardas">Paciento vardas:</label>
                <?php 
						  echo "<input name='vardas' type='text' class='form-control' value='{$req_user_info['vardas']}' oninvalid='this.setCustomValidity(\"Neužpildytas paciento vardas\")' oninput='this.setCustomValidity(\"\")' required>";
					?>
            </div>
            <br>
            <div style="text-align: left;">
                <label for="pavarde">Paciento pavardė:</label>
                <?php
                    echo "<input name='pavarde' type='text' class='form-control' value='{$req_user_info['pavarde']}' oninvalid='this.setCustomValidity(\"Neužpildyta paciento pavardė\")' oninput='this.setCustomValidity(\"\")' required>";
                ?>
            </div style="text-align: left;">
            <br>
            <div style="text-align: left;">
                <label for="asmens_kodas">Paciento asmens kodas:</label>
                <?php
                    echo "<input name='asmens_kodas' type='text' class='form-control' value='{$req_user_info['asmens_kodas']}' oninvalid='this.setCustomValidity(\"Neužpildytas paciento asmens kodas\")' oninput='this.setCustomValidity(\"\")' required>";
                ?>
            </div style="text-align: left;">
            <br>
            <div style="text-align: left;">
                <label for="el_pastas">Paciento el. paštas:</label>
                <?php
					  echo "<input name='el_pastas' type='email' class='form-control' value='{$req_user_info['el_pastas']}' oninvalid='this.setCustomValidity(\"Neužpildytas paciento elektroninis paštas\")' oninput='this.setCustomValidity(\"\")' required>";
                ?>
            </div style="text-align: left;">
            <br>
            <div style="text-align: left;">
                <label for="telefonas">Paciento telefono numeris:</label>
                <?php
                    echo "<input name='telefonas' type='text' class='form-control'  value='{$req_user_info['telefonas']}' oninvalid='this.setCustomValidity(\"Neužpildytas paciento telefonas\")' oninput='this.setCustomValidity(\"\")' required>";
                ?>
            </div style="text-align: left;">
            <br>
            <div style="text-align: left;">
                <label for="gimimo_data">Paciento gimimo data:</label>
                <?php
					  echo "<input name='gimimo_data' type='date' class='form-control' value='{$req_user_info['gimimo_data']}' oninvalid='this.setCustomValidity(\"Neužpildyta paciento gimimo data\")' oninput='this.setCustomValidity(\"\")' required>";
                ?>
            </div style="text-align: left;">
            <br>

            <div style="text-align: left;">
                <label for="slaptazodis">Paciento slaptažodis:</label>
                <input name='slaptazodis' type='password' class="form-control" oninvalid="this.setCustomValidity('Neužpildytas slaptažodis')" oninput="this.setCustomValidity('')" required>
            </div style="text-align: left;">
            <br>
            <input class="btn btn-outline-dark" type="submit" value="Užbaigti redagavimą">
            <?php
                 echo  "<input class='btn btn-outline-dark' type='hidden' name='submitEdit' value='{$_GET['id']}'/>";
             ?>
        </form>
    </div>
</body>
</html>
