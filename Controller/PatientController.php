<?php 
include ("../session.php");

class PatientController {

    function PatientController(){
        if (isset($_POST['submitEdit'])){
            $this->editPatient();
        }
        else if (isset($_POST['addReservation'])){
            $this->addReservation();
        }
        else if (isset($_POST['deleteReservation'])){
            $this->deleteReservation($_POST['reservacijos_id']);
        }
        //else {
      //      header("Location: ../index.php");
      //  }
    }


    function editPatient()
    {
        global $database;
        $result = $database->getUserInfo($_POST['submitEdit']);
        $registerValue = $_POST;
        if($database->updatePatientInfo($_POST)){
            $_SESSION['success'] = true;
            $_SESSION['message'] = "Operacija buvo sėkminga.";
            $_SESSION['vardas'] = $_POST['vardas'];
            $_SESSION['pavarde'] = $_POST['pavarde'];
        }
        else{
            $_SESSION['success'] = false;
            $_SESSION['message'] = "Operacija nebuvo sėkminga.";
        }
        header("Location: ../View/Patient/PatientInfo.php?id=".$_POST['submitEdit']);
    }

    function addReservation(){
        global $database;
        if (isset($_POST['laikas']) && strtotime($_POST['laikas']) > (strtotime(date("Y-m-d h:m:s")) + 86400))
        {
            $query = "INSERT INTO " . TBL_REZERVACIJA . " VALUES ('{$_POST['laikas']}', 'PAKEISTI', NULL, '{$_POST['gydytojas']}', '{$_POST['id']}')";
            if ($database->query($query))
            {
                $_SESSION['success'] = true;
                $_SESSION['message'] = "Užsiregistruota pas gydytoją sėkmingai.";
            }
            else{
                $_SESSION['success'] = false;
                $_SESSION['message'] = "Nepavyko įkelti užklausos į duomenų bazę.";
            }
        }
        else{
            $_SESSION['success'] = false;
            $_SESSION['message'] = "Blogai pasirinktas laikas. Galima registruotis 24h į priekį.";
        }
        header("Location: ../View/Patient/PatientReservations.php?id=".$_POST['id']);
    }

    function deleteReservation($id){
        global $database;
        $query = "DELETE FROM " . TBL_REZERVACIJA . " WHERE id_REZERVACIJA = '$id'";
        if ($database->query($query)){
            $_SESSION['success'] = true;
            $_SESSION['message'] = "Rezervacija atšaukta sėkmingai.";
        }
        else{
            $_SESSION['success'] = false;
            $_SESSION['message'] = "Nepavyko atšaukti rezervacijos.";
        }
        header("Location: ../View/Patient/PatientReservations.php?id=".$_POST['id']);
    }
}
    $PatientController = new PatientController();
?>