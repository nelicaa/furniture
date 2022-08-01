<?php
include "../dashfixed/header.php";
include "../dashfixed/nav.php";
include "../../konekcija/konekcija.php";?>

      <div class="content">
        <div class="container-fluid">
        <div class="m-auto  card-profile">
                <div class="card-avatar">
                  <a href="javascript:;">
                    <img class="img" src="../assets/img/faces/marc.jpg" />
                  </a>
                </div> </div>
          <div class="row">
            <div class="col-md-9 m-auto">
              <div class="card">
                <div class="card-header card-header-primary"  >
                  <h4 class="card-title">Your Profile</h4>
                  <p class="card-category"> info</p>
                </div>
                
                <div class="card-body">
                  
                  <form>
      <?php 
      $upit="SELECT * from korisnik where Email=:email";
      $rezultat=$konekcija->prepare($upit);
      $rezultat->bindParam(":email", $_SESSION['ulogovan']->Email);
      try{$rezultat->execute();
        $rez=$rezultat->fetch();}
        catch(PDOException $e){
        http_response_code(500);
        }
                
                 echo '<div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating ">'.$rez->Ime.'</label>
                          <input type="text" value="'.$rez->Ime.'" class="adminIme form-control">
                          <p class="d-none alertime" role="alert"</p>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">'.$rez->Prezime.'</label>
                          <input type="text" value="'.$rez->Prezime.'" class=" adminPrezime form-control">
                          <p class="d-none alertprezime" role="alert"</p>

                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-10">
                        <div class="form-group">
                          <label class="bmd-label-floating">'.$rez->Email.'</label>
                          <input type="email" value="'.$rez->Email.'" class="adminEmail form-control">
                          <p class="d-none alertemail" role="alert"</p>

                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-8">
                        <div class="form-group">
                          <label class="bmd-label-floating">'.$rez->Datum.'</label>
                          <input type="text" disabled class="form-control">
                        </div>
                      </div>
                     
                    </div>
                   
                    <button type="submit" id="'.$_SESSION['ulogovan']->IdKorisnik.'" class="btn pull-right user">Update Profile</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-4">
             
            </div>
          </div>
        </div>
      </div>';
      //var_dump($_SESSION['ulogovan']);
      ?> 
    <?php
    include "../dashfixed/footer.php"; ?> <!-- <div class="card card-profile">
    <div class="card-avatar">
      <a href="javascript:;">
        <img class="img" src="../assets/img/faces/marc.jpg" />
      </a>
    </div>
    <div class="card-body">
      <h6 class="card-category text-gray">CEO / Co-Founder</h6>
      <h4 class="card-title">Alec Thompson</h4>
      <p class="card-description">
        Don't be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...
      </p>
    </div>
  </div> -->