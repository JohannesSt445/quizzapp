<?php
require 'connect.php';

$query = $conn->query("select * from kategorie");
echo 'Command executed<br>'; 

  

        $rows = $query->fetchAll(); 

  

        print_r($rows);  
?>