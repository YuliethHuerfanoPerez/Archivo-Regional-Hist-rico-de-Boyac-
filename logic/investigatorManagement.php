<?php

include_once '../db/database.php';

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
        $cargo = 103;
        $query= $this->connection()->prepare('INSERT INTO funcionario(cedula,nombre,apellido,celular,email,nombreUsuario, contraseña, cargo) VALUES (?,?,?,?,?,?,?,?)');
        $query-> execute([$id, $name, $lastName, $phone, $email, $email, $password, $cargo]);
        if($query){
            return 'El investigador se ha agregado con éxtito';
        }else{
            return 'No se ha podido agregar al investigador, intentelo de nuevo';
        }
    }
    public function showResearcher(){
        $query = $this->connection()->prepare('SELECT * FROM funcionario where cargo=103');
        $query ->execute();
        if($query-> rowCount()){
                return $query->fetchAll();
        }else{
            return false;
        }
    }

    public function deleteResearcher($id){
        $query= $this->connection()->prepare('DELETE FROM funcionario where cedula= ?');
        $query -> execute([$id]);
        if($query){
            return 'Investigador eliminado';
        }else{
            return 'No fue posible eliminar al investigador';
        }
    }
    public function searchNewId($id){
        if (!empty($id)){
            $query = $this->connection()->prepare('SELECT * FROM funcionario where cedula= ?');
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
            $query = $this->connection()->prepare('SELECT * FROM funcionario where cedula= ?');
            $query ->execute([$id]);
            $registry = $query->fetch();
            if($query-> rowCount()){
               return $registry;
            }else{
               return false;
            }
        }

    }
    public function searchByUser($user){
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
    public function uptadeResearcher($id, $name, $lastName, $email, $password, $phone){
        $query = $this->connection()->prepare('UPDATE funcionario SET nombre=?,apellido=?,email=?,contraseña=?,celular=? WHERE cedula= ?');
        $query-> execute([$name, $lastName, $email, $password, $phone, $id]);
    }

    function sendMail($contrasena,$direccion,$name){
        /*Esta funcion para que funcione, requiere tener instalado en el servidor php la clase phpmailer para que funcione correctamente*/
        $destino=$direccion;
    
        $cuerpo = '
        
        <!DOCTYPE html>
        <html>
        <head>
         <title> Confirmación cuenta</title>
         <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>  
           </head>
           <body>
           <h1>Su cuenta para el archivo historico regional se Boyacá se ha creado exitosamente</h1>
           <p>Para poder acceder por medio de la pagina web use las siguientes credenciales:</p>
           <p>Correo: '.$direccion.'</p>
           <p>Contraseña: '.$contrasena.'</p>
           <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
           </html>';
    
        //para el envío en formato HTML
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    
        //dirección del remitente
        $headers .= "From: ".$name." <"."jhonaparicio2000@hotmail.com".">\r\n";
    
        //Una Dirección de respuesta, si queremos que sea distinta que la del remitente
        $headers .= "Reply-To: "."jhonaparicio2000@hotmail.com"."\r\n";
    
        mail($destino,"Solicitud archivo historico regional",$cuerpo,$headers);

        //$mail->SMTPDebug = true;
        //if(!$mail->Send()) 
        //{
        //echo "Error en el envio: " . $mail->ErrorInfo;
        //} else {
        //echo "<P>Mensaje enviado correctamente</P>";
        //}
    }

}
?>