<?php 
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/konekcija/konekcija.php';
if(isset($_POST['dugme'])){
$ime=$_POST['imeObj'];
$prezime=$_POST['prezObj'];
$email=$_POST['emailObj'];
$pass=$_POST['passObj'];
$regimeprezime='/^[A-ZČĆŠĐŽ][a-zšđčćž]{1,}$/';
$regemail='/^[\w\d\.-]+@[a-z]{2,}\.[a-z]{2,3}$/';
$regpass='/^.{5,}$/';
//var_dump($ime, $prezime,$email,$pass);
$greske=[];
if(!preg_match($regimeprezime,$ime) || $ime=""){
$greske[]="Ime nije upisano dobro.";
}
if(!preg_match($regimeprezime,$prezime) || $prezime=""){
    $greske[]="Prezime nije upisano dobro.";
    }
    if(!preg_match($regemail,$email) || $email=""){
        $greske[]="Email nije upisano dobro.";
        }
    if(!preg_match($regpass,$pass) || $pass=""){
            $greske[]="Lozinka nije upisano dobro.";
    }
    if(count($greske)==0){
        $sifrovanaloz=md5($_POST['passObj']);
        $kod=sha1(md5(time()));
        $imeSlash=addslashes($_POST['imeObj']);
        $prezieSlash=addslashes($_POST['prezObj']);
        $emailSlash=addslashes($_POST['emailObj']);
        $upit="INSERT INTO korisnik(Ime,Prezime,Email,Lozinka,IdUloga,KodEmail) VALUES(:ime, :prezime,:email,:lozinka,1,:kod)";
        $priprema=$konekcija->prepare($upit);
        $priprema->bindParam(':ime',$imeSlash);
        $priprema->bindParam(':prezime',$prezieSlash);
        $priprema->bindParam(':email',$emailSlash);
        $priprema->bindParam(':lozinka',$sifrovanaloz);
        $priprema->bindParam(':kod',$kod);
        try{
           mail($email,"Furn sign up", "potvrdiregistraciju.php?kod=".$kod);
            $rez=$priprema->execute();
            $_SESSION['uspeh']="USPESNA REGISTRACIJA.";
            http_response_code(201);
            header("Location:../login.php");
            $poruka="You are registered now! Login!";
            echo json_encode($poruka);
            // return $_SESSION['uspeh'];
            
        }
        catch(PDOException $e){
            //echo $e->getMessage();
            //http_response_code(500);
            // $_SESSION['greske']="Email vec postoji.";
            // header('Location:../register.php');
             $poruka="Email already exists!";
           echo json_encode($poruka);
        }
    }
    else{ $_SESSION['greske']=$greske;
        header('Location:../register.php');
    }

}
else{
 http_response_code(404);
}
?>