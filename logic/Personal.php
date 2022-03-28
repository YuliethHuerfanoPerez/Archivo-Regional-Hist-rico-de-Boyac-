<?php
    include_once '../db/database.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'C:\xampp\composer\vendor\autoload.php';
    class Personal extends Database{

      function claveAleatoria(){
        $caracteres='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $longpalabra=8;
        for($pass='', $n=strlen($caracteres)-1; strlen($pass) < $longpalabra ; ) {
        $x = rand(0,$n);
        $pass.= $caracteres[$x];
        }
        return $pass;
      }

        function addUsuario(){
          $aleatoria = $this->claveAleatoria();
          $stringCargo = $_POST['cargo'];
          $cargo = (int)$stringCargo;
          $contrasena = md5($aleatoria);
            $sql = "INSERT INTO funcionario (cedula, nombre, apellido, celular, email, nombreUsuario, contraseña, cargo) 
            VALUES (:cedula, :nombre, :apellido, :celular, :email, :nombreUsuario, :contrasena, :cargo)";
            $stmt = $this->connection()->prepare($sql);
            $stmt->bindParam(':cedula', $_POST['cedula']);
            $stmt->bindParam(':nombre', $_POST['nombre']);
            $stmt->bindParam(':apellido', $_POST['apellido']);
            $stmt->bindParam(':celular', $_POST['celular']);
            $stmt->bindParam(':email', $_POST['email']);
            $stmt->bindParam(':nombreUsuario', $_POST['nombre']);
            $stmt->bindParam(':contrasena', $contrasena);
            $stmt->bindParam(':cargo', $cargo);
            if ($stmt->execute()) {
              echo '<script> alert("Creado Satisfactoriamente! '.$aleatoria.'");</script>';
              
            } else {
                echo '<script> alert("No se pudo crear el Usuario, \nRevise que no se repita cedula con otro usuario!"); </script>';
            }
        }


        function getUsuario(){
            $cedula = $_POST['cedula'];
            if(!empty($cedula)){
              $consulta = $this->connection()->query("SELECT * FROM funcionario WHERE cedula=".$cedula);
              return true;
            }else{
              return false;
            }
        }

        function confirmarUsuario($cedula){
          if(!empty($cedula)){
            $consulta = $this->connection()->query("SELECT * FROM funcionario WHERE cedula=".$cedula);
            return $consulta;
          }
        }

        
        
        function getUsuarios(){
          $cedula = $_POST['cedula'];
          if(!empty($cedula)){
            $consulta = $this->connection()->query("SELECT * FROM funcionario WHERE cedula=".$cedula);
            foreach($consulta as $mostrar){
              echo '<td>'.$mostrar['cedula'].'</td>';
              echo '<td>'.$mostrar['nombre'].'</td>';
              echo '<td>'.$mostrar['apellido'].'</td>';
              echo '<td>'.$mostrar['celular'].'</td>';
              echo '<td>'.$mostrar['email'].'</td>';
              if($mostrar['cargo'] == '101'){
                echo '<td> Administrador </td>';
              }else{
                echo '<td> Funcionario </td>';
              }
            }
          }else{
            echo '<div class="alert" role="alert" style="background-color: #1EA078;">
            <h5 style="color: white;">No ingreso la cedula para Usuario!</h5>
            </div><br>';
          }
          
        }

        function viewUsuarios(){
          $consulta = $this->connection()->query("SELECT cedula, nombre, cargo
          FROM funcionario");
          foreach($consulta as $mostrar){
            echo '<tr><td>'.$mostrar['cedula'].'</td>';
            echo '<td>'.$mostrar['nombre'].'</td>';
            if($mostrar['cargo'] == '101'){
              echo '<td> Administrador </td>';
            }else{
              echo '<td> Funcionario </td>';
            }
                
          }
        }

        function deleteUsuario(){
          if($this->getUsuario()==true){
            $cedula = $_POST['cedula'];
            $this->connection()->query("DELETE FROM funcionario WHERE cedula =".$cedula);
            return true;
          }else{
            return false;
          }
        }
        
        function modifyUsuario($nombre,$apellido,$celular,$email,$cargo,$cedula){
          $consulta = "UPDATE funcionario SET nombre = '$nombre', apellido = '$apellido', celular = '$celular', email = '$email', cargo ='$cargo'
          WHERE cedula = '$cedula'";
          $this->connection()->query($consulta);
        }
        
        function sendMail($direccionenvio, $nombre, $direccionrespuesta, $nombrerespuesta, $texto, $texto2){
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
          $mail->AddAddress($direccionenvio, $nombre); // a quien se envia
          $mail->AddReplyTo($direccionrespuesta, $nombrerespuesta); //respuesta
          if(!$mail->Send()) 
          {
          echo "Error en el envio: " . $mail->ErrorInfo;
          } else {
          echo "<P>Mensaje enviado correctamente</P>";
          }
      }
                
    }

?>