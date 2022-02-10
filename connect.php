<?php
$tns = "quizzapp_high"; 

$user = "quizzteam2"; 

$password = "QuizzApp9755"; 



try { 

     $conn = new PDO("oci:dbname=".$tns, $user, $password); 

     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

     

} catch(PDOException $e) { 

     echo 'ERROR: ' . $e->getMessage(); 

} 

?>