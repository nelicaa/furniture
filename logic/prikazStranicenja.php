<?php
header('Content-type:application/json');
include $_SERVER['DOCUMENT_ROOT'].'/konekcija/konekcija.php';
include $_SERVER['DOCUMENT_ROOT'].'/logic/funkcije.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
try{
    if((isset($_POST['NazivKat'])) && $_POST['NazivKat']!="All"){
            $broj_strane=$_POST['broj'];
            $kat=$_POST['NazivKat'];
            
            //var_dump($kat);
          $kategorije=prikazStranicenjaLimit($broj_strane,$kat);
    echo json_encode($kategorije);
    //return $kat;
    }    
        
    else{  
            $broj_strane=$_POST['broj'];
            $broj=($broj_strane-1)*3;
    $upit="Select p.*,c.*, s.* from proizvod p INNER JOIN cena c INNER JOIN slikaproizvod s INNER JOIN kategorije k ON c.IdCena = (SELECT IdCena FROM cena WHERE p.IdP = IdP ORDER BY Datum DESC LIMIT 1) AND s.Idp=p.IdP AND p.IdK=k.IdK LIMIT 3 OFFSET $broj";
    $rezultat=$konekcija->query($upit);
    // $rezultat->bindParam(":ime",$kat);
    $rezultat->execute();
    $kategorije=$rezultat->fetchAll();
    echo json_encode($kategorije);
        }

}
catch(PDOException $e){
    http_response_code(500);
}

}
else{
    http_response_code(404);
}

?>