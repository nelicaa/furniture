<?php 
// /include "logic/funkcije.php";
include "fixed/head.php"; 
include "fixed/navigacija.php"; 


 
 ?>
<main>

<div class="slider-area ">
<div class="slider-active">
<div class="single-slider hero-overly2  slider-height2 d-flex align-items-center slider-bg2">
<div class="container">
<div class="row">
<div class="col-xl-6 col-lg-8 col-md-8">
<div class="hero__caption hero__caption2">
<h1 data-animation="fadeInUp" data-delay=".4s">Gallery</h1>
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="index.php">Home</a></li>
<li class="breadcrumb-item"><a href="#">Gallery</a></li>
</ol>
</nav>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


<section class="properties new-arrival fix">
<div class="container">

<div class="row justify-content-center">
<div class="col-xl-7 col-lg-8 col-md-10">
<div class="section-tittle mb-60 text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
<h2>All products</h2>
<P>Shop safe with us!</P>
</div>
</div>
</div>
<div class="row">
<div class="col-xl-12">
<div class="properties__button text-center">

<nav>
<div class="form-outline p-3">
<form class="form-contact contact_form" method="post" id="contactForm" novalidate="novalidate">
  <input type="search" id="form1" class="form-control col-4 m-auto search" placeholder="Search"
  aria-label="Search" /> </form>
</div>
<!-- <form action="#" class="form-box f-right ">
<input type="text" name="Search" placeholder="Search products">
<div class="search-icon">
<i class="ti-search"></i>
</div>
</form> -->
<div class="nav nav-tabs" id="nav-tab" role="tablist">
<?php
echo ispisKategorija();

?>

</div>
</nav>

</div>
</div>
</div>
<div class="row">

<div class="tab-content" id="nav-tabContent">
<?php

// if(isset($_GET['dugme'])){
//     echo "Sgvsdf";
// $promenljiva=$_GET['nazivKat'];
// echo "<h1>".$promenljiva."</h1>";

// }
?>
<div class="tab-pane fade show active" id="nav-Sofa" role="tabpanel" aria-labelledby="nav-Sofa-tab">
<div class="row" id="proizvodi">

<?php
//  echo ispisiPorizvod(); ?>
</div>

<div class="row justify-content-center">
<div class="room-btn" id="stranicenje">
<?php
 //echo stranicenje();

?>
<!-- <a href="#" class="border-btn">1</a>
<a href="#" class="border-btn">2</a>
<a href="#" class="border-btn">3</a> -->
</div>
</div>
</div>
</section>
<?php include "fixed/footer.php"; ?>