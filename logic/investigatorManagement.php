<?php

include_once '../db/database.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\composer\vendor\autoload.php';

class investigatorManagement extends Database{

    public function generatePassword(){
        $caracteres='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $longpalabra=8;
        for($pass='', $n=strlen($caracteres)-1; strlen($pass) < $longpalabra ; ) {
        $x = rand(0,$n);
        $pass.= $caracteres[$x];
        }
        return $pass;
    }
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

    function sendMail($direccionenvio, $nombreenvio, $direccionrespuesta, $nombrerespuesta, $texto, $texto2){
        /*Esta funcion para que funcione, requiere tener instalado en el servidor php la clase phpmailer para que funcione correctamente*/
        $mail=new PHPMailer(true);
        $mail->IsSMTP(); 
        $mail->IsHTML(true);
        $mail->SMTPAuth = true; // requiere usuario y contraseña
        $mail->SMTPSecure = ""; // tipo de seguridad
        $mail->Host = "smtp.gmail.com"; // servidor smtp de envio de correo
        $mail->Port = 25; // puerto de salida
        $mail->Username = "yulieth.huerfano@uptc.edu.co"; // usuario
        $mail->Password = "CristinaHuerfano072501"; // contraseña
        $mail->From = "yulieth.huerfano@uptc.edu.co"; // direccion de quien envia
        $mail->FromName = "Archivo Historico Regional de Boyaca"; //nombre del emisor
        $mail->Subject = "Confirmacion de creacion de cuenta de investigador"; //asunto
        $mail->Body = $texto; //mensaje
        $mail->Altbody = $texto2; //mensaje si no se puede leer como html
        $mail->WordWrap = 50; 
        $mail->AddAddress($direccionenvio, $nombreenvio); // a quien se envia
        $mail->AddReplyTo($direccionrespuesta, $nombrerespuesta); //respuesta
        if(!$mail->Send()) 
        {
        echo "Error en el envio: " . $mail->ErrorInfo;
        } else {
        //echo "<P>Mensaje enviado correctamente</P>";
        }
    }

}
?>