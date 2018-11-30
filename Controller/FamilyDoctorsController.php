<?php 
class FamilyDoctorController{

  function FamilyDoctorController(){
    global $session;

    if (isset($_POST['siuntimas'])){
        $this->postNewSiuntima();
    }
  }

  function postNewSiuntima(){
    var_dump($_POST);
    if($_POST["siuntimas"] == 1){
      
    }
  }

}
$FamilyDoctorController = new FamilyDoctorController();
?>