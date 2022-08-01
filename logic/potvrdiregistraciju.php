<?php
 header("Content-type: application/json");
 include $_SERVER['DOCUMENT_ROOT'].'/konekcija/konekcija.php';
 include $_SERVER['DOCUMENT_ROOT']."/logic/funkcije.php";


 // za prikaz proizvoda u galeriji
 if(isset($_GET['kod'])){
    try{
        $upit="SELECT * FROM korisnik where KodEmail=:kod";
        $rez=$konekcija->prepare($upit);
        $rez->bindParam(":kod",$_GET['kod']);
        $rez->execute();
        if($rez->rowCount()==1){
            $korisnik=$rez->fetch();
            $update=$konekcija->prepare("UPDATE korisnik SET Aktivan=1 WHERE KodEmail=:kod");
            $update=$konekcija->prepare($upit);
        $update->bindParam(":kod",$_GET['kod']);
        $update->execute();
        header("Location:../index.php");
        }
        else{
            http_response_code(404);
            echo "<h1>KOD NIJE ISPRAVAN</h1>";
        }
      }
    catch(PDOException $e){
        echo $e->getMessage();
        http_response_code(500);
    }
}
 else{
     http_response_code(404); }
 ?>