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
<?php
if (isset($_POST['ver'])){
?>
<div class="container">
    <div class="row col mb-3">
        <a href= "files.php" ><button class="btn btn-success" id="btn-volver" >volver</button></a>
    </div>
    <div class= "row">
        <embed src="<?php echo $_POST['ver']?>" type="application/pdf" width="100%" height="600px" />
    </div>
</div>
<?php
}

?>

