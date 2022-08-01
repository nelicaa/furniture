<?php
 header("Content-type: application/json");
 include $_SERVER['DOCUMENT_ROOT'].'/konekcija/konekcija.php';
 include $_SERVER['DOCUMENT_ROOT']."/logic/funkcije.php";


 // za prikaz proizvoda u galeriji
 if($_SERVER['REQUEST_METHOD']=='POST'){

    try{
        $resenje=ispisiPorizvod();
        echo json_encode($resenje);
         return $resenje;
      }
    catch(PDOException $e){
        echo $e->getMessage();
        http_response_code(500);
    }
}
 else{
     http_response_code(404); }
 ?>