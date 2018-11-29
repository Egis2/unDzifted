<?php include ("/session.php");
    global $session

    if (isset($_POST['login'])){
        $this->userLogin();
    }






    function procLogin() {
        global $session, $form;
		
        $retval = $session->login($_POST['email'], $_POST['password']));

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
?>