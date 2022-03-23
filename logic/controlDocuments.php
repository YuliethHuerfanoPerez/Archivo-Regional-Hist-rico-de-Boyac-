<?php

include_once '../db/database.php';


class controlDocuments extends Database{
    public function addDocs($name,$description,$date,$typedoc,$idUser,$files,$categoria){
        $targetRoute="../files/documents";
        $conn=$this->connection();
        $insertDoc= $conn->prepare('INSERT INTO documentos(nombre,descripcion,fecha,public,id_user,categoria,namefile) VALUES (?,?,?,?,?,?,?);');
        if(!file_exists($targetRoute)){
            mkdir($targetRoute,0777) or die("Imposible crear el directorio");
        }  
        if( $files["file"]["name"]){
            $filename=$files["file"]["name"];
            $openfolder=opendir($targetRoute);
            $filetocharge=$targetRoute.'/'.$files["file"]["name"];
            if(move_uploaded_file($files["file"]['tmp_name'],$filetocharge)){
                if($typedoc == "publico"){
                    $insertDoc-> execute([$name,$description,$date,1,$idUser,$categoria,$files["file"]["name"]]);
                }else{
                    $insertDoc-> execute([$name,$description,$date,0,$idUser,$categoria,$files["file"]["name"]]);
                }
                closedir($openfolder);
            }else{
                closedir($openfolder);
            }
            if ($insertDoc){
                return "Documento añadido exitosamente";
            }else{
                return "Fallo el cargue del documento";
            } 
        }else{
            return "Fallo el cargue del documento";
        }   
    }
    public function getalldocuments(){
        $conn=$this->connection();
        $allDocs=$conn->prepare('SELECT * from documentos Order By idDoc desc;');
        $allDocs->execute();
        if ($allDocs->rowCount()){
            return $allDocs->fetchAll();
        }else{
            return false;
        }
    }
    public function getprivatedocuments(){
        $conn=$this->connection();
        $privateDocs=$conn->prepare('SELECT * from documentos Where public=0 Order By idDoc desc;');
        $privateDocs->execute();
        if ($privateDocs->rowCount()){
            return $privateDocs->fetchAll();
        }else{
            return false;
        }
    }
    public function getpublicdocuments(){
        $conn=$this->connection();
        $publicDocs=$conn->prepare('SELECT * from documentos Where public=1 Order By idDoc desc;');
        $publicDocs->execute();
        if ($publicDocs->rowCount()){
            return $publicDocs->fetchAll();
        }else{
            return false;
        }
    }
    public function deleteDoc($idDoc){
        $conn=$this->connection();
        $deleteDoc= $conn->prepare('DELETE FROM documentos where idDoc= ?');
        $namefile=$conn->prepare('SELECT namefile FROM documentos where idDoc= ?');
        $namefile -> execute([$idDoc]);
        $data = $namefile->fetchAll();
        $name = $data[0]['namefile'];
        if(file_exists("../files/documents/". $name)){
            unlink("../files/documents/". $name);
        }
        $deleteDoc -> execute([$idDoc]);
        if($deleteDoc){
            return "Eliminacion completada";
        }else{
            return "No se puede eliminar el archivo";  
        }
    }
    public function searchNewId($idDoc){
        if (!empty($idDoc)){
            $query1 = $this->connection()->prepare('SELECT * FROM documentos where idDoc= ?');
            $query1 ->execute([$idDoc]);
            if($query1-> rowCount()){
                return $query1->fetchAll();
            }else{
              return false;
            }
        }
    }
    public function updateDoc($id,$namedoc,$description,$date,$typedoc,$idUser,$file,$categoria){
        $conn = $this->connection();
        $targetRoute="../files/documents";
        $query1Update= $conn->prepare('UPDATE documentos SET nombre= ?, descripcion= ?,fecha= ?, public=?,id_user= ?,categoria=?, namefile=? WHERE idDoc= ?');
        $namefile=$conn->prepare('SELECT namefile FROM documentos where idDoc= ?');
        $namefile -> execute([$id]);
        $data = $namefile->fetchAll();
        $name = $data[0]['namefile'];
        if(file_exists("../files/documents/". $name)){
            unlink("../files/documents/". $name);
            
        }
        if( $file["file"]["name"]){
            $filename=$file["file"]["name"];
            $openfolder=opendir($targetRoute);
            $filetocharge=$targetRoute.'/'.$filename;
            if(move_uploaded_file($file["file"]['tmp_name'],$filetocharge)){
                if($typedoc == "publico"){
                    $query1Update-> execute([$namedoc,$description,$date,1,$idUser,$categoria,$filename,$id]);
                }else{
                    $query1Update-> execute([$namedoc,$description,$date,0,$idUser,$categoria,$filename,$id]);
                }
                closedir($openfolder);
            }else{
                closedir($openfolder);
            }
            if ($query1Update){
                return "Documento actualizado exitosamente";
            }else{
                return "Fallo la actualizacion del documento";
            } 
        }else{
            return "Fallo la actualizacion del documento";
        }
    }
    public function getpublicdocumentsByCategory($category){
        $conn=$this->connection();
        $allDocs=$conn->prepare('SELECT * from documentos where categoria = ? and public=1 Order By idDoc desc;');
        $allDocs->execute([$category]);
        if ($allDocs->rowCount()){
            return $allDocs->fetchAll();
        }else{
            return false;
        }
    }
    public function getpublicdocumentsByNameAndCategory($name,$category){
        $conn=$this->connection();
        $allDocs=$conn->prepare('SELECT * from documentos where categoria = ? and nombre=? and public=1 Order By idDoc desc;');
        $allDocs->execute([$category,$name]);
        if ($allDocs->rowCount()){
            return $allDocs->fetchAll();
        }else{
            return false;
        }
    }
    public function getpublicdocumentsByName($name){
        $conn=$this->connection();
        $allDocs=$conn->prepare('SELECT * from documentos where nombre = ? and public=1 Order By idDoc desc;');
        $allDocs->execute([$name]);
        if ($allDocs->rowCount()){
            return $allDocs->fetchAll();
        }else{
            return false;
        }
    }



    public function getpublicdocumentsByCategoryprivate($category){
        $conn=$this->connection();
        $allDocs=$conn->prepare('SELECT * from documentos where categoria = ? and Order By idDoc desc;');
        $allDocs->execute([$category]);
        if ($allDocs->rowCount()){
            return $allDocs->fetchAll();
        }else{
            return false;
        }
    }
    public function getpublicdocumentsByNameAndCategoryprivate($name,$category){
        $conn=$this->connection();
        $allDocs=$conn->prepare('SELECT * from documentos where categoria = ? and nombre=?  Order By idDoc desc;');
        $allDocs->execute([$category,$name]);
        if ($allDocs->rowCount()){
            return $allDocs->fetchAll();
        }else{
            return false;
        }
    }
    public function getpublicdocumentsByNameprivate($name){
        $conn=$this->connection();
        $allDocs=$conn->prepare('SELECT * from documentos where nombre = ? Order By idDoc desc;');
        $allDocs->execute([$name]);
        if ($allDocs->rowCount()){
            return $allDocs->fetchAll();
        }else{
            return false;
        }
    }


}
?>