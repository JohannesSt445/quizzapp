<?php







    $tns = "quizzapp_high"; 

    $user = "quizzteam2"; 
    
    $password = "QuizzApp9755"; 
    
    
    if(isset($_POST['sub'])){
    try { 
    
         $conn = new PDO("oci:dbname=".$tns, $user, $password); 
    
         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    
         

            $u = $_POST['User'];
            
            $p = $_POST['Passwort'];
             
            
        
            
    
    } catch(PDOException $e) { 
    
         echo 'ERROR: ' . $e->getMessage(); 
    
    } 
}
    
?>

<!doctype html>

<html>

<head>

 <title>Login</title>

<meta charset= "utf-8">

</head>

<body>



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