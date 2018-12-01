<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Nedarbingumo lapelio išrašymas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../Styles/styles.css">
  </head>
  <body>
<?php
    include '../../session.php';
    $id = $_GET['id'];
    global $database;
    $result = $database->getNameAndSurname($_GET['id']);
    $nameSurname = '';

    while($row = mysqli_fetch_array($result)){
        $nameSurname= $row['fullName'];
    }
?>
    <br>
    <nav class="navbar fixed-top navbar-light navbar-expand-lg mt-0" style="background: #fff">
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
            <?php
				echo "<a class='btn btn-outline-dark' href='patientSickList.php?id={$id}'>Atgal</a>";
            ?>
            </li>
        </div>
    </nav>
    <br> 
    <br>
    <div class="form-group login">
        <form method='post'>
            <center><b>Nedarbingumo lapelis</b></center><br>
            <div style="text-align: left;">
                <label for="pacientas">Pacientas:</label>
                <input name='pacientas' type='text' class="form-control" value='<?php echo $nameSurname; ?>' readonly >
            </div style="text-align: left;">
            <br>
            <div style="text-align: left;">
                <label for="data_pradzios">Pradžios data:</label>
                <input name='data_pradzios' type='date' class="form-control" oninvalid="this.setCustomValidity('Nepasirinkta pradžios data')" oninput="this.setCustomValidity('')" required>
            </div>
            <br>
            <div style="text-align: left;">
                <label for="data_pabaigos">Pabaigos data:</label>
                <input name='data_pabaigos' type='date' class="form-control" oninvalid="this.setCustomValidity('Nepasirinkta pabaigos data')" oninput="this.setCustomValidity('')" required>
            </div>
            <br>
            <div style="text-align: left;">
                <label for="priezastis"">Priežastis:</label>
                <textarea class="form-control" rows="3" name="priezastis"" oninvalid="this.setCustomValidity('Neužpildyta priežastis')" oninput="this.setCustomValidity('')" required></textarea>
            </div style="text-align: left;">
            <br>
            <div style="text-align: left;">
                <label for="diagnozes_kodas">Diagnozės kodas:</label>
                <input name='diagnozes_kodas' type='text' class="form-control" oninvalid="this.setCustomValidity('Neužpildytas diagnozės kodas')" oninput="this.setCustomValidity('')" required>
            </div style="text-align: left;">
            <br>
            <input class="btn btn-outline-dark" type="submit" name="write" value="Išrašyti nedarbingumo lapelį">
        </form>
    </div>
    <?php
    
    if(isset($_POST['write'])){
        $newSickListMember = $database->addNewSickness($_POST['data_pradzios'], $_POST['data_pabaigos'],$_POST['priezastis'],$_POST['diagnozes_kodas'],$_GET['id'],$_SESSION['id']);
        header("Location:patientSickList.php?id={$id}");
    }
    ?>
   
</body>
</html>
