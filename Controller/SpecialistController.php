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

}
$SpecialistController = new SpecialistController();
?>