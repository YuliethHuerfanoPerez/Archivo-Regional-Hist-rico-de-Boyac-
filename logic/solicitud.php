<?php
    //El destino seria el correo del archivo historico
    $destino="jhon.aparicio@uptc.edu.co";
    $typeDoc=$_POST['typeDoc'];
    $cedula=$_POST['cedula'];
    $nombre=$_POST['name'];
    $apellido=$_POST['lastname'];
    $celular=$_POST['celular'];
    $correo=$_POST['email'];
    $contraseña=$_POST['password'];
    $type=$_POST['type'];

    $cuerpo = '
    
    <!DOCTYPE html>
    <html>
    <head>
     <title> Solicitud registro '.$nombre.' '.$apellido.'</title>
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>  
       </head>
    <body>
    <p>Tiene una nueva solicitud para crear una cuenta</p>
    <p>Tipo de documento: '.$typeDoc.'</p><br>
    <p>cedula: '.$cedula.'</p><br>
    <p>Nombre: '.$nombre.'</p><br>
    <p>Apellido: '.$apellido.'</p><br>
    <p>Celular: '.$celular.'</p><br>
    <p>Correo: '.$correo.'</p><br>
    <p>Tipo de solicitud: '.$type.'</p><br>
    <button type="button" class="btn btn-success">Aceptar</button>
    <button type="button" class="btn btn-danger">Rechazar</button>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </html>';

    //para el envío en formato HTML
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

    //dirección del remitente
    $headers .= "From: ".$_POST['nombre']." <"."jhonaparicio2000@hotmail.com".">\r\n";

    //Una Dirección de respuesta, si queremos que sea distinta que la del remitente
    $headers .= "Reply-To: "."jhonaparicio2000@hotmail.com"."\r\n";

    mail($destino,"Solicitud archivo historico regional",$cuerpo,$headers);
    header("Location:../index.php");
?>