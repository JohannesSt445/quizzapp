<?php
require "connect.php";

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['hiddensite'] == "login")
    login($conn);

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['hiddensite'] == "registrieren")
    registrieren($conn);

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['hiddensite'] == "forgot")
    passVergessen($conn);

if ($_SERVER['REQUEST_METHOD'] == "GET")
    logout($conn);

if ($_SERVER['REQUEST_METHOD'] == "PATCH")
    update($conn);

//Einloggen
function login($conn)
{
    $u = $_POST['user'];
    $p = $_POST['pass'];
    $e = $_POST['email'];

    //oracle check ob Account existiert
    $sql = $conn->prepare("SELECT name, passwort, email FROM account WHERE name = ? OR email = ?");
    $sql->execute([$u, $e]);
    $rowcount = $sql->fetchColumn();
    if ($rowcount == 0) {
        echo "Dieser Benutzer existiert nicht!";
    } else {
        $result = $sql->fetchAll();
        if (!password_verify($p, $result["Passwort"])) {

            echo 'Login ist fehlerhaft! Passwort oder Username ist falsch!';

            exit();
        } else {
            session_start();

            $_SESSION['user'] = $u;
            echo "Login erfolgreich";
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

    if (empty($user) || empty($email) || empty($pass) || empty($pass2)) {
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
    $rowcount = $sql->fetchColumn();
    if ($rowcount > 0) {
        //http_response_code(400);
        echo "Benutzername oder E-Mail existieren bereits";
        exit();
    }

    //AccountID hochzählen
    $sql = $conn->query("SELECT COUNT(AccountID) FROM Account");

    $result = $sql->fetchColumn();
    $counter = $result + 1;

    //Daten in DB einfügen
    $sql = $conn->prepare("INSERT INTO Account (AccountID, Name, Passwort, Email) VALUES(?, ?, ?, ?)");
    $sql->execute(array($counter, $user, $pass, $email));
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

function passVergessen($conn)
{
    $user = $_POST['user'];
    $email = $_POST['email'];
    //DB check username
    $sql = $conn->prepare("SELECT name, email, passwort FROM Account WHERE name = ? OR email = ?");
    $sql->execute(array($user, $email));
    $row_count = $sql->rowCount();
    if ($row_count == 0) {
        echo "Benutzername oder Email existieren nicht.";
        exit();
    }

    //Generate token
    $passtoken = $email . password_hash($user, PASSWORD_BCRYPT);

    //DB UPDATE token into spieler
    $sql = $conn->prepare("UPDATE account SET passtoken = ? WHERE name = ? ");
    $sql->execute(array($passtoken, $user));
    if ($sql->rowCount() > 0) {
        send_email($email, $passtoken);
    } else {
        http_response_code(400);
        echo "Something went wrong! Please try again later.";
        exit();
    }
}


function send_email($adresse, $token)
{
    $msg = "http://quizzapp.chickenkiller.com/quizzapp/frontend/passwortaendern.html" . "?passtoken=" . $token;
    mail($adresse, 'Passwort ändern', $msg);
}


function logout($conn)
{
    //session key wird resettet
    session_start();
    unset($_SESSION['user']);

    //Löschen der kompletten Session
    //unset($_SESSION);
    session_destroy();
    echo "Erfolgreich ausgeloggt";
    header('Location: index.html');
}

function update($conn)
{
}
