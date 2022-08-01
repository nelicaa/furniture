<?php
 header("Content-type: application/json");
 include $_SERVER['DOCUMENT_ROOT'].'/konekcija/konekcija.php';
 include $_SERVER['DOCUMENT_ROOT']."/logic/funkcije.php";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        try{
          $rez=adminKom();
            http_response_code(200);
            echo json_encode($rez);
            return $rez;
        }
        catch(PDOException $exception){
            http_response_code(500);
        }
    }
    else{
        http_response_code(404);
    }
?>

