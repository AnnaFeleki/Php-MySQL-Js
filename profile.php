<?php

    session_start();

    if(isset($_SESSION['userId'])) {

        require('./config/db.php');

        $userId = $_SESSION['userId'];

        if(isset($_POST['editButton'])){
            $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
            $useremail = filter_var($_POST["useremail"], FILTER_SANITIZE_EMAIL);
            $stmt = $pdo -> prepare('UPDATE users SET name=?, email = ? WHERE id=?');
            
            $stmt->execute([$username, $useremail, $userId]);

        }

        $stmt= $pdo ->prepare('SELECT * from users WHERE id=?');
        $stmt->execute([$userId]);
        $user = $stmt-> fetch();

    }


?>

<?php require('./inc/header.html'); ?>

<div class="container">
    <div class="card">
        <div class="card-header bg-light mb-3">Update your Details</div>
        <div class="card-body">
            <form action="profile.php" method="POST">

                <div class="form-group">
                    <label for="username">User Name</label>
                    <input required type="text" name="username" class="form-control" value="<?php echo $user->name?>"/>
                </div>

                <div class="form-group">
                    <label for="useremail">User Email</label>
                    <input required type="email" name="useremail" class="form-control" value="<?php echo $user->email?>">
                    <br>
                    <?php if (isset($emailTaken)) { ?>
                    <p><?php echo $emailTaken ?> </p>
                    <?php } $emailTaken ?>
                </div>

                <button name ="editButton" type ="submit" class="btn-primary">Update the Details</button>
            </form>

            </form>

        </div>
    </div>


    <?php require('./inc/footer.html'); ?>