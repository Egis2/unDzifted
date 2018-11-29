<?php include ("../session.php");
class UserController{
    function UserController(){
        global $session;
        
        if (isset($_POST['login'])){
            header("Location: ../");
            //$this->userLogin();
        }
        else if ($session->logged_in) {
            $this->procLogout();
        }
        else {
            header("Location: index.php");
        }
    }




    // User Logout function
    function procLogout() {
        global $session;
        $retval = $session->logout();
        header("Location: index.php");
    }

    function procLogin() {
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
?>