<?php
  // meniu.php  rodomas meniu pagal vartotojo rolę

  if (isset($session) && $session->logged_in) {

  $user=$_SESSION['user'];
  $userlevel=$_SESSION['ulevel'];
  $role="";
  {
    foreach($user_roles as $x=>$x_value)
    {
      if ($x_value == $userlevel) 
        $role=$x;
    }
  }
?>

<html>
  <head>
    <title>Nepriklausoma paieškų tarnyba</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="include/styles.css">
  </head>
  <body>


    <?php

      if (($userlevel == $user_roles[ADMIN_LEVEL])) 
      {
    ?>
      <nav class="navbar fixed-top navbar-light navbar-expand-lg mt-0" style="background: #fff">
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href=\useredit.php>Redaguoti paskyrą</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href=\admin.php>Sistemos vartotojų sąrašas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href=\admin-register.php>Registruoti ieškomą asmenį</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href=\admin-statistics.php>Ieškomų asmenų statistika</a>
            </li>
          </ul>
          <ul class="navbar-nav m1-auto">
            <li class="navbar-text">
              <?php
                echo "".$user." ".$role."";
              ?>
            </li>
            <li class="nav-item">
              <a class="btn btn-outline-dark" href="\logout.php">Atsijungti</a>
            </li>
          </ul>
        </div>
      </nav>

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
  }
?>
