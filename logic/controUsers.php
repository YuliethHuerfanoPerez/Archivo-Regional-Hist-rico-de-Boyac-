<?php
    include_once '../db/database.php';
    class ControllUsers extends Database{

        public function validateCredentials($user,$textPass){
            $password= md5($textPass);
            $query = $this->connection()->prepare('SELECT * FROM funcionario');
            $query->execute();
            foreach($query as $i){
                if ($i['email'] == $user && $i['contraseña']==$password){
                    return true;
                }
            }
            return false;
            
        }
        public function getuserInfor($user){
            $query = $this->connection()->prepare('SELECT * FROM funcionario where email= :user');
            $query->execute(['user'=> $user]);
            if($query->rowCount()){
                foreach($query as $i){
                    return array("name"=>$i['nombre'],"lastname"=>$i['apellido'], "rol"=>$i['cargo']);
                }
            }else{
                return false;
            }
            
        }
    }


?>