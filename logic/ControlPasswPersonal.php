<?php
include_once '../db/database.php';

class controlpasswPersonal extends Database{

    public function updatePassword($user, $password){
        $query = $this->connection()->prepare('UPDATE funcionario SET contraseña=? WHERE email= ?');
        $query-> execute([$password, $user]);
    }
    public function searchUser($user){
        if (!empty($user)){
            $query = $this->connection()->prepare('SELECT * FROM funcionario where email= ?');
            $query ->execute([$user]);
            $registry = $query->fetch();
            if($query-> rowCount()){
               return $registry;
            }else{
               return false;
            }
        }

    }
}
?>