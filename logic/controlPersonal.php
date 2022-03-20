<?php

    include_once '../logic/Personal.php';
    $personal = new Personal();
    if(isset($_POST['add'])){
      $personal->addUsuario();
      header("location:../views/admin-workers.php");
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Confirmacion</title>
        <!-- =============== Bootstrap Core CSS =============== -->
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css" type="text/css">
        <!-- =============== fonts awesome =============== -->
        <link rel="stylesheet" href="../assets/font/css/font-awesome.min.css" type="text/css">
        <!-- =============== Plugin CSS =============== -->
        <link rel="stylesheet" href="../assets/css/animate.min.css" type="text/css">
        <!-- =============== Custom CSS =============== -->
        <link rel="stylesheet" href="../assets/css/style.css" type="text/css">
        <!-- =============== Owl Carousel Assets =============== -->
        <link href="../assets/owl-carousel/owl.carousel.css" rel="stylesheet">
        <link href="../assets/owl-carousel/owl.theme.css" rel="stylesheet">
        
        <link rel="stylesheet" href="../assets/css/isotope-docs.css" media="screen">
        <link rel="stylesheet" href="../assets/css/baguetteBox.css">
    </head>
    
    <body>
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="container-fluid">
                <br>
                        <a class="page-scroll" href="../views/admin-workers.php">
                            <img src="../assets/img/regresar.png" alt="" srcset="" width="5%">
                        </a>
            </div>
            <h4>Regresar</h4>
        </div>
    </nav> 
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="container">
      <?php
      if(isset($_POST['search'])){
        ?>
    <table class="table">
        <thead class="table-secondary" style="background-color: #1EA078;">
          <tr>
            <th scope="col">Cedula</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Celular</th>
            <th scope="col">Correo</th>
            <th scope="col">Nombre Usuario</th>
            <th scope="col">Contraseña</th>
            <th scope="col">Cargo</th>
          </tr>
        </thead>
        <tbody>
        <tr>
            <?php
              $personal->getUsuarios();
            } 
            ?>
            </td>
          </tr>
          <tr>
            <?php
            if(isset($_POST['delete'])){
              $cedula = $_POST['cedula'];
              ?>
          <table class="table">
        <thead class="table-secondary" style="background-color: #1EA078;">
          <tr>
            <th scope="col">Cedula</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Celular</th>
            <th scope="col">Correo</th>
            <th scope="col">Nombre Usuario</th>
            <th scope="col">Contraseña</th>
            <th scope="col">Cargo</th>
          </tr>
        </thead>
        <tbody>
          <?php
                
                if(!empty($cedula)){
                  $personal->getUsuarios();
                  $personal->deleteUsuario();
                  echo '<div class="alert" role="alert" style="background-color: #1EA078;">
                    <h5 style="color: white;">Usuario Eliminado!</h5>
                  </div><br>'; 
                }else{
                  echo '<div class="alert" role="alert" style="background-color: #1EA078;">
                    <h5 style="color: white;">No se encontro cedula del usuario!</h5>
                  </div><br>';
                }        
            }
            ?>
          </tr>
          <?php
              
          ?>
        </tbody>
      </table>
      <?php
      if(isset($_POST['actualizar'])){
              $cedula = $_POST['cedula'];
              if($personal->confirmarUsuario($cedula)){
                $array = $personal->confirmarUsuario($cedula);
                foreach($array as $mostrar){
      ?>
      <div class="col-sm-6 wow fadeInUp animated" data-wow-delay=".2s">
                        <div class="titleadmin"> 
                            <h2>ACTUALIZAR</h2>
                        </div>
                        <div class="col-xs-12 wow bounceIn animated" data-wow-delay=".1s">
                            <form action="controlPersonal.php" method="post">
                                <div class="ajax-hidden">
                                    <div class="col-xs-12 form-group wow fadeInUp animated">
                                        <input type="hidden" name="cedula" class="form-control" id="cedula" value="<?php echo $mostrar['cedula'];?>">
                                    </div>
            
                                    <div data-wow-delay=".1s" class="col-xs-12 form-group wow fadeInUp animated">
                                        <input type="text" placeholder="Nombre" name="nombre" class="form-control" value="<?php echo $mostrar['nombre'];?>">
                                    </div>
                                    <div class="col-xs-12 form-group wow fadeInUp animated">
                                        <input type="text" placeholder="Apellido" name="apellido" class="form-control" value="<?php echo $mostrar['apellido'];?>">
                                    </div>
                                    <div class="col-xs-12 form-group wow fadeInUp animated">
                                        <input type="number" placeholder="Celular" name="celular" class="form-control" id="celular" value="<?php echo $mostrar['celular'];?>">
                                    </div>
                                    <div class="col-xs-12 form-group wow fadeInUp animated">
                                        <input type="text" placeholder="Corrreo@electronico.com" name="email" class="form-control" value="<?php echo $mostrar['email'];?>">
                                    </div>
                                    <div class="col-xs-12 form-group wow fadeInUp animated">
                                        <input type="text" placeholder="Nombre Usuario" name="nombreUsuario" class="form-control"  value="<?php echo $mostrar['nombreUsuario'];?>">
                                    </div>
                                    <div class="col-xs-12 form-group wow fadeInUp animated">
                                        <input type="text" placeholder="Contraseña" name="contrasena" class="form-control"value="<?php echo $mostrar['contraseña'];?>">
                                    </div>
                                    <div class="col-xs-12 form-group wow fadeInUp animated">
                                        
                                        <select name="cargo" id="">
                                            <option selected>
                                            <?php 
                                              if($mostrar['cargo'] == '101'){
                                                echo 'Administrador';
                                              }else{
                                                echo 'Funcionario';
                                              }
                                              ?>
                                            </option>
                                            <option value='101'>Administrador</option>
                                            <option value='102'>Funcionario</option>
                                        </select>
                                    </div>
                                    <input data-wow-delay=".3s" class="btn btn-sm btn-block wow fadeInUp animated" value="Actualizar" name="modificar" type="submit" style="background-color: #1EA078; color: white;">
                                </div>
                            </form>
                        </div>				   
				     </div>
      <?php
                }
                }else{
                  echo '
                  <div class="alert" role="alert" style="background-color: #1EA078;">
                    <h5 style="color: white;">No se encontro cedula del usuario!</h5>
                  </div>';
                  
                }
      }
      ?>
      <?php
      if(isset($_POST['modificar'])){
        $cedula = $_POST['cedula'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $celular = $_POST['celular'];
        $email = $_POST['email'];
        $nombreUsuario = $_POST['nombreUsuario'];
        $contrasena = $_POST['contrasena'];
        $cargo = $_POST['cargo'];
        $personal->modifyUsuario($nombre,$apellido,$celular,$email,$nombreUsuario,$contrasena,$cargo,$cedula);
      ?>
      <div class="alert" role="alert" style="background-color: #1EA078;">
        <h5 style="color: white;">El usuario con cedula: <?php echo $cedula; ?> se actualizo Satisfactoriamente!</h5>
      </div>
      <?php
      }
      ?>
    </div>
      
    </body>
</html>