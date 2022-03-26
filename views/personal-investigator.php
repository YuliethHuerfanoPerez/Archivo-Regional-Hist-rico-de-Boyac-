<?php
    include '../logic/investigatorManagement.php';
    #session_start();
    $update=false;
    $showSearch=false;
    $investigatorManagement= new investigatorManagement();
    $researchers = $investigatorManagement->showResearcher(); 
    $researcher = ""; 

    if (isset($_POST['add'])){
        session_start();
        $idResearcher = $_POST['idResearcher'];
        $nameResearcher = $_POST['nameResearcher'];
        $lastNameResearcher = $_POST['lastNameResearcher'];
        $emailResearcher = $_POST['emailResearcher'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        if(empty($idResearcher) || empty($nameResearcher) || empty($lastNameResearcher) || empty($emailResearcher) || empty($password) || empty($phone)){
            $researcher = "Credenciales invalidas, Por favor intentalo nuevamente"; 
            echo '<script language="javascript">alert("Las credenciales son inválidas, el investigador no fue registrado");</script>';
        }else{
            $researcher= $investigatorManagement->addResearcher($idResearcher, $nameResearcher, $lastNameResearcher, $emailResearcher, $password, $phone);
            echo '<script language="javascript">alert("Investigador registrado con éxito");</script>';
        }
    }
    if (isset($_POST['deleteResearcher'])){
        $delete = $investigatorManagement->deleteResearcher($_POST['idInvestigator']);
        $researcherEmpty=$delete;
        if($delete){
            echo '<script language="javascript">alert("El investigador seleccionado fue eliminado con éxito");</script>';
        }else{
            
        }
    }
    if (isset($_POST['update'])){
        $update=true;
        $idupdate=$_POST['idInvestigator'];
        $newUpdate= $investigatorManagement->searchNewId($idupdate);
        foreach($newUpdate as $i){
            $newId= $i['id'];
            $newname= $i['nameResearcher'];
            $newlastName= $i['lastNameResearcher'];
            $newemail= $i['user'];
            $newPassword=$i['password'];
            $newPhone=$i['celular'];
        }
    }
    if (isset($_POST['search'])){
        $showSearch=true;
        $researcher= $investigatorManagement->searchById($_POST['identificacion']);
    }
    if (isset($_POST['updateResearcher'])){
        $idResearcher=$_POST['id'];
        $nameResearcher = $_POST['name'];
        $lastNameResearcher = $_POST['lastName'];
        $emailResearcher = $_POST['email'];
        $password = $_POST['passwordR'];
        $phone = $_POST['phone'];
        if(empty($idResearcher) || empty($nameResearcher) || empty($lastNameResearcher) || empty($emailResearcher) || empty($password) || empty($phone)){
            $researcherEmpty = "Credenciales invalidas, Por favor intentalo nuevamente"; 
        }else{
            $researcherEmpty= $investigatorManagement->uptadeResearcher($idResearcher, $nameResearcher, $lastNameResearcher, $emailResearcher, $password, $phone);
            echo '<script language="javascript">alert("El investigador fue modificado con éxito");</script>';
            include_once 'personal-investigator.php';
        }
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>admin</title>
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
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
</head>

<body>
    <!-- =============== Preloader =============== -->
    <div id="preloader">
        <div id="loading">
		<img width="256" height="32" src="../assets/img/loading-cylon-red.svg">	
        </div>
    </div>
    <!-- =============== nav =============== -->
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top" >
        <div class="container" >
            <div class="container-fluid" style="background-color: #1EA078;"> 
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><img src="../assets/img/logo.png" alt="Logo" width="45%">
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
						<li>
                            <a class="page-scroll" href="personal-news.php">Noticias</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="personal-documents.php">Documentos</a>
                        </li>
                        <li class="active">
							<a class="page-scroll" href="personal-investigator.php">Investigadores</a>
                        </li>
                        <li>
                        
                            <a href="../logic/logout.php" class="page-scroll">Cerrar Sesión</a>
                        </li>
                    </ul>
                </div>
                <!-- =============== navbar-collapse =============== -->

           </div>
        </div>
        <!-- =============== container-fluid =============== -->
    </nav>
    <BR></BR>
    <BR></BR>
    <BR></BR>
    <BR></BR>
    <Section id="workers-pri">
        <div class="container">            
			<div class="row">
				
				    <div class="col-sm-6 izq wow fadeInDown animated" data-wow-delay=".1s">
                        <div class="titleadmin"> 
                            <div class="row">
                                <div class="col-xs-10 form-group wow fadeInUp animated">
                                    <h2>INVESTIGADORES</h2>
                                </div>
                                <div class="col-xs-2 form-group wow fadeInUp animated">
                                    <button data-wow-delay=".3s" class="btn btn-sm btn-block wow fadeInUp animated" type="submit"onclick="window.location.href='admin-investigator.php'"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                           
                            
                        </div>
                        <div>
                            <form action="#" method="post">
                                <div class="ajax-hidden">
                                    <div class="col-xs-8 form-group wow fadeInUp animated">
                                        <label for="c_name" class="sr-only">Identificación</label>
                                        <input type="text" placeholder="Identificación" name="identificacion" class="form-control" id="identificacion" required="">
                                    </div>
                                    <div class="col-xs-4 form-group wow fadeInUp animated">
                                        <button data-wow-delay=".3s" class="btn btn-sm btn-block wow fadeInUp animated" name="search" type="submit"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                                <div class="ajax-response"></div>
                            </form>
                        </div>
                        <?php
                            if($showSearch){
                        ?>
                            <div class="col-sm-12 izq wow fadeInDown animated" data-wow-delay=".1s">
                                <div class="ajax-hidden">
                                    <div class="col-xs-12 form-group wow fadeInUp animated" style="text-align:center"> 
                                        <label><?php echo ("Datos del investigador ".$researcher['nameResearcher']." ".$researcher['lastNameResearcher'])?></label> 
                                    </div>
                                    <div class="col-xs-12 form-group wow fadeInUp animated">
                                        <label ><?php echo ("Usuario: ".$researcher['user'])?></label> 
                                    </div>
                                    <div class="col-xs-12 form-group wow fadeInUp animated">
                                        <label ><?php echo ("Identificaci&oacute;n: ".$researcher['id'])?></label> 
                                    </div>
                                    <div class="col-xs-12 form-group wow fadeInUp animated">
                                        <label ><?php echo ("Nombre: ".$researcher['nameResearcher'])?></label> 
                                    </div>
                                    <div class="col-xs-12 form-group wow fadeInUp animated">
                                        <label ><?php echo ("Apellido: ".$researcher['lastNameResearcher'])?></label> 
                                    </div>
                                    <div class="col-xs-12 form-group wow fadeInUp animated">
                                        <label ><?php echo ("Teléfono: ".$researcher['celular'])?></label> 
                                    </div>
                                    <div class="col-xs-12 form-group wow fadeInUp animated">
                                        <label ><?php echo ("Contraseña: ".$researcher['password'])?></label> 
                                    </div>
                                    <input  name="idInvestigator" type="hidden" value="<?php echo ($researcher['id'])?>">
                                    <div class="col-xs-4 form-group wow fadeInUp animated">
                                        <button data-wow-delay=".3s" class="btn btn-sm btn-block wow fadeInUp animated" type="submit" name="deleteResearcher" ><i class="fa fa-trash" ></i></button>
                                    </div>
                                    <div class="col-xs-4 form-group wow fadeInUp animated">
                                        <button data-wow-delay=".3s" class="btn btn-sm btn-block wow fadeInUp animated" type="submit" name="update1"><i class="fa fa-refresh"></i></button>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }else{
                            $num=0;
                            foreach($researchers as $i){
                                $num++;
                        ?>
                        <div class="col-sm-12 izq wow fadeInDown animated" data-wow-delay=".1s">
                            <form action="" method="POST">
                                <br>
                                <div class="ajax-hidden">
                                    <div class="col-xs-12 form-group wow fadeInUp animated" style="text-align:center"> 
                                        <label><?php echo ("Investigador N° ".$num)?></label> 
                                    </div>
                                    <div class="col-xs-12 form-group wow fadeInUp animated">
                                        <label ><?php echo ("Usuario: ".$i['user'])?></label> 
                                    </div>
                                    <div class="col-xs-12 form-group wow fadeInUp animated">
                                        <label ><?php echo ("Identificaci&oacute;n: ".$i['id'])?></label> 
                                    </div>
                                    <div class="col-xs-12 form-group wow fadeInUp animated">
                                        <label ><?php echo ("Nombre: ".$i['nameResearcher'])?></label> 
                                    </div>
                                    <div class="col-xs-12 form-group wow fadeInUp animated">
                                        <label ><?php echo ("Apellido: ".$i['lastNameResearcher'])?></label> 
                                    </div>
                                    <div class="col-xs-12 form-group wow fadeInUp animated">
                                        <label ><?php echo ("Telefono: ".$i['celular'])?></label> 
                                    </div>
                                        <input  name="idInvestigator" type="hidden" value="<?php echo ($i['id'])?>">
                                    <div class="col-xs-4 form-group wow fadeInUp animated">
                                        <button data-wow-delay=".3s" class="btn btn-sm btn-block wow fadeInUp animated" type="submit" name="deleteResearcher" ><i class="fa fa-trash" ></i></button>
                                    </div>
                                    <div class="col-xs-4 form-group wow fadeInUp animated">
                                        <button data-wow-delay=".3s" class="btn btn-sm btn-block wow fadeInUp animated" type="submit" name="update"><i class="fa fa-refresh"></i></button>
                                    </div>
                                </div>
                                 <div class="ajax-response"></div>
                            </form>
                        </div>
                        <?php
                            }
                        }
                        ?>
                      
				    </div>
				    <div class="col-sm-6 wow fadeInUp animated" data-wow-delay=".2s">
                        <div class="col-xs-12 wow bounceIn animated" data-wow-delay=".1s">
                            <form action="" method="post">
                                <div class="ajax-hidden">
                                    <?php
                                        if($update){
                                    ?>
                                    <div class="titleadmin"> 
                                        <h2>ACTUALIZAR</h2>
                                    </div>
                                    <input type="hidden" class="form-control" id="id" name="id" placeholder="Titulo" value = "<?php echo ($idupdate)?>" required="">
                                    <div data-wow-delay=".1s" class="col-xs-12 form-group wow fadeInUp animated">
                                        <label for="c_email" class="sr-only">Nombre</label>
                                        <input type="text" placeholder="Nombre" name="name" class="form-control" id="name" value = "<?php echo ($newname)?>" required="">
                                    </div>
                                    
                                    <div class="col-xs-12 form-group wow fadeInUp animated">
                                        <label for="c_name" class="sr-only">Apellido</label>
                                        <input type="text" placeholder="Apellido" name="lastName" class="form-control" id="lastName" value = "<?php echo ($newlastName)?>" required="">
                                    </div>
                                    <div class="col-xs-12 form-group wow fadeInUp animated">
                                        <label for="c_name" class="sr-only">Correo electr&oacute;nico</label>
                                        <input type="email" placeholder="correo electr&oacute;nico" name="email" class="form-control" id="email" value = "<?php echo ($newemail)?>" required="">
                                    </div>
                                    <div class="col-xs-12 form-group wow fadeInUp animated">
                                        <label for="c_name" class="sr-only">Telefono</label>
                                        <input type="number" placeholder="telefono" name="phone" class="form-control" id="phone" value = "<?php echo ($newPhone)?>" required="">
                                    </div>
                                    <div class="col-xs-12 form-group wow fadeInUp animated">
                                        <label for="c_name" class="sr-only">Contraseña</label>
                                        <input type="password" placeholder="Contraseña" name="passwordR" class="form-control" id="passwordR" value = "<?php echo ($newPassword)?>" required="">
                                    </div>
                                    <div class="col-xs-6 form-group wow fadeInUp animated">
                                        <button class="btn" id="btn-add" type="submit" name="updateResearcher">Actualizar investigador</button>
                                    </div>
                                    <div class="col-xs-12 form-group wow fadeInUp animated">
                                    <div class="ajax-response"><?php if(isset($researcherEmpty)){echo $researcherEmpty;}?></div>
                                    </div>
                                    <?php
                                        }else{
                                    ?>
                                </div>
                                <div class="titleadmin"> 
                                    <h2>AGREGAR</h2>
                                </div>
                                <div class="ajax-hidden">
                                    <div class="col-xs-12 form-group wow fadeInUp animated">
                                        <label for="c_name" class="sr-only">Documento de identidad</label>
                                        <input type="text" placeholder="Documento de identidad" name="idResearcher" class="form-control" id="idResearcher" required="">
                                    </div>
            
                                    <div data-wow-delay=".1s" class="col-xs-12 form-group wow fadeInUp animated">
                                        <label for="c_email" class="sr-only">Nombre</label>
                                        <input type="text" placeholder="Nombre" name="nameResearcher" class="form-control" id="nameResearcher"  required="">
                                    </div>
                                    <div class="col-xs-12 form-group wow fadeInUp animated">
                                        <label for="c_name" class="sr-only">Apellido</label>
                                        <input type="text" placeholder="Apellido" name="lastNameResearcher" class="form-control" id="lastNameResearcher" required="">
                                    </div>
                                    <div class="col-xs-12 form-group wow fadeInUp animated">
                                        <label for="c_name" class="sr-only">Correo electr&oacute;nico</label>
                                        <input type="email" placeholder="correo electr&oacute;nico" name="emailResearcher" class="form-control" id="emailResearcher" required="">
                                    </div>
                                    <div class="col-xs-12 form-group wow fadeInUp animated">
                                        <label for="c_name" class="sr-only">Telefono</label>
                                        <input type="number" placeholder="telefono" name="phone" class="form-control" id="phone" required="">
                                    </div>
                                    <div class="col-xs-12 form-group wow fadeInUp animated">
                                        <label for="c_name" class="sr-only">Contraseña</label>
                                        <input type="password" placeholder="Contraseña" name="password" class="form-control" id="password" required="">
                                    </div>
                                    <div class="col-xs-6 form-group wow fadeInUp animated">
                                        <button class="btn" id="btn-add" type="submit" name="add">Agregar investigador</button>
                                    </div>                                
                                </div>
                                <div class="ajax-response"></div>
                            </form>
                        </div>
                        <?php
                             }
                        ?>				   
				     </div>
				                  
				
			</div>
		</div>
    </Section>

        


	   
	<!-- =============== jQuery =============== -->
    <script src="../assets/js/jquery.js"></script>
	 <script src="../assets/js/isotope-docs.min.js"></script>
    <!-- =============== Bootstrap Core JavaScript =============== -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- =============== Plugin JavaScript =============== -->
    <script src="../assets/js/jquery.easing.min.js"></script>
    <script src="../assets/js/jquery.fittext.js"></script>
    <script src="../assets/js/wow.min.js"></script> 
	<!-- =============== owl carousel =============== -->
    <script src="../assets/owl-carousel/owl.carousel.js"></script>  
	<!-- Isotope does NOT require jQuery. But it does make things easier -->

<script src="../assets/js/baguetteBox.js" async></script>
<script src="../assets/js/plugins.js" async></script>
 
    <!-- =============== Custom Theme JavaScript =============== -->
    <script src="../assets/js/creative.js">	</script> 
<script src="../assets/js/jquery.nicescroll.min.js"></script>

<script>
  $(document).ready(function() {
  
	var nice = $("html").niceScroll();  // The document page (body)
	
	$("#div1").html($("#div1").html()+' '+nice.version);
    
    $("#boxscroll").niceScroll({cursorborder:"",cursorcolor:"#00F",boxzoom:true}); // First scrollable DIV

    $("#boxscroll2").niceScroll("#contentscroll2",{cursorcolor:"#F00",cursoropacitymax:0.7,boxzoom:true,touchbehavior:true});  // Second scrollable DIV
    $("#boxframe").niceScroll("#boxscroll3",{cursorcolor:"#0F0",cursoropacitymax:0.7,boxzoom:true,touchbehavior:true});  // This is an IFrame (iPad compatible)
	
    $("#boxscroll4").niceScroll("#boxscroll4 .wrapper",{boxzoom:true});  // hw acceleration enabled when using wrapper
    
  });
</script>
<script>
window.onload = function() {
    if(typeof oldIE === 'undefined' && Object.keys)
        hljs.initHighlighting();

    baguetteBox.run('.baguetteBoxOne');
    baguetteBox.run('.baguetteBoxTwo');
    baguetteBox.run('.baguetteBoxThree', {
        animation: 'fadeIn'
    });
    baguetteBox.run('.baguetteBoxFour', {
        buttons: false
    });
    baguetteBox.run('.baguetteBoxFive', {
        captions: function(element) {
            return element.getElementsByTagName('img')[0].alt;
        }
    });
};
</script>
</body>
</html>