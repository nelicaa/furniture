<?php
include "../dashfixed/header.php";
include "../dashfixed/nav.php";
// include "../../konekcija/konekcija.php";
include "../../logic/funkcije.php";?>
      
      <div class="content">
        <div class="container-fluid">
            <div class="form-check custom-switch">

</div>
<table class="table">
  <tbody>
    
<?php
$pitanja=prikaz("anketapitanja");
$uradjenih=prikaz("anketa");
$uradjenih=count($uradjenih);
$niz=["Prvo","Drugo", "Trece", "Cetvrto"];
foreach($pitanja as $p):
  foreach($niz as $pitanje):

?>

<tr>
      <th scope="row"><?=$p->$pitanje?></th>
     <?php 
     
     $upit="Select $pitanje, count($pitanje) as broj from anketa GROUP BY $pitanje";
      $rezultat=$konekcija->query($upit);
      $rez=$rezultat->fetchAll(); 
    foreach($rez as $r):?>
     <th scope="row"><?= $r->$pitanje; ?></th>
    <td><?= $r->broj;?> of <?= $uradjenih ?></td>
      <?php endforeach ?>
    </tr>

    <?php endforeach;?>
<?php endforeach;?>
  </tbody>
</table>
          <!--<div class="row">-->
          <!--  <div class="col-lg-3 col-md-6 col-sm-6">-->
          <!--    <div class="card card-stats">-->
          <!--      <div class="card-header card-header-warning card-header-icon">-->
          <!--        <div class="card-icon">-->
          <!--          <i class="material-icons">content_copy</i>-->
          <!--        </div>-->
          <!--        <p class="card-category">Used Space</p>-->
          <!--        <h3 class="card-title">49/50-->
          <!--          <small>GB</small>-->
          <!--        </h3>-->
          <!--      </div>-->
          <!--      <div class="card-footer">-->
          <!--        <div class="stats">-->
          <!--          <i class="material-icons text-danger">warning</i>-->
          <!--          <a href="javascript:;">Get More Space...</a>-->
          <!--        </div>-->
          <!--      </div>-->
          <!--    </div>-->
          <!--  </div>-->
          <!--  <div class="col-lg-3 col-md-6 col-sm-6">-->
          <!--    <div class="card card-stats">-->
          <!--      <div class="card-header card-header-success card-header-icon">-->
          <!--        <div class="card-icon">-->
          <!--          <i class="material-icons">store</i>-->
          <!--        </div>-->
          <!--        <p class="card-category">Revenue</p>-->
          <!--        <h3 class="card-title">$34,245</h3>-->
          <!--      </div>-->
          <!--      <div class="card-footer">-->
          <!--        <div class="stats">-->
          <!--          <i class="material-icons">date_range</i> Last 24 Hours-->
          <!--        </div>-->
          <!--      </div>-->
          <!--    </div>-->
          <!--  </div>-->
          <!--  <div class="col-lg-3 col-md-6 col-sm-6">-->
          <!--    <div class="card card-stats">-->
          <!--      <div class="card-header card-header-danger card-header-icon">-->
          <!--        <div class="card-icon">-->
          <!--          <i class="material-icons">info_outline</i>-->
          <!--        </div>-->
          <!--        <p class="card-category">Fixed Issues</p>-->
          <!--        <h3 class="card-title">75</h3>-->
          <!--      </div>-->
          <!--      <div class="card-footer">-->
          <!--        <div class="stats">-->
          <!--          <i class="material-icons">local_offer</i> Tracked from Github-->
          <!--        </div>-->
          <!--      </div>-->
          <!--    </div>-->
          <!--  </div>-->
          <!--  <div class="col-lg-3 col-md-6 col-sm-6">-->
          <!--    <div class="card card-stats">-->
          <!--      <div class="card-header card-header-info card-header-icon">-->
          <!--        <div class="card-icon">-->
          <!--          <i class="fa fa-twitter"></i>-->
          <!--        </div>-->
          <!--        <p class="card-category">Followers</p>-->
          <!--        <h3 class="card-title">+245</h3>-->
          <!--      </div>-->
          <!--      <div class="card-footer">-->
          <!--        <div class="stats">-->
          <!--          <i class="material-icons">update</i> Just Updated-->
          <!--        </div>-->
          <!--      </div>-->
          <!--    </div>-->
          <!--  </div>-->
          <!--</div>-->
          <!--<div class="row">-->
          <!--  <div class="col-md-4">-->
          <!--    <div class="card card-chart">-->
          <!--      <div class="card-header card-header-success">-->
          <!--        <div class="ct-chart" id="dailySalesChart"></div>-->
          <!--      </div>-->
          <!--      <div class="card-body">-->
          <!--        <h4 class="card-title">Daily Sales</h4>-->
          <!--        <p class="card-category">-->
          <!--          <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>-->
          <!--      </div>-->
          <!--      <div class="card-footer">-->
          <!--        <div class="stats">-->
          <!--          <i class="material-icons">access_time</i> updated 4 minutes ago-->
          <!--        </div>-->
          <!--      </div>-->
          <!--    </div>-->
          <!--  </div>-->
          <!--  <div class="col-md-4">-->
          <!--    <div class="card card-chart">-->
          <!--      <div class="card-header card-header-warning">-->
          <!--        <div class="ct-chart" id="websiteViewsChart"></div>-->
          <!--      </div>-->
          <!--      <div class="card-body">-->
          <!--        <h4 class="card-title">Email Subscriptions</h4>-->
          <!--        <p class="card-category">Last Campaign Performance</p>-->
          <!--      </div>-->
          <!--      <div class="card-footer">-->
          <!--        <div class="stats">-->
          <!--          <i class="material-icons">access_time</i> campaign sent 2 days ago-->
          <!--        </div>-->
          <!--      </div>-->
          <!--    </div>-->
          <!--  </div>-->
          <!--  <div class="col-md-4">-->
          <!--    <div class="card card-chart">-->
          <!--      <div class="card-header card-header-danger">-->
          <!--        <div class="ct-chart" id="completedTasksChart"></div>-->
          <!--      </div>-->
          <!--      <div class="card-body">-->
          <!--        <h4 class="card-title">Completed Tasks</h4>-->
          <!--        <p class="card-category">Last Campaign Performance</p>-->
          <!--      </div>-->
          <!--      <div class="card-footer">-->
          <!--        <div class="stats">-->
          <!--          <i class="material-icons">access_time</i> campaign sent 2 days ago-->
          <!--        </div>-->
          <!--      </div>-->
          <!--    </div>-->
          <!--  </div>-->
          <!--</div>-->
          <div class="row">
            <div class="col-lg-10 m-auto col-md-12"> 
              <div class="card">
                <div class="card-header card-header-warning">
                  <h4 class="card-title">Messages</h4>
                  <p class="card-category">for admin team</p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <!-- <thead class="text-warning">
                      <th>ID</th>
                      <th>Name</th>
                      <th>Salary</th>
                      <th>Country</th>
                    </thead> -->
                    <tbody id="por">
                    <?php
                    $podaci=prikaz("poruka");
                    foreach($podaci as $p):
                    ?>
                      <tr>
                        <td><?= $p->IdPoruka?></td>
                        <td><?= $p->Naslov?></td>
                        <td><?= $p->Poruka?></td>
                        <td><?= $p->Ime?></td>
                        <td><?= $p->Email?></td>
                                                <td><a class="waves-effect waves-light btn-small deletePoruka"  role="" data-naziv="IdPoruka" data-table="poruka" data-id="<?=$p->IdPoruka?>" href="#">Delete</a></td>

                      </tr>
                      <!-- <tr>
                        <td>2</td>
                        <td>Minerva Hooper</td>
                        <td>$23,789</td>
                        <td>Curaçao</td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>Sage Rodriguez</td>
                        <td>$56,142</td>
                        <td>Netherlands</td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td>Philip Chaney</td>
                        <td>$38,735</td>
                        <td>Korea, South</td>
                      </tr> -->
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
include "../dashfixed/footer.php";?>