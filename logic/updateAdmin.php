<?php
 header("Content-type: application/json");
 include $_SERVER['DOCUMENT_ROOT'].'/konekcija/konekcija.php';
 include $_SERVER['DOCUMENT_ROOT']."/logic/funkcije.php";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        try{
        $uspeh=update($_POST);
        echo json_encode($uspeh);
        return $uspeh;
        }
        catch(PDOException $exception){
            http_response_code(500);
        }
    }
    else{
        http_response_code(404);
    }
?>