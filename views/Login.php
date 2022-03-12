<?php
    include '../logic/controUsers.php';
    include '../logic/sessions.php';
    $controllusers = new ControllUsers();
    $controllsessions = new Sessions();

    #$controllsessions->goodbye();
    if (isset($_SESSION['rolUser'])){
        if($_SESSION['rolUser'] == "101"){
            include_once 'admin-workers.php';
        }else if($_SESSION['rolUser'] == "102"){
            include_once 'admin-news.php';
        }else if($_SESSION['rolUser'] == "103"){
            include_once 'admin-workers.php';
        }     
    }else if(isset($_POST['user']) && isset($_POST['password'])){
        $user=$_POST['user'];
        $pass=$_POST['password'];
       if($controllusers->validateCredentials($user,$pass)){
            $response = "Credenciales validad, Bienvend@";
            $userInfo=$controllusers->getuserInfor($user);
            $controllsessions->updateSessionInfo($user,$userInfo);
            if (isset($_SESSION['rolUser'])){
                if($_SESSION['rolUser'] == "101"){
                    include_once 'admin-workers.php';
                }else if($_SESSION['rolUser'] == "102"){
                    include_once 'admin-news.php';
                }else{
                    include_once 'admin-workers.php';
                }     
            }else{
              include_once 'Loginv.php';  
            }
       }else{
            include_once 'Loginv.php';
            $response = "Credenciales invalidas, Por favor intentalo nuevamente";
       }    
    }else{
        include_once 'loginv.php';
    }
?>