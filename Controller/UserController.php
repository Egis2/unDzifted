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
        else if ($session->logged_in) {
            $this->userLogout();
        }
        else {
            header("Location: ../index.php");
        }
    }




    // User Logout function
    function userLogout() {
        global $session;
        $retval = $session->logout();
        header("Location: index.php");
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
     
        $SucessfullyInserted = $database->addNewUser($nextUserIndex[0],$registerValue,1);

       header("Location: ../index.php");
    }
}
$UserController = new UserController();
?>