<?php include "podaci.ini";
try{
//$konekcija=new PDO("mysql:host=".$host.";dbname=$dbname.",$username,$pass);

$konekcija=new PDO('mysql:host='.$host.';dbname='.$dbname.'',$username,$pass);
$konekcija->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$konekcija->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

}
catch(PDOException $e){
    echo "Nije povezano sa bazom. Greska je:". $e->getMessage();
}


?>