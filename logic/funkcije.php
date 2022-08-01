<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/konekcija/konekcija.php";
//funkcija za ispisivanje menija
function ispisMenija(){
    global $konekcija;
    $upit="Select * from menu";
    $rezultat=$konekcija->query($upit);
    $rez=$rezultat->fetchAll();
    if($rezultat->rowCount()>0){
    foreach($rez as $red){
        if(isset($_SESSION['ulogovan']) && $red->Naziv == "Poll" && $_SESSION['ulogovan']->Uloga == "Korisnik"){
            echo "<li><a href='".$red->Putanja."'>$red->Naziv</a></li>";
            continue;
        } 
        if(isset($_SESSION['ulogovan']) && $red->Naziv == "Dashboard" && $_SESSION['ulogovan']->Uloga == "Admin"){
            echo "<li><a href='".$red->Putanja."'>$red->Naziv</a></li>";
            continue;
        } 
        if($red->Naziv == "Home" || $red->Naziv == "Gallery" || $red->Naziv == "Docs" || $red->Naziv == "Category" || $red->Naziv == "About me" || $red->Naziv == "Contact"){
            echo "<li><a href='".$red->Putanja."'>$red->Naziv</a></li>";
        }
}
    }


}


//dohvatanje svih proizvoda
function odredjeno($tabela,$ime,$kolona){
    global $konekcija;
    $upit="Select * from $tabela where $kolona=:ime";
    $rezultat=$konekcija->prepare($upit);
    $rezultat->bindParam(":ime",$ime);
    $rezultat->execute();
    $rez=$rezultat->fetchAll();
    return $rez;

}

//funkcija za dohvatanje i ispisivanje kategorija iz baze
function ispisKategorija(){
    global $konekcija;
    $upit="Select * from kategorije";
    $rezultat=$konekcija->query($upit);
    $rez=$rezultat->fetchAll();
    if($rezultat->rowCount()>0){
        foreach($rez as $red){
            echo '<a class="nav-item nav-link kat" id="'.$red->NazivKat.'" data-toggle="tab" href="#nav-Sofa" role="tab" aria-controls="nav-Sofa" aria-selected="true">'.$red->NazivKat.'</a>';
        }}
}


//ispisivanje pojedinacno proizvoda
function ispisiPorizvod(){
    global $konekcija;
    // $broj= prikaz("proizvod");
    // $b=count($broj);
    // $broj=$b;
    //var_dump($b);
        $upit="SELECT p.*,c.*, s.* from proizvod p INNER JOIN cena c INNER JOIN slikaproizvod s INNER JOIN kategorije k ON c.IdCena = (SELECT IdCena FROM cena WHERE p.IdP = IdP ORDER BY Datum DESC LIMIT 1) AND s.Idp=p.IdP AND p.IdK=k.IdK LIMIT 3";

    $rezultat=$konekcija->query($upit);
    $rez=$rezultat->fetchAll();
    //var_dump($rez);
    if($rezultat->rowCount()>0){
    return $rez;
    }}

//filtriranje proizvoda na stranici galerija
function filtriraniProizvodi($ime,$uporedjivanje){
    global $konekcija;
       $upit="Select p.*,c.*, s.*, k.NazivKat from proizvod p INNER JOIN cena c INNER JOIN slikaproizvod s INNER JOIN kategorije k ON c.IdCena = (SELECT IdCena FROM cena WHERE p.IdP = IdP ORDER BY Datum DESC LIMIT 1) AND s.Idp=p.IdP AND p.IdK=k.IdK WHERE ".$uporedjivanje."=:ime";
    $rezultat=$konekcija->prepare($upit);
    $rezultat->bindParam(":ime",$ime);
    $rezultat->execute();
    // if($rezultat->rowCount()==1){
        $kategorije=$rezultat->fetchAll();
    
    return $kategorije;
}

function prikazStranicenjaLimit($broj_strane,$kat){
    global $konekcija;
    $broj=($broj_strane-1)*3;
    $upit="Select p.*,c.*, s.*, k.NazivKat from proizvod p INNER JOIN cena c INNER JOIN slikaproizvod s INNER JOIN kategorije k ON c.IdCena = (SELECT IdCena FROM cena WHERE p.IdP = IdP ORDER BY Datum DESC LIMIT 1) AND s.Idp=p.IdP AND p.IdK=k.IdK WHERE k.NazivKat=:ime LIMIT 3 OFFSET $broj";
    $rezultat=$konekcija->prepare($upit);
    $rezultat->bindParam(":ime",$kat);
    $rezultat->execute();
    $kategorije=$rezultat->fetchAll();
    return $kategorije;
}
 //dohvatanje za admin panel
 function prikaz($data){
 global $konekcija;
 $upit="Select * from $data";
 $rezultat=$konekcija->query($upit);
 $rez=$rezultat->fetchAll();
 return $rez;
 }


 function stranicenje($brojKolona){
    $broj_strana=(int)ceil($brojKolona/3);
    return $broj_strana;
 }


 //funkcija za vracanje komentara za proizvode pojedinacno
 function komentari($id){
     global $konekcija;
     $upit="SELECT k.*, kor.Ime, kor.Prezime  from komentari k INNER JOIN proizvod p INNER JOIN korisnik kor ON k.IdP=p.IdP and kor.IdKorisnik=k.IdK WHERE p.IdP=:id";
    $priprema=$konekcija->prepare($upit);
    $priprema->bindParam(":id",$id);
    $priprema->execute();
   // $priprema->stripslashes()

     return $priprema;
 }

 function sveTabele($data){
    $podaci = [];
    
    foreach($data as $d){
        array_push($podaci, prikaz($d));
    }
    return $podaci;
 }
 
 function update($data){
     global $konekcija;
     $id=$data['id'];
     $tabela=$data['tabela'];
     $nazivKolone=$data['nazivKolone'];
     $vrednost=$data['vrednost'];
     $red=$data['red'];
$upit="UPDATE $tabela SET "; 
for($i = 0; $i < count($vrednost); $i++){
    if($i+1==count($vrednost)){
            $upit.=''.$red[$i].'="'.$vrednost[$i].'" ';
    }
    else{
        $upit.=''.$red[$i].'="'.$vrednost[$i].'", ';
    }
};
$upit.="WHERE $nazivKolone=:id";
$rez=$konekcija->prepare($upit);
$rez->bindParam(":id",$id);
$rez->execute();
return $rez;


 }

 function adminKom(){
     global $konekcija;
    $upit="SELECT kom.IdKom, kom.Komentar, kom.Datum, k.Ime, k.Prezime, k.Email, p.Name FROM proizvod p INNER JOIN komentari kom INNER JOIN korisnik k ON k.IdKorisnik=kom.IdK AND kom.IdP=p.IdP";
    $rezultat=$konekcija->query($upit);
    $rezultat->execute();
    $rez=$rezultat->fetchAll();
    return $rez;
 }

function selectKorisnici(){
    global $konekcija;
    $upit="Select k.IdKorisnik, k.Ime, k.Prezime, k.Email, k.Datum, u.Uloga from korisnik k INNER JOIN uloge u ON k.IdUloga=u.IdUloga";
            $rezultat=$konekcija->query($upit);
            $proizvodi=$rezultat->fetchAll();
            return $proizvodi;
}


 function delete($tabela,$nazivKolone,$id){
     global $konekcija;
    $upit="DELETE from $tabela where $nazivKolone=:id";
    $priprema=$konekcija->prepare($upit);
    $priprema->bindParam(":id",$id);
    return $priprema;
 }

 function insert($data){
     global $konekcija;
     $tabela=$data['tabela'];
     $vrednosti=$data['vrednosti'];
     //var_dump($tabela);
     $upit="INSERT INTO $tabela VALUES (";
    for($i = 0; $i < count($vrednosti); $i++){
        if($i+1==count($vrednosti)){
            $upit.=":$i) ";
            //var_dump($vrednosti);
    }
    else{
        $upit.=":$i, ";
    }
    }
    //var_dump($upit);
    $rez=$konekcija->prepare($upit);
    for($i = 0; $i < count($vrednosti); $i++){
        $rez->bindParam(":$i",$vrednosti[$i]);
    }
    $rez->execute();
    return $rez;
    //var_dump($upit);
 }
?>
