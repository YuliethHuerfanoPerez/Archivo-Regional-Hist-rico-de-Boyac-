<?php
    include '../logic/controlNews.php';
    session_start();
    $update=false;
    $controlnews= new controlNews();
    $news = $controlnews->searchNews(); 

    if (isset($_POST['form1'])){
        
        $name = $_POST['title'];
        $description = $_POST["description"];
        $content = $_POST["content"];
        $autorname = $_POST["autorname"];
        $autorlastname = $_POST["autorlastname"];
        $date = $_POST["date"];
        $idUser = $_SESSION['id'];
        if(empty($name) || empty($description) || empty($content) || empty($autorname) || empty($autorlastname) || empty($date)){
            $newsempty = "Credenciales invalidas, Por favor intentalo nuevamente"; 
        }else{
            $newsempty= $controlnews->addNews($name,$description,$content,$autorname,$autorlastname,$date,$idUser);
        }
    }
    if (isset($_POST['form2t'])){
        $delete = $controlnews->deleteNew($_POST['idnews']);
        $newsempty=$delete;
    }

    if (isset($_POST['form2r'])){
        $update=true;
        $idupdate=$_POST['idnews'];
        $newUpdate= $controlnews->searchNewId($idupdate);
        foreach($newUpdate as $i){
            $newname= $i['nombre'];
            $newdesc= $i['descripcion'];
            $newcont= $i['contenido'];
            $newdate= $i['fecha'];
        }
    }
    if (isset($_POST['form3'])){
        $id=$_POST['id'];
        $name = $_POST['title'];
        $description = $_POST["description"];
        $content = $_POST["content"];
        $date = $_POST["date"];
        $idUser = $_SESSION['id'];
        if(empty($name) || empty($description) || empty($content) || empty($date)){
            $newsempty = "Credenciales invalidas, Por favor intentalo nuevamente"; 
        }else{
            $newsempty= $controlnews->uptadeNew($id,$name,$description,$content,$date,$idUser);
            include_once 'admin-news.php';
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
						<li class="active">
                            <a class="page-scroll" href="admin-news.php">Noticias</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="admin-documents.php">Documentos</a>
                        </li>
                        <li>
							<a class="page-scroll" href="admin-investigator.php">Investigadores</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="admin-workers.php">Personal</a>
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
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <Section id="crear">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 izq wow fadeInDown animated" data-wow-delay=".1s">
                    <div class="titleadmin"> 
                        <div class="row">
                            <div class="col-xs-10 form-group wow fadeInUp animated">
                                <div class="col-xs-10 form-group wow fadeInUp animated"></div>
                                    <h2>PUBLICADOS</h2>
                                </div>
                                <div class="col-xs-2 form-group wow fadeInUp animated">
                                    <button data-wow-delay=".3s" class="btn btn-sm btn-block wow fadeInUp animated" type="submit" onclick="window.location.href='#actualizar'"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>  
                        </div>
                        <div>
                            <div>
                                <form action="" method="GET">
                                    <div class="ajax-hidden">
                                        <div class="col-xs-8 form-group wow fadeInUp animated">
                                            <label for="c_name" class="sr-only">Buscar</label>
                                            <input type="text" placeholder="Nombre" name="name" class="form-control" id="name" required="">
                                        </div>
                                        <div class="col-xs-4 form-group wow fadeInUp animated">
                                            <button data-wow-delay=".3s" class="btn btn-sm btn-block wow fadeInUp animated" type="submit"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    <div class="ajax-response"></div>
                                </form>
                            </div>
                            <?php
                                foreach($news as $i){
                            ?>
                            <div class="col-sm-12 izq wow fadeInDown animated" data-wow-delay=".1s">
                                <form action="" method="POST">
                                    <br>
                                    <div class="ajax-hidden">
                                        <div class="col-xs-12 form-group wow fadeInUp animated">
                                            <label ><?php echo ($i['nombre'])?></label> 
                                        </div>
                                        <div class="col-xs-12 form-group wow fadeInUp animated">
                                            <label ><?php echo ($i['descripcion'])?></label> 
                                        </div>
                                        <input id="idNews" name="idnews" type="hidden" value="<?php echo ($i['idNoticias'])?>">
                                        <div class="col-xs-4 form-group wow fadeInUp animated">
                                            <button data-wow-delay=".3s" class="btn btn-sm btn-block wow fadeInUp animated" type="submit" name="form2t" ><i class="fa fa-trash" ></i></button>
                                        </div>
                                        <div class="col-xs-4 form-group wow fadeInUp animated">
                                            <button data-wow-delay=".3s" class="btn btn-sm btn-block wow fadeInUp animated" type="submit" name="form2r"><i class="fa fa-refresh"></i></button>
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
     <div class="col-sm-6 wow fadeInUp animated" data-wow-delay=".2s">
        <div class="titleadmin"> 
            <h2>GESTIONAR</h2>
        </div>
        <div class="col-xs-12 wow bounceIn animated" data-wow-delay=".1s">
            
            <form action="" method="POST">
                <div class="ajax-hidden">
                    <?php
                        if($update){
                    ?>
                    <input type="hidden" class="form-control" id="id" name="id" placeholder="Titulo" value = "<?php echo ($idupdate)?>" required="">

                    <div data-wow-delay=".1s" class="col-xs-12 form-group wow fadeInUp animated">
                        <input type="text" class="form-control" id="titulo" name="title" placeholder="Titulo" value = "<?php echo ($newname)?>" required="">
                    </div>
                    <div class="col-xs-12 form-group wow fadeInUp animated">
                        <textarea  type="text" class="form-control" id="Descripcion" placeholder="Descripcion" name="description" required=""><?php echo ($newdesc)?></textarea>
                    </div>
                    <div class="col-xs-12 form-group wow fadeInUp animated">
                        <textarea  type="text" class="form-control" id="contenido" placeholder="Contenido" name="content" required=""><?php echo ($newcont)?></textarea>
                    </div>
        
                    <div data-wow-delay=".1s" class="col-xs-12 form-group wow fadeInUp animated">
                        <label for="fecha" class="form-label">Fecha de publicacion:</label>
                        <input type="date" class="form-control" id="fecha" name="date" required="" value = "<?php echo ($newdate)?>">
                    </div>
                    <!-- 
                    <div class="col-xs-12 form-group wow fadeInUp animated">
                        <input type="image" class="form-control" id="imagen" alt="Imagen" name="imagen">
                    </div>
                    -->
                    <div class="col-xs-6 form-group wow fadeInUp animated">
                        <button class="btn" id="btn-add" type="submit" name="form3">Actualizar</button>
                    </div>
                </div>
                <div class="col-xs-12 form-group wow fadeInUp animated">
                    <div class="ajax-response"><?php if(isset($newsempty)){echo $newsempty;}?></div>
                </div>
                <?php
                    }else{
                ?>
                    <div data-wow-delay=".1s" class="col-xs-12 form-group wow fadeInUp animated">
                        <input type="text" class="form-control" id="titulo" name="title" placeholder="Titulo"  required="">
                    </div>
                    <div class="col-xs-12 form-group wow fadeInUp animated">
                        <textarea  type="text" class="form-control" id="Descripcion" placeholder="Descripcion" name="description" required=""></textarea>
                    </div>
                    <div class="col-xs-12 form-group wow fadeInUp animated">
                        <textarea  type="text" class="form-control" id="contenido" placeholder="Contenido" name="content" required=""></textarea>
                    </div>
                    <div data-wow-delay=".1s" class="col-xs-6 form-group wow fadeInUp animated">
                        <input type="text" class="form-control" placeholder="nombre del autor" id="autorname" name="autorname" required="">
                    </div>
                    <div data-wow-delay=".1s" class="col-xs-6 form-group wow fadeInUp animated">
                        <input type="text" class="form-control" placeholder="Apellido del autor" id="autorlastname" name="autorlastname" required="">
                    </div>
                    <div data-wow-delay=".1s" class="col-xs-12 form-group wow fadeInUp animated">
                        <label for="fecha" class="form-label">Fecha de publicacion:</label>
                        <input type="date" class="form-control" id="fecha" name="date" required="">
                    </div>
                    <!-- 
                    <div class="col-xs-12 form-group wow fadeInUp animated">
                        <input type="image" class="form-control" id="imagen" alt="Imagen" name="imagen">
                    </div>
                    -->
                    <div class="col-xs-6 form-group wow fadeInUp animated">
                        <button class="btn" id="btn-add" type="submit" name="form1">Crear</button>
                    </div>
                </div>
                <div class="col-xs-12 form-group wow fadeInUp animated">
                    <div class="ajax-response"><?php if(isset($newsempty)){echo $newsempty;}?></div>
                </div>
                <?php 
                    }
                ?>
            </form>
        </div>	
    </div>
    </section>
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
