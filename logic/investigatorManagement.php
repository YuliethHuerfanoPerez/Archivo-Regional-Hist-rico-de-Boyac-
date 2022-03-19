<?php

include_once '../db/database.php';

class investigatorManagement extends Database{

    public function addResearcher ($id, $name, $lastName, $email, $password, $phone){
        $query= $this->connection()->prepare('INSERT INTO Researcher(id,nameResearcher,lastNameResearcher,user,password,celular) VALUES (?,?,?,?,?,?)');
        $query-> execute([$id, $name, $lastName, $email, $password, $phone]);
        if($query){
            return 'El investigador se ha agregado con éxtito';
        }else{
            return 'No se ha podido agregar al investigador, intentelo de nuevo';
        }
    }
    public function showResearcher(){
        $query = $this->connection()->prepare('SELECT * FROM Researcher');
        $query ->execute();
        if($query-> rowCount()){
                return $query->fetchAll();
        }else{
            return false;
        }
    }

    public function deleteResearcher($id){
        $query= $this->connection()->prepare('DELETE FROM Researcher where id= ?');
        $query -> execute([$id]);
        if($query){
            return 'Investigador eliminado';
        }else{
            return 'No fue posible eliminar al investigador';
        }
    }
    public function searchNewId($id){
        if (!empty($id)){
            $query = $this->connection()->prepare('SELECT * FROM Researcher where id= ?');
            $query ->execute([$id]);
            if($query-> rowCount()){
                return $query->fetchAll();
            }else{
              return false;
            }
        }

    }
    public function searchById($id){
        if (!empty($id)){
            $query = $this->connection()->prepare('SELECT * FROM Researcher where id= ?');
            $query ->execute([$id]);
            $registry = $query->fetch();
            if($query-> rowCount()){
               return $registry;
            }else{
               return false;
            }
        }

    }
    public function uptadeResearcher($id, $name, $lastName, $email, $password, $phone){
        $query = $this->connection()->prepare('UPDATE Researcher SET nameResearcher=?,lastNameResearcher=?,user=?,password=?,celular=? WHERE id= ?');
        $query-> execute([$name, $lastName, $email, $password, $phone, $id]);
    }

}
?>