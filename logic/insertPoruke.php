<?php
 header("Content-type: application/json");
 include $_SERVER['DOCUMENT_ROOT'].'/konekcija/konekcija.php';
 include $_SERVER['DOCUMENT_ROOT']."/logic/funkcije.php";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

         try{
            //var_dump($_POST);
         $uspeh=insert($_POST);
            // var_dump($uspeh);
            echo json_encode($uspeh);
        // return $uspeh;
    }
    catch(PDOException $e){
        echo $e->getMessage();
        http_response_code(500);
    }}
    else{
        http_response_code(404);
    }
?>