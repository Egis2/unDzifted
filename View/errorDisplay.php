<?php 
    include ("../../session.php");
    if (isset($_SESSION['success']) && !$_SESSION['success']) 
    {
        echo "<div class='alert alert-danger mb-0 text-center' role='alert'>".
                "<strong>{$_SESSION['message']}</strong>".
            "</div>";
    }
    else if (isset($_SESSION['success']) && $_SESSION['success'])
    {
        echo "<div class='alert alert-success mb-0 text-center' role='alert'>".
        "<strong>{$_SESSION['message']}</strong>".
        "</div>";
    }
    unset($_SESSION['success']);
    unset($_SESSION['message']);
?>