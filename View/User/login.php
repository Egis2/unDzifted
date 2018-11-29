<?php
    if (isset($form) && isset($session) && !$session->logged_in) {
    ?>   
    <form action="Controller/UserController.php" method="POST">              
        <center style="font-size:18pt;"><b>Prisijungimas</b></label></center>
        <p style="text-align:left;">Vartotojo el paštas:<br>
            <input class ="s1" name="email" type="text" value=""/><br>
            <?php echo $form->error("user"); ?>
        </p>
        <p style="text-align:left;">Slaptažodis:<br>
            <input class ="s1" name="password" type="password" value=""/><br>
            <?php echo $form->error("pass"); ?>
        </p>  
        <input type="submit" value="Prisijungti"/>
        <input type="hidden" name="login" value="1"/>
        <p>
            <a href="View/User/register.php">Registracija</a>
        </p>     
    </form>
<?php
}
?>