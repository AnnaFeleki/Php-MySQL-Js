<?php

session_start();

if(isset($_SESSION['userId'])) {
    require('./config/db.php');

    $userId = $_SESSION['userId'];

    $stmt  = $pdo -> prepare('SELECT * FROM users where id = ?');
    $stmt -> execute([$userId]);

    $user = $stmt -> fetch();


    if($user->type === 'guest') {
        $message = "Your role is a guest";
    }
}
?>

<?php require('./inc/header.html');?>

<div class="container">
    <div class="card bg-light mb-3">
        <div class="card-header">
        <?php if(isset($user)) { ?>
            <h5>Welcome <?php echo "$user->name" ?></h5>
        <?php } else { ?>
            <h5>Welcome guest </h5>
            <?php } ?>
        
            
        </div>

        <div class="card-body">
            <?php if(isset($user)) { ?>
            <h5>This is only for logged in people</h5>
        <?php } else { ?>
            <h4>Please Login/Register to unlock all content</h4>
            <?php } ?>
        </div>

    </div>
</div>


<?php require('./inc/footer.html');?>


