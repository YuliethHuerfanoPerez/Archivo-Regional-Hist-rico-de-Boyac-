<?php
    setlocale(LC_TIME, 'es_ES');
    include '../logic/controlNews.php';
    $controlnews= new controlNews();
    $idnew=$_POST['NewVar'];
    if (isset($idnew)){
        $new=$controlnews->searchNewId($idnew);    
        $dateparts=explode("-",$new[0]['fecha']);
        $fecha = DateTime::createFromFormat('!m', $dateparts[1]);
        $mes = strftime("%B", $fecha->getTimestamp());
        $pictures=$controlnews->getpictures($idnew);
    


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>noticia ARHB</title>
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
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><img src="../assets/img/logo.png" alt="Logo" width="45%">
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
						<li>
                            <a class="page-scroll" href="../index.php">Inicio</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="../index.php#about">Conozcanos</a>
                        </li>
                        <li>
							<a class="page-scroll" href="../index.php#contact">Contactenos</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="news.php">Noticias</a>
                        </li>
                        <li>
							<li class="nav-item dropdown">
								<a class="page-scroll nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Archivos</a>
								<ul class="dropdown-menu">
								  <li><a class="page-scroll dropdown-item" href="files.php">Archivos públicos</a></li>
								  <li class="dropdown-divider"></li>
								  <li><a class="page-scroll dropdown-item" href="records.php">Fondos</a></li>
								</ul>
                        	</li>
						</li>
                        <li>
                            <a class="page-scroll" href="login.php">Iniciar Sesion</a>
                        </li>
                    </ul>
                </div>
                <!-- =============== navbar-collapse =============== -->

            </div>
        </div>
        <!-- =============== container-fluid =============== -->
    </nav>
    <section>	
        <div class="container marg50">
            <div class="row">
                <div class="col-lg-12">
                    <div class="classic-blog blog-single">
                        <div class="bs-blog-img">
                            <div class="container">
                                <div class="header-content row">
				                    <div id="owl-demo" class="owl-carousel header1">      
                                    <?php
                                        if($pictures){
                                            foreach($pictures as $pic){

                                    ?>    
                                        <div>
				                            <div class="col-xs-12 col-sm-6 col-md-6 header-text">
                                            <img alt="" src="<?php echo "../files/pictures/". $pic['sourcename']?>">
                                            </div>               
				                        </div>
                                    <?php
                                    }
                                    }else{
                                    ?>
                                        <div class="bs-blog-img"><img alt="" src="../assets/img/LogoAHRB.jpg"></div>
                                    <?php
                                    }
                                    ?>   
				                    </div>				 
				                </div>          
                            </div> 
                        </div>                   
                        <div class="bs-blog-naz">
                            <div class="bs-blog-type"><i class="fa fa-pencil-square-o"></i></div>
                            <div class="bs-blog-name"><a ><?php echo $new[0]['nombre']?></a></div>
                            <div class="bs-blog-detail"><?php echo $dateparts[2]. " de ".$mes .", ".$dateparts[0]?></div>
                            <div class="bs-blog-text"> <?php echo $new[0]['contenido']?></div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </section>	
		<footer id="footer">
		<!-- =============== container =============== -->
		<div class="container">
					<div class="row">
					<div class="col-12">
	
						<ul class="social-links">
							<li><a class="wow fadeInUp animated" href="index.html#" style="visibility: visible; animation-name: fadeInUp;" title="facebook"><i class="fa fa-facebook"></i></a></li>
							<li><a data-wow-delay=".1s" class="wow fadeInUp animated" href="https://www.boyaca.gov.co/" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;" title="Gorbernaci&oacute;n de Boyac&aacute;"><img src="../assets/img/footer/gobernacion.png"></i></a></li>
							<li><a data-wow-delay=".2s" class="wow fadeInUp animated" href="https://academia-boyacense-de-historia.webnode.es/" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;" title="Academia de historia de Boyac&aacute;"><img src="../assets/img/footer/academia.png"></i></a></li>
							<li><a data-wow-delay=".4s" class="wow fadeInUp animated" href="https://www.uptc.edu.co/sitio/portal/" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;" title="UPTC"><img src="../assets/img/footer/uptc.png"></i></a></li>
							<li><a data-wow-delay=".5s" class="wow fadeInUp animated" href="https://www.banrep.gov.co/" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;" title="banco de la rep&uacute;blica"><img src="../assets/img/footer/banrep.png"></i></a></li>
						</ul>
	
						<p class="copyright">
							&copy; 2016 Be. Created By <a href="http://templatestock.co">Template Stock</a>
						</p>
	
					</div>
			
				</div>
		</div><!-- =============== container end =============== -->
		</footer> 
        


	   
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
<?php
}
?>