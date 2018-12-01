<?php 
include ("../session.php");
class SpecialistController
{

  function SpecialistController()
  {
      if (isset($_POST['sendToFamilyDoctor'])){
        $this->sendToFamilyDoctor();
      }

      if (isset($_POST['newPatientTest'])){
        $this->newPatientTest();
      }

      if (isset($_POST['newProcedure'])){
        $this->newProcedure();
      }
      if (isset($_POST['newPatientIlness']))
      {
        $this->newPatientIllness();
      }
  }


  function sendToFamilyDoctor(){
    global $database;

    if ( $database->sendFromSpecialistToFamilyDoctor($_POST['id_tyrimas'])){
        $_SESSION['success'] = true;
        $_SESSION['message'] = "Paciento tyrimai perduoti šeimos gydytojui.";
    }

    else{
        $_SESSION['success'] = false;
        $_SESSION['message'] = "Nepavyko perduoti paciento tyrimų šeimos gydytojui.";
    }

    header("Location: ../View/Specialist/PatientTests.php?id={$_POST['id']}");
  }


  function newPatientTest(){
    global $database;
    if ($database->newPatientTest($_POST['id_pacientas'], $_POST['id_specialistas'], $_POST['data'], $_POST['aprasymas'], $_POST['isvada'])){
      $_SESSION['success'] = true;
      $_SESSION['message'] = "Paciento tyrimai sėkmingai sukurtas.";
    }
    else{
      $_SESSION['success'] = false;
      $_SESSION['message'] = "Nepavyko sukurti paciento tyrimo.";
    }
    header("Location: ../View/Specialist/PatientTests.php?id={$_POST['id_pacientas']}");
  }

  function newProcedure(){
    global $database;
    if($database->newProcedure($_POST['id_pacientas'], $_POST['id_specialistas'], $_POST['data'], $_POST['vieta'], $_POST['aprasymas'])){
      $_SESSION['success'] = true;
      $_SESSION['message'] = "Procedūra užregistruota sėkmingai.";
    }
    else{
      $_SESSION['success'] = false;
      $_SESSION['message'] = "Nepavyko sukurti naujos procedūros.";
    }
    header("Location: ../View/Specialist/PatientProcedures.php?id={$_POST['id_pacientas']}");
  }

  function newPatientIllness(){
    global $database;
    $dalys = explode(" ", $_POST['liga']);
    $query = "SELECT id_LIGA FROM " . TBL_LIGA . " WHERE ligos_kodas='{$dalys['1']}' AND pavadinimas='{$dalys['0']}'";
    $liga = mysqli_fetch_array($database->query($query));
    //$database->newPatientIllness($_POST['id_pacientas'], $_POST['id_specialistas'], $liga['id_LIGA'], $_POST['aprasymas'], $_POST['data'], $_POST['diagnozes_kodas'], $_POST['isvada'])
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
    else{
      $_SESSION['success'] = false;
      $_SESSION['message'] = "Nepavyko sukurti naujos paciento ligos.";
      //$_SESSION['message'] = "Pacientui '". $_POST['pacientas'] . " nepavyko užfiksuoti ligos: " . $dalys['0'];
    }
    //$_SESSION['success'] = false;
    //$_SESSION['message'] = $paciento_ligos_id['id_PACIENTO_LIGOS']. " ID";
    header("Location: ../View/Specialist/PatientIlnesses.php?id={$_POST['id_pacientas']}");
  }

}
$SpecialistController = new SpecialistController();
?>