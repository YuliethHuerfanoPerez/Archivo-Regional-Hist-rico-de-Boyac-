<?php
    include ('../db/database.php');

    $user = $_POST['user']; 
    $pass = $_POST['password'];
    #$query = $this->connection()->prepare('SELECT * FROM funcionario');
    #$query->execute();

    echo "hola". $user , md5($pass);
    #echo $query->rowCount();
?>