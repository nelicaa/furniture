<?php include "fixed/head.php"; 
include "fixed/navigacija.php";
include "logic/konekcija.php";
$anketa=prikaz("anketa");
foreach($anketa as $a){
 // var_dump($a->IdK);
  if($a->IdK==$_SESSION['ulogovan']->IdKorisnik){
    header("Location:index.php");
  }
}
if(empty($_SESSION['ulogovan'])){header("Location:index.php");}?>

<main>
<section class="contact-section">
<div class="container">


<div class="row">
<div class="col-7 m-auto">
 <?php 
 $upit="Select IdA from anketa ORDER BY IdA DESC LIMIT 1";
 $rezultat=$konekcija->query($upit);
 $rez=$rezultat->fetch();
$id=$rez->IdA+1;
?>
<form  method="POST" action="logic/pollInsert.php" id="forma" >
<input type="hidden" name="IdA" value="<?=$id?>" />
<input type="hidden" name="IdK" value="<?=$_SESSION['ulogovan']->IdKorisnik ?>"/>
<?php
$anketa=prikaz("anketapitanja");
foreach($anketa as $a):
?>
<div class="form-check mt-3">
  <h2><?= $a->Prvo;?></h2>
  <input class="form-check-input" type="radio" name="Prvo" id="exampleRadios2" value="Yes">
  <label class="form-check-label ml-3" for="exampleRadios2"> Yes
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="Prvo" id="exampleRadios2" value="No">
  <label class="form-check-label ml-3" for="exampleRadios2"> No
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="Prvo" id="exampleRadios2" value="Planning">
  <label class="form-check-label ml-3" for="exampleRadios2"> I am planning
  </label>
  </div>

  <div class="form-check  mt-3">
  <h2><?= $a->Drugo;?></h2>
  <input class="form-check-input" type="radio" name="Drugo" id="exampleRadios2" value="Yes">
  <label class="form-check-label ml-3" for="exampleRadios2"> Yes
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="Drugo" id="exampleRadios2" value="No">
  <label class="form-check-label ml-3" for="exampleRadios2"> No
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="Drugo" id="exampleRadios2" value="Planning">
  <label class="form-check-label ml-3" for="exampleRadios2"> I am planning
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="Drugo" id="exampleRadios2" value="Notplanning">
  <label class="form-check-label ml-3" for="exampleRadios2"> I am not planning
  </label>
  </div>
  <div class="form-check  mt-3">
  <h2><?= $a->Trece;?></h2>
  <input class="form-check-input" type="radio" name="Trece" id="exampleRadios2" value="Yes">
  <label class="form-check-label ml-3" for="exampleRadios2"> Yes
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="Trece" id="exampleRadios2" value="No">
  <label class="form-check-label ml-3" for="exampleRadios2"> No
  </label>
  </div>
  <div class="form-check  mt-3">
  <h2><?= $a->Cetvrto;?></h2>
  <input class="form-check-input" type="radio" name="Cetvrto" id="exampleRadios2" value="Yes">
  <label class="form-check-label ml-3" for="exampleRadios2"> Yes
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="Cetvrto" id="exampleRadios2" value="No">
  <label class="form-check-label ml-3" for="exampleRadios2"> No
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="Cetvrto" id="exampleRadios2" value="Maybe">
  <label class="form-check-label ml-3" for="exampleRadios2"> Maybe
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="Cetvrto" id="exampleRadios2" value="Dontknow">
  <label class="form-check-label ml-3" for="exampleRadios2"> I dont know
  </label>
  </div>
  <button class="btn btn-secondary btn-lg btn-block mt-3 poll">Block level button</button>
  <input type="hidden" name="IdAP" value="<?=$a->IdAP ?>"/>
</form>
</div>
</div>
<?php endforeach; ?>
</main>


<?php include "fixed/footer.php"; ?>