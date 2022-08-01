<?php
 header("Content-type: application/json");
 include $_SERVER['DOCUMENT_ROOT'].'/konekcija/konekcija.php';
 include $_SERVER['DOCUMENT_ROOT']."/logic/funkcije.php";
 if($_SERVER['REQUEST_METHOD']=='POST'){
    try{
//var_dump($_POST);
if($_POST['QualityCheck']){
    $q=1;
}
else{$q=0;}
if($_POST['Availability']){
    $A=1;
}
else{$A=0;}
$upit="INSERT INTO proizvod(IdK, Availability, Name, Description, Visina, Sirina, Dubina, Tezina, QualityCheck) VALUES (:id,:avail,:name,:desc,:visina,:sirina,:dubina,:tezina,:q) ";
$rezultat=$konekcija->prepare($upit);
    $rezultat->bindParam(":id",$_POST['IdK']);
    $rezultat->bindParam(":avail",$A);
    $rezultat->bindParam(":name",$_POST['Name']);
    $rezultat->bindParam(":desc",$_POST['Description']);
    $rezultat->bindParam(":visina",$_POST['Visina']);
    $rezultat->bindParam(":sirina",$_POST['Sirina']);
    $rezultat->bindParam(":dubina",$_POST['Dubina']);
    $rezultat->bindParam(":tezina",$_POST['Tezina']);
    $rezultat->bindParam(":q",$q);
    $rezultat->execute();
    $upit1="SELECT IdP from proizvod ORDER BY IdP DESC LIMIT 1";
    $rez=$konekcija->query($upit1);
    $id=$rez->fetch();
    $id=$id->IdP;
$slika="INSERT INTO slikaproizvod(alt,src,IdP) VALUES (:alt,:src,:id)";
$rez=$konekcija->prepare($slika);
$rez->bindParam(":id",$id);
$rez->bindParam(":alt",$_POST['alt']);
$rez->bindParam(":src",$_POST['src']);
$rez->execute();
$cena="INSERT INTO cena(Iznos, IdP) VALUES (:cena,:id)";
$r=$konekcija->prepare($cena);
$r->bindParam(":id",$id);
$r->bindParam(":cena",$_POST['Iznos']);
$r->execute();
    $poruka="INSERETED!";
    echo json_encode($poruka);

      }
    catch(PDOException $e){
        echo $e->getMessage();
        http_response_code(500);
    }
}
 else{
     http_response_code(404); }
 ?>