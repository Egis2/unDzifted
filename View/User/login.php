<?php
    if (isset($form) && isset($session) && !$session->logged_in) 
    {
    ?>   
    <div class="jumbotron text-center header">
        <h1>Gydymo įstaiga</h1>
    </div>
    <div class="form-group login">
        <form action="Controller/UserController.php" method="POST">              
            <center><b>Prisijungimas</b></center>
            <div style="text-align: left;">
                <label for="user">Vartotojo el. paštas:</label>
                    <input class="form-control" name="email" type="text" value=""/>
                    <?php echo $form->error("email"); ?>
                    <br>
            </div>
            <div style="text-align: left;">
            <label for="pass">Slaptažodis:</label> 
                <input class="form-control" name="password" type="password" value=""/>
                <?php echo $form->error("password"); ?>
                <br>
            </div>  
            <p>
                <input class="btn btn-outline-dark" type="submit" value="Prisijungti"/>
                <input class="btn btn-outline-dark" type="hidden" name="login" value="1"/>
            </p>
            <p>
                <a href="View/User/register.php">Registracija</a>
            </p>     
        </form>
    </div>
<?php
    }
?>