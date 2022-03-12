<?php 
    include_once 'sessions.php';
    $sessions= new Sessions();
    $sessions->goodbye();
    header('location:../index.php');
?>