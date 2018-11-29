 <?php
//Formuojamas meniu.
if (isset($session) && $session->logged_in) {
    $path = "";
    if (isset($_SESSION['path'])) {
        $path = $_SESSION['path'];
        unset($_SESSION['path']);
    }
    ?>
	<div style="font-family:verdana; overflow;hidden">
	<ul>
		<?php 
		//echo "<li><a href=\"/projektas\">Pradžia</a></li>";
		echo "<li><a href=\"..\">Pradžia</a></li>";
		echo "<li><a href=\"" . $path . "userinfo.php?user=$session->username\">Mano paskyra</a></li>";
		echo "<li><a href=\"" . $path . "place_bets.php\">Atlikti statymus</a></li>";
		echo "<li><a href=\"" . $path . "statistics.php\">Statistika</a></li>";
		
		if ($session->isEmployee() || $session->isAdmin())
		{
			echo "<li><a href=\"" . $path . "compose_results.php\">Suvesti rezultatus</a></li>";
		}
		if ($session->isAdmin()) {
			echo "<li><a href=\"" . $path . "admin/admin.php\">Admin</a></li>";
		}
		
		echo "<li class='right'><a href=\"" . $path . "process.php\">Atsijungti</a></li>";
		?>
	</ul>
    <?php
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

else{
?>
<ul>
	<li><a href="..">Pradžia</a></li>
	<li><a href='/View/User/login.php'> Prisijungti</a> </li>
</ul>

<?php 	echo "<h1> Neprisijunges </h1>";
}
?>