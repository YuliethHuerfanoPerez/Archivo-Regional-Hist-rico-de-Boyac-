<?php

include_once '../db/database.php';


class controlNews extends Database{


    
    public function addNews ($name, $description, $content, $autorname, $autorlastname, $date, $idUser,$files){
        $query1= $this->connection()->prepare('SELECT idAutor FROM autor WHERE nombre = ? and apellido=?;');
        $query1 ->execute([$autorname,$autorlastname]);
        if (!$query1->rowCount()){
            $query2 = $this->connection()->prepare('INSERT INTO autor (nombre,apellido) VALUES (?,?);');
            $query2 -> execute([$autorname, $autorlastname]);
        }
        $queryautor= $this->connection()->prepare('SELECT idAutor FROM autor WHERE nombre = ? and apellido=?;');
        $queryautor ->execute([$autorname,$autorlastname]);
        if($queryautor->rowCount()){
            foreach($queryautor as $i){
                $autor= $i['idAutor'];
            } 
        }
        $query3= $this->connection()->prepare('INSERT INTO noticias(nombre,descripcion,contenido,fecha,idAutor,idUsuario) VALUES (?,?,?,?,?,?);');
        $query3-> execute([$name,$description,$content,$date,$autor,$idUser]);
        if($query3){
            $out="";
            $conne=$this->connection();
            $QueryId=$conne->prepare('SELECT MAX(idNoticias) as id FROM noticias;');
            $QueryId->execute();
            $data=$QueryId->fetchAll();
            $QueryInsertpic=$conne->prepare('INSERT INTO pictures (IdNot,sourcename) VALUES (?,?);');
            $idNot= $data[0]["id"];
            $target="../files/pictures";
            foreach($files["files"]['tmp_name'] as $key => $tmp_name){
            if( $files["files"]["name"][$key]){
                if(!file_exists($target)){
                   mkdir($target,0777) or die("Imposible crear el directorio");
                }    
                $openfolder=opendir($target);
                $filetocharge=$target.'/'.$files["files"]["name"][$key];
                if(move_uploaded_file($files["files"]['tmp_name'][$key],$filetocharge)){
                    $QueryInsertpic -> execute([$idNot, $files["files"]["name"][$key]]);
                    closedir($openfolder);
                    $out='Noticia añadida';
                }else{
                    closedir($openfolder);
                    $out ='Noticia añadida, problema al cargar archivos';
                }
                
            }
        }         
        return $out;
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
            return $query1->fetchAll();
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
    public function getpictures($idN){
        $query1 = $this->connection()->prepare('SELECT sourcename from pictures where IdNot = ?');
        $query1-> execute([$idN]);
        if($query1-> rowCount()){
            return $query1->fetchAll();
        }else{
          return false;
        }
    }
    public function deleteNew($idNews){
        $conn=$this->connection();
        $query1= $conn->prepare('DELETE FROM noticias where idNoticias= ?');
        $query1 -> execute([$idNews]);
        $delete= $this->deletefiles($idNews);
        if($query1 && $delete){
            return 'eliminado';
        }else{
            return 'No fue posible eliminar la noticia';
        }
    }
    public function deletefiles($idnews){
        $pictures= $this->getpictures($idnews);
        if ($pictures){
            $conn=$this->connection();
            foreach($pictures as $pic){
                if(file_exists("../files/pictures/". $pic['sourcename'])){
                    unlink("../files/pictures/". $pic['sourcename']);
                }
            }
            $deleteFiles=$conn->prepare('DELETE FROM pictures where IdNot= ?');
            $deleteFiles->execute([$idnews]);
            if ($deleteFiles){
                return TRUE;
            }else{
                return FALSE;
            }
        }else{
            return TRUE;
        }

        
    }
    public function uptadeNew($idnew,$name, $description, $content, $date,$idUser,$files){
        $this->deletefiles($idnew);
        $conn = $this->connection();
        $query1= $conn->prepare('UPDATE noticias SET nombre= ?, descripcion= ?,contenido= ?,fecha= ?,idUsuario= ? WHERE idNoticias= ?');
        $query1-> execute([$name,$description,$content,$date,$idUser,$idnew]);
        $QueryInsertpic=$conn->prepare('INSERT INTO pictures (IdNot,sourcename) VALUES (?,?);');
        $target="../files/pictures";
            foreach($files["files"]['tmp_name'] as $key => $tmp_name){
            if( $files["files"]["name"][$key]){
                if(!file_exists($target)){
                   mkdir($target,0777) or die("Imposible crear el directorio");
                }    
                $openfolder=opendir($target);
                $filetocharge=$target.'/'.$files["files"]["name"][$key];
                if(move_uploaded_file($files["files"]['tmp_name'][$key],$filetocharge)){
                    $QueryInsertpic -> execute([$idnew, $files["files"]["name"][$key]]);
                    closedir($openfolder);
                    
                }else{
                    closedir($openfolder);
                }
                
            }
            }
    }
    
}
?>