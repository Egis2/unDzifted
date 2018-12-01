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
    header("Location: ../View/Specialist/PatientTests.php?id={$_POST['id']}");
  }

}
$SpecialistController = new SpecialistController();
?>