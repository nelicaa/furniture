<?php include "fixed/head.php"; 
 include "fixed/navigacija.php";
include "logic/jedanproizvod.php"; ?>


<main>

<div class="slider-area ">
<div class="slider-active">
<div class="single-slider hero-overly2  slider-height2 d-flex align-items-center slider-bg2">
<div class="container">
<div class="row">
<div class="col-xl-6 col-lg-8 col-md-8">
<div class="hero__caption hero__caption2">
<h1 data-animation="fadeInUp" data-delay=".4s">Product details</h1>
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="index.php">Home</a></li>
<li class="breadcrumb-item"><a href="#">Product details</a></li>
</ol>
</nav>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php echo jedanproizvod();?>

<?php include "fixed/footer.php"; ?>