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
    $dalys = explode(" ", $_POST['liga']);
    $query = "SELECT id_LIGA FROM " . TBL_LIGA . " WHERE ligos_kodas='{$dalys['1']}' AND pavadinimas='{$dalys['0']}'";
    $liga = mysqli_fetch_array($database->query($query));
    if ($database->newPatientIllness($liga['id_LIGA'], $_POST['id_pacientas'])){

      $paciento_ligos_id = $database->selectLastFromPatientIlness($_POST['id_pacientas']);
      if($database->newIllnessDescription($paciento_ligos_id['id_PACIENTO_LIGOS'], $_POST['id_specialistas'], $liga['id_LIGA'], $_POST['aprasymas'], $_POST['data'], $_POST['diagnozes_kodas'], $_POST['isvada'])){
        $_SESSION['success'] = true;
        $_SESSION['message'] = "Pacientui '". $_POST['pacientas'] . "' užfiksuota liga: " . $dalys['0'];
      }
      else{
        $_SESSION['success'] = false;
        $_SESSION['message'] = "Pacientui '". $_POST['pacientas'] . " nepavyko užfiksuoti ligos: " . $dalys['0'];
      }
      
    }

    header("Location: ../View/Familydoctor/patientIlnesses.php?id={$_POST['id_pacientas']}");
  }

}
$FamilyDoctorController = new FamilyDoctorController();
?>