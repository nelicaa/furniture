<?php
header("Content-type: application/json");
include $_SERVER['DOCUMENT_ROOT'].'/konekcija/konekcija.php';
include $_SERVER['DOCUMENT_ROOT']."/logic/funkcije.php";

//prikaz za proizvode po kategorijama
if(isset($_POST['tabela'])){
  $tabela=$_POST['tabela'];
  $id=$_POST['id'];
  $nazivKolone=$_POST['nazivKolone'];
  if($tabela=="proizvod"){
    try{
      $cena=delete("cena",$nazivKolone,$id);
      $cena->execute();
      $slike=delete("slikaproizvod",$nazivKolone,$id);
      $slike->execute();
      $priprema=delete($tabela,$nazivKolone,$id);
      $priprema->execute();
        $upit="SELECT p.IdP, k.NazivKat, p.Name, p.Description, p.Visina, p.Tezina, p.Dubina, p.Sirina, p.QualityCheck, p.Availability, c.Iznos, c.Datum, s.alt,s.src from proizvod p INNER JOIN cena c INNER JOIN slikaproizvod s INNER JOIN kategorije k ON p.IdP=c.IdP AND s.Idp=p.IdP AND p.IdK=k.IdK";
        $rezultat=$konekcija->query($upit);
        $rez=$rezultat->fetchAll();
        if($rezultat->rowCount()>0){
        echo json_encode($rez);
         return $rez;
      }
    }
    catch(PDOException $e){
      echo $e->getMessage();
      http_response_code(500);
  }

  }
  else{
   //var_dump($id,$tabela,$nazivKolone);
      $priprema=delete($tabela,$nazivKolone,$id);
      try{
      $priprema->execute();
      if($tabela=="komentari"){$proizvodi=adminKom();}
      else if($tabela=="korisnik"){
        $proizvodi=selectKorisnici();
      }
      else if($tabela=="poruka"){$proizvodi=prikaz($tabela);

      }
      else{
        $proizvodi=sveTabele($_POST['obj']);
      }
   echo json_encode($proizvodi);
      return $proizvodi;
     }
   catch(PDOException $e){
       echo $e->getMessage();
       http_response_code(500);
   }}
}
else{
    http_response_code(404); }
?>