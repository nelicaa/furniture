<?php
 header("Content-type: application/json");
 include $_SERVER['DOCUMENT_ROOT'].'/konekcija/konekcija.php';
 include $_SERVER['DOCUMENT_ROOT']."/logic/funkcije.php";


 // za prikaz proizvoda u galeriji
 if($_SERVER['REQUEST_METHOD']=='POST'){

    try{
        $upit="SELECT p.IdP, k.NazivKat, p.Availability, p.Name, p.Description, p.Visina, p.Tezina, p.Dubina, p.Sirina, p.QualityCheck, c.Iznos, c.Datum, s.alt,s.src from proizvod p INNER JOIN cena c INNER JOIN slikaproizvod s INNER JOIN kategorije k ON p.IdP=c.IdP AND s.Idp=p.IdP AND p.IdK=k.IdK";
        $rezultat=$konekcija->query($upit);
        $rez=$rezultat->fetchAll();
        if($rezultat->rowCount()>0){
        echo json_encode($rez);
         return $rez;
      }}
    catch(PDOException $e){
        echo $e->getMessage();
        http_response_code(500);
    }
}
 else{
     http_response_code(404); }
 ?>