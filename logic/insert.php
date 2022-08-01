<?php
 header("Content-type: application/json");
 include $_SERVER['DOCUMENT_ROOT'].'/konekcija/konekcija.php';
 include $_SERVER['DOCUMENT_ROOT']."/logic/funkcije.php";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        try{
        $uspeh=insert($_POST);
        if($uspeh){
            //  var_dump($_POST['obj']);
            $proizvodi=sveTabele($_POST['obj']);
        }
        echo json_encode($proizvodi);
        return $proizvodi;
         }
        catch(PDOException $exception){
            var_dump($exception->getMessage());
            http_response_code(500);
        }
    }
    else{
        http_response_code(404);
    }
?>
