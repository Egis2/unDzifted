<?php 

include ("../session.php");

class UserController{
    function UserController(){
        global $session;

        if (isset($_POST['login'])){
            $this->userLogin();
        }
        else if ($session->logged_in) {
            echo "Atejo cia";
            header("Location: ../index.php");
            $this->userLogout();
        }
        else {
            echo "Atejo cia";
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
}
$UserController = new UserController();
?>