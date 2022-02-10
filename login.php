<?php
require "connect.php";

if(isset($_GET['id'])){
    $sql = "select from kategorie where id = " . $_GET['id'];
    $conn->query($sql);
}

$output = '';
	$output .= '<table align="center" width="200" border="1">';
	$output .= '<tr><th>id</th><th>id</th><th>Kategorie</th></tr>';
	
	foreach($pdo -> query('SELECT * FROM kategorie') as $row){
		$output .= "<tr><td>" . $row['id'] . "</td><td>" . $row['kategorie'] . "</td><td></tr>";
	}
	
	$output .= '</table>';
	
	echo $output;


?>