<?php
$m = null;
    if(isset($_POST['sub'])){

        require "connect.php";

            $u = $_POST['User'];
            
            $p = $_POST['Passwort'];
           
            $stmt = $conn->query("SELECT * FROM account "); 
            $m = $stmt ->fetch();
            
        }

    
?>

<!doctype html>

<html>

<head>

 <title>Login</title>

<meta charset= "utf-8">

</head>

<body>
<?php
echo $m;
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