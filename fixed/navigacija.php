<?php //session_start(); ?>
<body>
<div id="preloader-active">
<div class="preloader d-flex align-items-center justify-content-center">
<div class="preloader-inner position-relative">
<div class="preloader-circle"></div>
<div class="preloader-img pere-text">
<img src="assets/img/logo/loder.png" alt="">
</div>
</div>
</div>
</div>
<header>

<div class="header-area">
<div class="main-header header-sticky">
<div class="container-fluid">
<div class="row menu-wrapper align-items-center justify-content-between">
<div class="header-left d-flex align-items-center">

<div class="logo">
<a href="index.php"><img src="assets/img/logo/logo.png" alt=""></a>
</div>

<div class="main-menu  d-none d-lg-block">
<nav>
<ul id="navigation">
<?php
//echo $_SERVER['DOCUMENT_ROOT'];
include $_SERVER['DOCUMENT_ROOT']."/logic/funkcije.php";
echo ispisMenija() 
?>
<!-- <li><a href="index.php">Home</a></li>
<li><a href="product_details.php">Product</a></li>
<li><a href="about.php">About me</a></li>
<li><a href="categories.php">Products Category</a>
<ul class="submenu">
<li><a href="#">Login</a></li>
<li><a href="#">Card</a></li>
<li><a href="#">Categories</a></li>
<li><a href="#">Checkout</a></li>
<li><a href="#">Product Details</a></li>
</ul>
</li>
<li><a href="blog.php">Anketa</a>
</li>
<li><a href="contact.php">Contact</a></li> -->
</ul>
</nav>
</div>
</div>
<div class="header-right1 d-flex align-items-center">
<div class="search">
<ul class="d-flex align-items-center">
<?php
if(isset($_SESSION['ulogovan'])){
    echo '<a href="logic/logout.php?logout=1" name="logout" class="account-btn" >Logout</a>';
}
else{
    echo '<a href="login.php" class="account-btn" target="_blank">Login</a>';
} ?>

<li>
</li>
</ul>
</div>
</div>

<div class="col-12">
<div class="mobile_menu d-block d-lg-none"></div>
</div>
</div>
</div>
</div>
</div>

</header>
