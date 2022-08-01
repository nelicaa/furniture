<?php
 header("Content-type: application/json");
 include $_SERVER['DOCUMENT_ROOT'].'/konekcija/konekcija.php';
 include $_SERVER['DOCUMENT_ROOT']."/logic/funkcije.php";
if($_SERVER['REQUEST_METHOD'] == 'POST'){


    try{
        $niz=[];
       foreach($_POST as $p){
           array_push($niz,$p);
       }
       $objekat =array("tabela"=>"anketa", "vrednosti"=>$niz);
   $insert=insert($objekat);
   var_dump($insert);
       if($insert){
        $_SESSION['anketa']=$_POST['IdK'];
       }
       echo json_encode($insert);
       header("Location:../index.php");
      }
    catch(PDOException $e){
        echo $e->getMessage();
        http_response_code(500);
    }
}
 else{
     http_response_code(404); }
 ?>