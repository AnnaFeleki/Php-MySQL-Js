<?php

    session_start();
    if(isset($_POST['loginButton'])) {

        require('./config/db.php');

        $useremail = filter_var($_POST["useremail"], FILTER_SANITIZE_EMAIL);
        $userpassword = filter_var($_POST["userpassword"], FILTER_SANITIZE_STRING);
        
        $stmt = $pdo -> prepare ('SELECT *  from users WHERE email = ?');
        $stmt -> execute([$useremail]);
        $user = $stmt -> fetch();


        if (isset($user)) {
            if (password_verify($userpassword, $user -> password)) {
                echo "The password is correct!";
                $_SESSION['userId'] = $user-> id;
                header('Location: http://localhost//phploginsystem/index.php');
            } else {
                $wrongLogin = "The email or password is wrong!";
                
            }
        }

    }


?>

<?php require('./inc/header.html'); ?>

<div class="container">
    <div class="card">
        <div class="card-header bg-light mb-3">Register</div>
        <div class="card-body">
            <form action="login.php" method="POST">

        

                <div class="form-group">
                    <label for="useremail">Email</label>
                    <input required type="email" name="useremail" class="form-control">
                    <br>
                    <?php if (isset($wrongLogin)) { ?>
                    <p><?php echo $wrongLogin ?> </p>
                    <?php } $wrongLogin ?>
                </div>

                <div class="form-group">
                    <label for="userpassword">Password</label>
                    <input required type="password" name="userpassword" class="form-control">
                </div>

                <button name ="loginButton" type ="submit" class="btn-primary">Login</button>
            </form>

            </form>

        </div>
    </div>


    <?php require('./inc/footer.html'); ?>