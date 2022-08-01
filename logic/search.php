<?php
header('Content-type:application/json');
include $_SERVER['DOCUMENT_ROOT'].'/konekcija/konekcija.php';
if($_SERVER['REQUEST_METHOD']=="POST"){

try{
 $vrednost=$_POST['vrednost'];
 $upit="SELECT p.*, c.Iznos, s.* FROM proizvod p INNER JOIN kategorije k INNER JOIN slikaproizvod s INNER JOIN cena c ON p.IdP=c.IdP AND s.IdP=p.IdP AND p.IdK=k.IdK WHERE p.Name LIKE '%$vrednost%' OR k.NazivKat LIKE '%$vrednost%'";
 $rezultat=$konekcija->query($upit);
 $rez=$rezultat->fetchAll();

 echo json_encode($rez);

}
catch(PDOException $e){
    http_response_code(500);
    echo $e->getMessage();
}


}
else{
    http_response_code(404);
}

?>