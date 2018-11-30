<?php 
include ("../session.php");
class SpecialistController
{

  function SpecialistController()
  {
      if (isset($_POST['sendToFamilyDoctor'])){
        $this->sendToFamilyDoctor();
      }
  }

  function sendToFamilyDoctor(){
    global $database;
    $result = $database->sendFromSpecialistToFamilyDoctor($_POST['id_tyrimas']);
    header("Location: ../View/Specialist/PatientTests.php?id_pacientas={$_POST['id_pacientas']}");
  }

}
$SpecialistController = new SpecialistController();
?>