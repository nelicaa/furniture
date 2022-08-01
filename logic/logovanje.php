<?php
session_start();
header('Content-type:application/json');
include $_SERVER['DOCUMENT_ROOT'].'/konekcija/konekcija.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
$emailS=$_POST['email'];
$passS=md5($_POST['pass']);
$regemail='/^[\w\d\.-]+@[a-z]{2,}\.[a-z]{2,3}$/';
$regpass='/^.{5,}$/';
$greske=[];
    if(!preg_match($regemail,$emailS) || $emailS=""){
        $greske[]="Email nije upisano dobro.";
        }
    if(!preg_match($regpass,$_POST['pass']) || $_POST['pass']=""){
            $greske[]="Lozinka nije upisano dobro.";
    }
    if(count($greske)==0){
$email=addslashes($_POST['email']);
$pass=addslashes($passS);
try{
    $upit="SELECT u.Uloga, k.IdKorisnik, k.Ime, k.Prezime, k.Email FROM uloge u INNER JOIN korisnik k ON k.IdUloga=u.IdUloga WHERE k.Email=:email AND k.Lozinka=:pass";
    $rezultat=$konekcija->prepare($upit);
    $rezultat->bindParam(":email",$email);
    $rezultat->bindParam(":pass",$pass);
    $rezultat->execute();
    if($rezultat->rowCount()==1){
        $rez=$rezultat->fetch();
        $_SESSION['ulogovan']=$rez;
    $true=true;
    echo json_encode($true);
    return $true;
    }
    else{
        $false=false;
        echo json_encode($false);
        return $false;
    }

}
catch(PDOException $e){
    http_response_code(500);
    echo $e->getMessage();
}


}

}
else{
    http_response_code(404);
}

?>