<?php
require 'connect.php';

$sql = $conn->prepare("SELECT * FROM kategorie");
print($sql);


?>