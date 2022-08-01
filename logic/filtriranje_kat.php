<?php
 header("Content-type: application/json");
 include $_SERVER['DOCUMENT_ROOT'].'/konekcija/konekcija.php';
 include $_SERVER['DOCUMENT_ROOT']."/logic/funkcije.php";
 
 //prikaz za proizvode po kategorijama
 if($_SERVER['REQUEST_METHOD']=='POST'){
  
    $Kat=$_POST['NazivKat'];
    //var_dump($Kat);
    $kategorije="";
    try{
        //var_dump($Kat);
        if($Kat=="All"){
           $kategorije=ispisiPorizvod();
             
         }
         else{
             $kategorije=prikazStranicenjaLimit(1,$Kat);
         }
         
         echo json_encode($kategorije);
      }
    catch(PDOException $e){
        echo $e->getMessage();
        http_response_code(500);
    }
}
 else{
     http_response_code(404); }
 ?>