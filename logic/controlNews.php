<?php

include_once '../db/database.php';
include_once '../logic/controlAutor.php';
$autor = new controlAutor();

class controlNews extends Database{


    
    public function addNews ($name, $description, $content, $autorname, $autorlastname, $date, $idUser){
       
        $query1= $this->connection()->prepare('SELECT idAutor FROM autor WHERE nombre = ? and apellido=?;');
        $query1 ->execute([$autorname,$autorlastname]);
        if (!$query1->rowCount()){
            $query2 = $this->connection()->prepare('INSERT INTO autor (nombre,apellido) VALUES (?,?)');
            $query2 -> execute([$autorname, $autorlastname]);
        }
        $queryautor= $this->connection()->prepare('SELECT idAutor FROM autor WHERE nombre = ? and apellido=?');
        $queryautor ->execute([$autorname,$autorlastname]);
        if($queryautor->rowCount()){
            foreach($queryautor as $i){
                $autor= $i['idAutor'];
            } 
        }
        $query3= $this->connection()->prepare('INSERT INTO noticias(nombre,descripcion,contenido,fecha,idAutor,idUsuario) VALUES (?,?,?,?,?,?)');
        $query3-> execute([$name,$description,$content,$date,$autor,$idUser]);
        if($query3){
            return 'Noticia añadida';
        }else{
            return 'No fue posible añadir la noticia';
        }
    }
    public function addAutor($name,$lastname){
        $query1= $this->connection()->prepare('SELECT idAutor FROM autor WHERE nombre = ? and apellido=?;');
        $query1 ->execute([$autorname,$autorlastname]);
        if (!$query1->rowCount()){
            $query2 = $this->connection()->prepare('INSERT INTO autor (nombre,apellido) VALUES (?,?)');
            $query2 -> execute([$autorname, $autorlastname]);
        }
        foreach($queryautor as $i){
            return $i['idAutor'];
        } 
    }
    public function searchNews(){
        $query1 = $this->connection()->prepare('SELECT * FROM noticias');
        $query1 ->execute();
        if($query1-> rowCount()){
            foreach($query1 as $i){
                return $query1->fetchAll();
            }
        }else{
            return false;
        }
    }
    public function searchNewId($idNews){
        if (!empty($idNews)){
            $query1 = $this->connection()->prepare('SELECT * FROM noticias where idNoticias= ?');
            $query1 ->execute([$idNews]);
            if($query1-> rowCount()){
                return $query1->fetchAll();
            }else{
              return false;
            }
        }

    }
    
    public function deleteNew($idNews){
        $query1= $this->connection()->prepare('DELETE FROM noticias where idNoticias= ?');
        $query1 -> execute([$idNews]);
        if($query1){
            return 'eliminado';
        }else{
            return 'No fue posible eliminar la noticia';
        }
    }
    public function uptadeNew($idnew,$name, $description, $content, $date,$idUser){
        $query1 = $this->connection()->prepare('UPDATE noticias SET nombre= ?, descripcion= ?,contenido= ?,fecha= ?,idUsuario= ? WHERE idNoticias= ?');
        $query1-> execute([$name,$description,$content,$date,$idUser,$idnew]);
    }
}
?>