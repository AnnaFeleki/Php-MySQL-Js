<?php

$host = 'localhost';
$user = 'root';
$password = '';
$dbname='login-project';

//set dsn -database source name
$dsn = 'mysql:host=' . $host . '; dbname='. $dbname;

try {

    //create pdo instance
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   

}catch (PDOException $e) {
    echo "connection failed!" . $e->getMessage();

}

?>
