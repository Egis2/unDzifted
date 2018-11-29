
<?php 
class PatientController{
    function PatientController(){
        if (isset($_POST['edit'])){
            $this->patientEdit();
        }
    }
}

?>