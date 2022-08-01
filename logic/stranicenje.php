<?php
 header("Content-type: application/json");
 include $_SERVER['DOCUMENT_ROOT'].'/konekcija/konekcija.php';
 include $_SERVER['DOCUMENT_ROOT']."/logic/funkcije.php";
 
 //prikaz za proizvode po kategorijama
 if($_SERVER['REQUEST_METHOD']=='POST'){
    try{
        // if(isset($_POST['NazivKat'])){
        if((isset($_POST['NazivKat'])) && $_POST['NazivKat']!="All"){
         
            $kat=$_POST['NazivKat'];
            //var_dump($kat);
            $broj= filtriraniProizvodi($kat, "k.NazivKat");
        $b=count($broj);
        $rezultat=stranicenje($b);
        //svar_dump($b);
        }
        else{
            $proizvod="proizvod";
            $broj= prikaz($proizvod);
        $b=count($broj);
        $rezultat=stranicenje($b);
        }
        echo json_encode($rezultat);
        return $rezultat;
      }
    catch(PDOException $e){
        echo $e->getMessage();
        http_response_code(500);
    }
}
 else{
     http_response_code(404); }
 ?>