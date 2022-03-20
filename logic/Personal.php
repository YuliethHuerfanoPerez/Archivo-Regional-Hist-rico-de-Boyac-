<?php
    include_once '../db/database.php';
    class Personal extends Database{
      
        function addUsuario(){
          $stringCargo = $_POST['cargo'];
          $cargo = (int)$stringCargo;
            $sql = "INSERT INTO funcionario (cedula, nombre, apellido, celular, email, nombreUsuario, contraseña, cargo) 
            VALUES (:cedula, :nombre, :apellido, :celular, :email, :nombreUsuario, :contrasena, :cargo)";
            $stmt = $this->connection()->prepare($sql);
            $stmt->bindParam(':cedula', $_POST['cedula']);
            $stmt->bindParam(':nombre', $_POST['nombre']);
            $stmt->bindParam(':apellido', $_POST['apellido']);
            $stmt->bindParam(':celular', $_POST['celular']);
            $stmt->bindParam(':email', $_POST['email']);
            $stmt->bindParam(':nombreUsuario', $_POST['nombreUsuario']);
            $stmt->bindParam(':contrasena', $_POST['contrasena']);
            $stmt->bindParam(':cargo', $cargo);
            if ($stmt->execute()) {
              echo '<script> alert("Creado Satisfactoriamente!");</script>';
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
                  echo '<td>'.$mostrar['nombreUsuario'].'</td>';
                  echo '<td>'.$mostrar['contraseña'].'</td>';
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
                $consulta = $this->connection()->query("DELETE FROM funcionario WHERE cedula =".$cedula);
                return true;                    
              }else{
                return false;
              }
          }
          function modifyUsuario($nombre,$apellido,$celular,$email,$nombreUsuario,$contrasena,$cargo,$cedula){
            $consulta = "UPDATE funcionario SET nombre = '$nombre', apellido = '$apellido', celular = '$celular', email = '$email', nombreUsuario = '$nombreUsuario', contraseña = '$contrasena', cargo ='$cargo'
                              WHERE cedula = '$cedula'";
            $stmt = $this->connection()->query($consulta);
            
          }
          
                
    }

?>