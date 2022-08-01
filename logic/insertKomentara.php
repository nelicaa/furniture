<?php 
header('Content-type:application/json');
include $_SERVER['DOCUMENT_ROOT'].'/konekcija/konekcija.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
// $ime=$_POST['Imeobj'];
// $prezime=$_POST['Prezimeobj'];
$komentar=$_POST['komentarobj'];
$email=$_POST['Emailobj'];
// $regimeprezime='/^[A-ZČĆŠĐŽ][a-zšđčćž]{1,10}$/';
$regemail='/^[\w\d\.-]+@[a-z]{2,}\.[a-z]{2,3}$/';
$greske=[];
// if(!preg_match($regimeprezime,$ime) || $ime=""){
// $greske[]="Ime nije upisano dobro.";
// }
// if(!preg_match($regimeprezime,$prezime) || $prezime=""){
//     $greske[]="Prezime nije upisano dobro.";
//     }
    if(!preg_match($regemail,$email) || $email=""){
        $greske[]="Email nije upisano dobro.";
        }
    if($komentar=""){
            $greske[]="Komentar ne moze da bude prazan string.";
    }
    if(count($greske)==0){
        try{
        $idP=$_POST['idP'];
        $emailS=addslashes($_POST['Emailobj']);
        $komentarS=addslashes($_POST['komentarobj']);
        $korisnik="SELECT IdKorisnik from korisnik WHERE Email=:email";
        $rezultat=$konekcija->prepare($korisnik);
        $rezultat->bindParam(':email',$emailS);
        $rezultat->execute();
        $rez=$rezultat->fetch();
        //var_dump($idP);
        $id=$rez->IdKorisnik;
        $upit="INSERT INTO komentari(Komentar,IdK,IdP) VALUES(:komentar,:id, :idP)";
        $priprema=$konekcija->prepare($upit);
        $priprema->bindParam(':komentar',$komentarS);
        $priprema->bindParam(':id',$id);
        $priprema->bindParam(':idP',$idP);
        $priprema->execute();
        $poruka="Your comment is added!";
        echo json_encode($poruka);
        
       // return $priprema;
            
        }
        catch(PDOException $e){
            echo $e->getMessage();
            http_response_code(500);
            header('Location:../product.php');
        }
    }

}
else{
    http_response_code(404);
}
?>