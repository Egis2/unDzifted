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

  }

}
$FamilyDoctorController = new FamilyDoctorController();
?>