<?php
include_once '../db/database.php';

class manageNewPassword extends Database{

    public function updatePassword($user, $password){
        $query = $this->connection()->prepare('UPDATE Researcher SET password=? WHERE user= ?');
        $query-> execute([$password, $user]);
    }
    public function searchUser($user){
        if (!empty($user)){
            $query = $this->connection()->prepare('SELECT * FROM Researcher where user= ?');
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