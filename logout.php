<?php 

session_start();
if(isset($_SESSION['userId'])) {
    session_destroy();
    header('Location:http://localhost//phploginsystem/index.php');
}

?>