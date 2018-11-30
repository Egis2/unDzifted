<br>
<br>
<br>
<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Paciento informacija</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../Styles/styles.css">
  </head>
  <body>
 	<?php 
        include("../../session.php");
    ?>
    <nav class="navbar fixed-top navbar-light navbar-expand-lg mt-0" style="background: #fff">
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="btn btn-outline-dark" href=\unDzifted>Atgal</a>
            </li>
            <li>
			<?php
				echo "<a class='nav-link' href='PatientEdit.php?id={$_GET['id']}'>Paciento informacijos redagavimas</a>";
			?>
            </li>
        </div>
    </nav>
	<?php
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

		global $database;
		$req_user_info = $database->GetUserInfo($_GET['id']);
	?>
    <div class="form-group login">
		  	<form method='post'>
		  		<center><b>Paciento informacija</b></center><br>
				<div style="text-align: left;">
				  	<label for="vardas">Paciento vardas:</label>
					<?php 
						  echo "<input name='vardas' type='text' class='form-control' readonly value='{$req_user_info['vardas']}'>";
					?>
				</div>
				<br>
				<div style="text-align: left;">
				 	<label for="pavarde">Paciento pavardė:</label>
					<?php
					  echo "<input name='pavarde' type='text' class='form-control' readonly value='{$req_user_info['pavarde']}'>"
					?>
				</div style="text-align: left;">
				<br>
                <div style="text-align: left;">
				 	<label for="asmens_kodas">Paciento asmens kodas:</label>
					<?php
					  	echo "<input name='asmens_kodas' type='text' class='form-control' readonly value='{$req_user_info['asmens_kodas']}'>";
					?>
				</div style="text-align: left;">
				<br>
                <div style="text-align: left;">
				 	<label for="el_pastas">Paciento el. paštas:</label>
					<?php
					  echo "<input name='el_pastas' type='email' class='form-control' readonly value='{$req_user_info['el_pastas']}'>";
					?>
				</div style="text-align: left;">
				<br>
                <div style="text-align: left;">
				 	<label for="telefonas">Paciento telefono numeris:</label>
					 <?php
					  		echo "<input name='telefonas' type='text' class='form-control' readonly value='{$req_user_info['telefonas']}'>";
					  ?>
				</div style="text-align: left;">
				<br>
                <div style="text-align: left;">
				 	<label for="gimimo_data">Paciento gimimo data:</label>
					<?php
					  echo "<input name='gimimo_data' type='date' class='form-control' readonly value='{$req_user_info['gimimo_data']}'>";
					?>
				</div style="text-align: left;">
				<br>
		 	</form>
		</div>
</body>
</html>