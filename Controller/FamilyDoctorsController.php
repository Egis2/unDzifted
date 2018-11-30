<?php 
include ("../session.php");
class FamilyDoctorController{

  function FamilyDoctorController(){
    global $session;

    if (isset($_POST['siuntimas'])){
        $this->postNewSiuntima();
    }
  }

  function postNewSiuntima(){
    echo "?????";
    var_dump($_POST);
    global $database;
    $result = $database->addNewSending($_POST['komentaras'],$_POST['priezastis'],1,1,1); // need to find doctors name and surname, change query
    var_dump($result);
    header("Location: ../View/FamilyDoctor/patientList.php");
  }

}
$FamilyDoctorController = new FamilyDoctorController();
?>