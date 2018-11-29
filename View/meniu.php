<?php
  // meniu.php  rodomas meniu pagal vartotojo rolę

  if (isset($_SESSION['prisijunges'])) {

	$vardas=$_SESSION['vardas'];
	$pavarde=$_SESSION['pavarde'];

?>

<html>
  <head>
    <title>Nepriklausoma paieškų tarnyba</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="Styles/styles.css">
  </head>
  <body>

    <?php

      if ($session->isAdmin()) 
      {
    ?>
	<nav class="navbar fixed-top navbar-light navbar-expand-lg mt-0" style="background: #fff">
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link">Gydytojų sąrašas</a>
				</li>
				<li class="nav-item">
					<a class="nav-link">Kabinetų sąrašas</a>
				</li>
			</ul>
			<ul class="navbar-nav m1-auto">
				<li class="navbar-text">
					<?php
					echo "".$vardas." ".$pavarde."";
					?>
				</li>
				<li class="nav-item">
					<a class="btn btn-outline-dark" href="Controller/UserController.php?logout=true">Atsijungti</a>
				</li>
			</ul>
		</div>
	</nav>

    <?php
		}
		else if ($session->isFamilyDoctor())
		{
	?>
		
		<nav class="navbar fixed-top navbar-light navbar-expand-lg mt-0" style="background: #fff">
        	<div class="collapse navbar-collapse" id="navbarNav">
          		<ul class="navbar-nav mr-auto">
							<?php
            echo "<a class='nav-link' href='View/FamilyDoctor/patientList.php'>Pacientų sąrašas</a>";
            ?>
				</ul>
				<ul class="navbar-nav m1-auto">
					<li class="navbar-text">
					<?php
						echo "".$vardas." ".$pavarde."";
					?>
				</li>
				<li class="nav-item">
					<a class="btn btn-outline-dark" href="Controller/UserController.php?logout=true">Atsijungti</a>
				</li>
			</ul>
			</div>
		</nav>

	<?php
		}
		else if ($session->isDoctorSpecialist()) 
		{
	?>
		<nav class="navbar fixed-top navbar-light navbar-expand-lg mt-0" style="background: #fff">
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link">Pacientų sąrašas</a>
					</li>
				</ul>
				<ul class="navbar-nav m1-auto">
					<li class="navbar-text">
						<?php
						echo "".$vardas." ".$pavarde."";
						?>
					</li>
					<li class="nav-item">
						<a class="btn btn-outline-dark" href="Controller/UserController.php?logout=true">Atsijungti</a>
					</li>
				</ul>
			</div>
		</nav>
	<?php
		}
		else if ($session->isPatient()) 
		{
	?>
		<nav class="navbar fixed-top navbar-light navbar-expand-lg mt-0" style="background: #fff">
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
            <?php
            echo "<a class='nav-link' href='View/Patient/PatientEdit.php?id={$_SESSION['id']}'>Paciento informacija</a>";
            ?>
					</li>
					<li class="nav-item">
          <?php
              echo "<a class='nav-link' href='View/Patient/PatientReservations.php?id={$_SESSION['id']}'>Rezervacijų sąrašas</a>";
           ?>
					</li>
					<li class="nav-item">
          <?php
              echo "<a class='nav-link' href='View/Patient/PatientVisits.php?id={$_SESSION['id']}'>Apsilankymų ataskaita</a>";
           ?>
					</li>
					<li class="nav-item">
          <?php
              echo "<a class='nav-link' href='View/Patient/PatientIlnesses.php?id={$_SESSION['id']}'>Ligų ataskaita</a>";
           ?>
					</li>
					<li class="nav-item">
          <?php
              echo "<a class='nav-link' href='View/Patient/PatientRecipe.php?id={$_SESSION['id']}'>Receptų istorija</a>";
           ?>
					</li>
				</ul>
				<ul class="navbar-nav m1-auto">
					<li class="navbar-text">
						<?php
						echo "".$vardas." ".$pavarde."";
						?>
					</li>
					<li class="nav-item">
						<a class="btn btn-outline-dark" href="Controller/UserController.php?logout=true">Atsijungti</a>
					</li>
				</ul>
			</div>
		</nav>

	<?php
		}
		else 
		{
      // Jeigu neprisijunges;
      
}

	if ($form->num_errors > 0 ){
		echo "<ul class='error'>";
			foreach ($form->getErrorArray() as $key => $val )
			{
				echo "{$val} <br>";
			}
			echo "</ul>";
	}
	else if (isset($_SESSION['success']) && !$_SESSION['success']) 
	{
		echo "<ul class='error'>Klaida: {$_SESSION['message']}</ul>";
	}
	else if (isset($_SESSION['success']) && $_SESSION['success'])
		echo "<ul class='success'> {$_SESSION['message']} </ul>";


	unset($_SESSION['success']);
	unset($_SESSION['message']);
	unset($_SESSION['regsuccess']);
	unset($_SESSION['value_array']);
	unset($_SESSION['error_array']);
  }
?>
	</body>
</html>
