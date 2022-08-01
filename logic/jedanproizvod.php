
<?php 
function jedanproizvod(){


      if(isset($_GET['IdP'])){
        try{ 
   $idP=$_GET['IdP'];
       $proizvod=filtriraniProizvodi($idP,"p.IdP");
         //var_dump($proizvod);
        foreach($proizvod as $osobina):
           ?>
           <div class="product_image_area section-padding40">
           <div class="container">
           <div class="row s_product_inner">
           <div class="col-lg-5">
           <div class="product_slider_img">
           <div id="vertical">
           <div data-thumb="assets/img/gallery/product-details1.png">
           <img src="assets/img/gallery/<?=$osobina->src?>" alt="<?=$osobina->src?>" class="w-100">
           </div>
   
           </div>
           </div>
           </div>
           <div class="col-lg-5 offset-lg-1">
           <div class="s_product_text">
           <h3><?=$osobina->Name?></h3>
           <h2><?=$osobina->Iznos?> $</h2>
           <ul class="list">
           <li>
           <a class="active" href="#">
           <span>Category</span> : <?=$osobina->NazivKat?></a>
           </li>
           <li>
           <a href="#"> <span>Availibility</span> : <?php if($osobina->Availability==1){ echo "In stock";}
           else{echo "Out of stock";} ?> </a>
           </li>
           </ul>
           <div class="card_area">
           
           <div class="social_icon">
           <a href="#" class="fb"><i class="ti-facebook"></i></a>
           <a href="#" class="tw"><i class="ti-twitter-alt"></i></a>
           <a href="#" class="li"><i class="ti-linkedin"></i></a>
           </div>
           </div>
           </div>
           </div>
           <!-- </div>
           </div>
           </div> -->
           
           
           <section class="col-12 product_description_area">
           <div class="container">
           <ul class="nav nav-tabs" id="myTab" role="tablist">
           <li class="nav-item">
           <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
           </li>
           <li class="nav-item">
           <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Specification</a>
           </li>
           <li class="nav-item">
           <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Comments</a>
           </li>
           </ul>
           <div class="tab-content" id="myTabContent">
           <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
           <p>
           <?=$osobina->Description?>
           </p>

           </div>
           <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
           <div class="table-responsive">
           <table class="table">
           <tbody>
           <tr>
           <td>
           <h5>Width</h5>
           </td>
           <td>
           <h5><?=$osobina->Sirina?></h5>
           </td>
           </tr>
           <tr>
           <td>
           <h5>Height</h5>
           </td>
           <td>
           <h5><?=$osobina->Visina?></h5>
           </td>
           </tr>
           <tr>
           <td>
           <h5>Depth</h5>
           </td>
           <td>
           <h5><?=$osobina->Dubina?></h5>
           </td>
           </tr>
           <tr>
           <td>
           <h5>Weight</h5>
           </td>
           <td>
           <h5><?=$osobina->Tezina?></h5>
           </td>
           </tr>
           <tr>
           <td>
           <h5>Quality checking</h5>
           </td>
           <td>
           <?php if($osobina->QualityCheck==1){
            echo "<h5>yes</h5>";
           }
           else{
           echo "<h5>no</h5>";

           } ?>
           
           </td>
           </tr>
           
           </tbody>
           </table>
           </div>
           </div>
           <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
<div class="row col-lg-12">
<div class="col-lg-6">
<div class="comment_list">
<?php
$nizKomentaraa=komentari($_GET['IdP']);
foreach($nizKomentaraa as $nizKomentara):
?>
<div class="review_item">
<div class="media">
<!-- <div class="d-flex">
<img src="assets/img/gallery/review-3.png" alt="" />
</div> -->
<div class="media-body">
<h4><?=$nizKomentara->Ime?> <?=$nizKomentara->Prezime?></h4>
<h5><?=$nizKomentara->Datum?></h5>
</div>
</div>
<p>
<?=$nizKomentara->Komentar?>
</p>

</div>
<?php endforeach ?>
</div></div>

           <?php if(isset($_SESSION['ulogovan'])){
            echo '<div class="col-lg-6"><p>Your comment</p>
            <form class="form-contact contact_form" method="post" id="contactForm" novalidate="novalidate">
            <div class="col-md-12">
            <div class="form-group">
            <input type="text" class="form-control komentariImePrezime" name="komentariImePrezime" disabled value="'.$_SESSION['ulogovan']->Prezime.' '.$_SESSION['ulogovan']->Ime.'" />
            </div>
            </div>
            <div class="col-md-12">
            <div class="form-group">
            <input type="email" class="form-control komentariEmail" name="komentariEmail" disabled value="'.$_SESSION['ulogovan']->Email.'" />
            </div>
            </div>
            <div class="col-md-12">
            <div class="form-group">
            <textarea class="form-control komentar" name="message" rows="4" placeholder="Comment"></textarea>
            </div>
            <p class="obavestenjeKom"></p>
            </div>
            
            <div class="col-md-12 text-right">
            
            <button type="submit" value="submit" id="dugmeKomentar" name="dugmeKomentar" class="btn">
            Submit Now
            </button>
            
            </div>
            </div>
            </form>
            </section>
             <input type="hidden" name="hidden" class="hidden" value="'.$idP.'" />';
           }
           
           
           
           ?>

          <?php endforeach ?>
<?php
        }


   catch(PDOException $e){
    echo $e->getMessage();
    http_response_code(500);
}
}
   else{
       http_response_code(404);
   }
}

?>