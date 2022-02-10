<!doctype html>

<html>

<head>

 <title>Login</title>

<meta charset= "utf-8">

</head>

<body>

<?php

$m = null;

//if(isset($_POST['sub'])){



    $tns = "quizzapp_high"; 

    $user = "quizzteam2"; 
    
    $password = "QuizzApp9755"; 
    
    $conn = new PDO("oci:dbname=".$tns, $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

$u = $_POST['User'];

$p = $_POST['Passwort'];
 

        //oracle

//$stmt = $conn->prepare("SELECT * FROM account WHERE name = :user"); 
//$stmt ->execute(array('user' => $u));
//$log = $stmt->fetchAll();


/*
oci_bind_by_name($stid, ':user',$_POST['User']);



oci_execute($stid);

while (($row = oci_fetch_array($stid, OCI_BOTH)) != false)

{

 

$pass = $row[2];

}

 



 if($p == $pass) { // ob das eingegebene Passwort mit dem in der Datenbank übereinstimmt

session_start();

 $_SESSION ['Benutzer'] = $u; // Session Variable

header('Location: sicher.php');

 }

        // wenn es nicht das Passwort ist

 else {

$m = '<p>Login ist fehlerhaft! Passwort oder Username ist falsch!</p>';

 }

}


*/
?>

<form method="post">

Username:<br>

<input name="User">

<br><br>

Email:<br>

<input name="Email">

<br><br>

 Passwort:<br>

<input type="password" name="Passwort">

<br><br>
<input type="submit" name="sub" value="Login">

<input type="button" name="sub2" value="Registrieren" onclick="location.href='sicher2.php'">

</form>

</body>

</html>