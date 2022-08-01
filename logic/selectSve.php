<?php
 header("Content-type: application/json");
 include $_SERVER['DOCUMENT_ROOT'].'/konekcija/konekcija.php';
 include $_SERVER['DOCUMENT_ROOT']."/logic/funkcije.php";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        try{

            $rez=selectKorisnici();
            // $upit="Select k.IdKorisnik, k.Ime, k.Prezime, k.Email, k.Datum, u.Uloga from korisnik k INNER JOIN uloge u ON k.IdUloga=u.IdUloga";
            // $rezultat=$konekcija->query($upit);
            // $rez=$rezultat->fetchAll();
        echo json_encode($rez);
        return $rez;
    }
    catch(PDOException $e){
        http_response_code(500);
    }}
    else{
        http_response_code(404);
    }
?>