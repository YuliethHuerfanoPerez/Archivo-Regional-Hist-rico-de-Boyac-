<?php
    include_once '../db/database.php';

    //use PHPMailer\PHPMailer\PHPMailer;
    //use PHPMailer\PHPMailer\Exception;
    //require 'C:\xampp\composer\vendor\autoload.php';
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
            $this->sendCorreo($aleatoria);
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
        
        function sendCorreo($contrasena){
          /*Esta funcion para que funcione, requiere tener instalado en el servidor php la clase phpmailer para que funcione correctamente*/
          

          $destino=$_POST['email'];
          //$typeDoc=$_POST['typeDoc'];
          $cedula=$_POST['cedula'];
          $nombre=$_POST['nombre'];
          $apellido=$_POST['apellido'];
          $celular=$_POST['celular'];
          $correo=$_POST['email'];
          //$contraseña=$_POST['password'];
          $type=$_POST['cargo'];
      
          $cuerpo = '
          
          <!DOCTYPE html>
          <html>
          <head>
           <title> Confirmacion cuenta AHRB '.$nombre.' '.$apellido.'</title>
           <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
           <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>  
             </head>
          <body>
          <h1>Su cuenta para el archivo historico regional se Boyacá se ha creado exitosamente</h1>
          <p>Para poder acceder por medio de la pagina web use las siguientes credenciales:</p>
          <p>Correo: '.$correo.'</p>
          <p>Contraseña: '.$contrasena.'</p>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
          </html>';
      
          //para el envío en formato HTML
          $headers  = "MIME-Version: 1.0\r\n";
          $headers .= "Content-type: text/html; charset=UTF-8\r\n";
      
          //dirección del remitente
          $headers .= "From: ".$_POST['nombre']." <"."jhonaparicio2000@hotmail.com".">\r\n";
      
          //Una Dirección de respuesta, si queremos que sea distinta que la del remitente
          $headers .= "Reply-To: "."jhonaparicio2000@hotmail.com"."\r\n";
      
          mail($destino,"Solicitud archivo historico regional",$cuerpo,$headers);
          header("Location:../views/admin-workers.php");
          
      }
                
    }

?>