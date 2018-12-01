<?php 

include ("../session.php");

class UserController{
    function UserController(){
        global $session;

        if (isset($_POST['login'])){
            $this->userLogin();
        }
        else if(isset($_POST['register'])){
            $this->userRegistration();
        }
        else if (isset($_GET['logout'])) {
             $this->userLogout();
        }
        else if (isset($_POST['edit'])){

        }
        else {
            header("Location: ../index.php");
        }
    }

    // User Logout function
    function userLogout() {
        
        /*
            Pasalinti $_SESSION elementus atsijungus.
        */
        session_unset();
        header("Location: ../index.php");
    }

    function userLogin() {
        global $session, $form;
		
        $retval = $session->login($_POST['email'], $_POST['password']);

        if ($retval) {
            $session->logged_in = 1;
            header("Location: " . $session->referrer);
        }
        else {
            $session->logged_in = null;
            $_SESSION['value_array'] = $_POST;
            $_SESSION['error_array'] = $form->getErrorArray();
            header("Location: " . $session->referrer);
        }
    }
    function userRegistration(){

    $registerValue = $_POST;
    global $database;
    $result = $database->getNextUserId();
    
    while($row = mysqli_fetch_array($result))
    {
        $nextUserIndex = $row;
    }
    
    if($database->addNewUser($nextUserIndex[0],$registerValue, PATIENT_NAME)){
        $_SESSION['success'] = true;
        $_SESSION['message'] = "Užregistruota sėkmingai.";
    }
    else{
        $_SESSION['success'] = false;
        $_SESSION['message'] = "Registracija nesėkminga.";
    }

    header("Location: ../index.php");
    }
    
    function userEdit(){
        $name = $_POST['email'];
        $lastname = $_POST['password'];
        $adress = $_POST['adress'];
        $phonenumber = $_POST['phone'];
        $birthdate = $_POST['birthdate'];
        $code = $_POST['code'];

        $session->updateUser($name, $lastname, $adress, $phonenumber, $birthdate, $code);
    }
}
$UserController = new UserController();
?>