<?php

    if(isset($_POST['registerButton'])) {

        require('./config/db.php');

        // $username = $_POST["username"];
        // $useremail = $_POST["useremail"];
        // $userpassword = $_POST["userpassword"];

        $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
        $useremail = filter_var($_POST["useremail"], FILTER_SANITIZE_EMAIL);
        $userpassword = filter_var($_POST["userpassword"], FILTER_SANITIZE_STRING);

        $passwordHashed = password_hash($userpassword, PASSWORD_DEFAULT);
        
        // echo $username . " " . $useremail . " " . $userpassword;


        if(filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
            $stmt = $pdo ->prepare('SELECT * FROM users WHERE email = ?');
            $stmt -> execute([$useremail]);
            $totalUsers = $stmt ->rowCount();

            // echo $totalUsers .' <br>' ;
        }

        if($totalUsers > 0) {

            $emailTaken ="email taken";
        } else {
            $stmt = $pdo ->prepare('INSERT into users(name, email, password) VALUES (?, ?, ?)');
            $stmt -> execute([$username, $useremail, $passwordHashed]);
            header('Location: http://localhost//phploginsystem/index.php');



        }

    }


?>

<?php require('./inc/header.html'); ?>

<div class="container">
    <div class="card">
        <div class="card-header bg-light mb-3">Register</div>
        <div class="card-body">
            <form action="register.php" method="POST">

                <div class="form-group">
                    <label for="username">User Name</label>
                    <input required type="text" name="username" class="form-control">
                </div>

                <div class="form-group">
                    <label for="useremail">Email</label>
                    <input required type="email" name="useremail" class="form-control">
                    <br>
                    <?php if (isset($emailTaken)) { ?>
                    <p><?php echo $emailTaken ?> </p>
                    <?php } $emailTaken ?>
                </div>

                <div class="form-group">
                    <label for="userpassword">Password</label>
                    <input required type="password" name="userpassword" class="form-control">
                </div>

                <button name ="registerButton" type ="submit" class="btn-primary">Register</button>
            </form>

            </form>

        </div>
    </div>


    <?php require('./inc/footer.html'); ?>