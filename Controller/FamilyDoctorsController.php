<?php 
include ("../session.php");
class FamilyDoctorController{

  function FamilyDoctorController(){
    global $session;

    if (isset($_POST['siuntimas'])){
        $this->postNewSiuntima();
    }

    else if (isset($_POST['newPatientIlness']))
    {
        $this->newPatientIlness();
    }
  }

  function postNewSiuntima(){
    echo "?????";

  }

  function newPatientIlness(){
    global $database;
    $query = "SELECT *  FROM " . TBL_LIGA . " WHERE id_LIGA='{$_POST['liga']}'";
    $liga = mysqli_fetch_array($database->query($query));
    if ($database->newPatientIllness($_POST['liga'], $_POST['id_pacientas'])){

      $paciento_ligos_id = $database->selectLastFromPatientIlness($_POST['id_pacientas']);
      if($database->newIllnessDescription($paciento_ligos_id['id_PACIENTO_LIGOS'], $_POST['id_specialistas'], $_POST['liga'], $_POST['aprasymas'], $_POST['data'], $_POST['diagnozes_kodas'], $_POST['isvada'])){
        $_SESSION['success'] = true;
        $_SESSION['message'] = "Pacientui '". $_POST['pacientas'] . "' užfiksuota liga: " .$liga['pavadinimas'];
      }
      else{
        $_SESSION['success'] = false;
        $_SESSION['message'] = "Pacientui '". $_POST['pacientas'] . " nepavyko užfiksuoti ligos: " .$liga['pavadinimas'];
      }
      
    }
    else
    {
      $_SESSION['success'] = false;
      $_SESSION['message'] = "Nepavyko užregistruoti.";
    }
    header("Location: ../View/Familydoctor/patientIlnesses.php?id={$_POST['id_pacientas']}");
  }

}
$FamilyDoctorController = new FamilyDoctorController();
?>