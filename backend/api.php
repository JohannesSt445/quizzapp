<?php
require "connect.php";

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['hiddensite'] == "login")
    login($conn);

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['hiddensite'] == "registrieren")
    registrieren($conn);

if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['hiddensite'] == "forgot")
    passVergessen($conn);

if ($_SERVER['REQUEST_METHOD'] == "GET")
    logout($conn);

if ($_SERVER['REQUEST_METHOD'] == "PATCH")
    update($conn);

//Einloggen
function login($conn)
{
    $u = $_POST['user'];
    $p = $_POST['passwort'];
    $e = $_POST['email'];

    //oracle check ob Account existiert
    $sql = $conn->prepare("SELECT name, passwort, email FROM account WHERE name = ? OR email = ?");
    $sql->execute([$u, $e]);
    $rowcount = $sql->rowCount();
    if ($rowcount == 0) {
        echo "Dieser Benutzer existiert nicht!";
    } else {
        while ($row = $sql->fetch()) {
            $pass = $row['passwort'];
        }
        if ($pass == $p) {
            session_start();

            $_SESSION['user'] = $u;

            echo "Login erfolgreich";
            exit();
        } else {

            echo '<p>Login ist fehlerhaft! Passwort oder Username ist falsch!</p>';
            exit();
        }
    }
}

//Registrieren
function registrieren($conn)
{
    $user = $_POST['user'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $pass2 = $_POST['pass2'];

    if ($user == null || $email == null || $pass == null || $pass2 == null) {
        //http_response_code(400);
        echo "Bitte Daten eingeben";
        exit();
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //http_response_code(400);
        echo "Die E-Mail-Adresse ist ungültig!";
        exit();
    }
    if ($pass != $pass2) {
        //http_response_code(400);
        echo "Passwörter stimmen nicht überein";
        exit();
    }

    //Prüfen, ob email oder username bereits existieren
    $sql = $conn->prepare("SELECT * FROM Account WHERE name = ? OR email = ?");
    $sql->execute(array($user, $email));
    $rowcount = $sql->rowcount();
    if ($rowcount > 0) {
        //http_response_code(400);
        echo "Benutzername oder E-Mail existieren bereits";
        exit();
    }

    //Daten in DB einfügen
    $sql = $conn->prepare("INSERT INTO Account (AccountID, Name, Passwort, Email) VALUES(?, '', '', '')");
    $sql->execute(array($user, $email, $pass));
    if ($sql->rowCount() > 0) {
        //http_response_code(200);
        echo "Registriert!";
        exit();
    } else {
        //http_response_code(400);
        echo "Registrierung fehlgeschlagen!";
        exit();
    }
}

function passVergessen($conn){
    
}

function logout($conn){}

function update($conn){}
