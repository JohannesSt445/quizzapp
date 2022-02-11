<?php
//$m = null;
//if(isset($_POST['sub'])){
require "connect.php";
if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['hiddensite'] == "registrieren")
    registrieren($conn);

//Registrieren
function registrieren($conn)
{
    $user = $_POST['user'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $pass2 = $_POST['pass2'];

    if ($user == null || $email == null || $pass == null || $pass2 == null) {
        http_response_code(400);
        echo "Bitte Daten eingeben";
        exit();
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Die E-Mail-Adresse ist ungültig!";
        exit();
    }
    if ($pass != $pass2) {
        http_response_code(400);
        echo "Passwörter stimmen nicht überein";
        exit();
    }

    //Prüfen, ob email oder username bereits existieren
    $sql = $conn->prepare("SELECT * FROM Account WHERE name = ? OR email = ?");
    $sql->execute(array($user, $email));
    $rowcount = $sql->rowcount();
    if ($rowcount > 0) {
        http_response_code(400);
        echo "Benutzername oder E-Mail existieren bereits";
        exit();
    }

    //Daten in DB einfügen
    $sql = $conn->prepare("INSERT INTO Account (AccountID, Name, Passwort, Email) VALUES(?, '', '', '')");
    $sql->execute(array($user, $email, $pass));
    if ($sql->rowCount() > 0) {
        http_response_code(200);
        echo "Registriert!";
        exit();
    } else {
        http_response_code(400);
        echo "Registrierung fehlgeschlagen!";
        exit();
    }
}
            /*
            $u = $_POST['User'];
            
            $p = $_POST['Passwort'];
           //oracle
            $stmt = $conn->prepare("SELECT * FROM account WHERE name = ?"); 
            $stmt ->execute([$u]);
            $rowcount = $stmt->rowCount();
            if($rowcount == 0)
            {
                $m = "Dieser Benutzer existiert nicht!";
                
            }
            else{
                while($row =$stmt->fetch())
                {
                    $pass = $row['Passwort'] ;
               
                }
                if($pass == $p)
                {
                    session_start();

                    $_SESSION ['Benutzer'] = $u; 

                    header('Location: sicher.php');

                }


                else {

                        $m = '<p>Login ist fehlerhaft! Passwort oder Username ist falsch!</p>';

                }
            }   
        }*/
