<?php
    class Sessions{        
        public function __construct(){
            session_start();
        }
        public function updateSessionInfo($user,$userInfo){
            $_SESSION['User']= $user;
            $_SESSION['id']=$userInfo['id'];
            $_SESSION['rolUser']=$userInfo['rol'];
            $_SESSION['nameUser']=$userInfo['name'];
            $_SESSION['lastnameUser']=$userInfo['lastname'];
        }
        public function updateRol($rol){
            $_SESSION['rolUser']=$rol;
        }
        public function whoisuser(){
            return $_SESSION['nameUser'];
        }
        public function rolUser(){
            return $_SESSION['rolUser'];
        }
        public function whatisid(){
            return $_SESSION['id'];
        }
        public function goodbye(){
            session_unset();
            session_destroy();
        }
    }
?>