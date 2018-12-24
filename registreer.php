<?php

# haal de bestand dbcon op waar de connectie van de database inzit.
require_once "dbconnectie.php";



if(isset($_POST['registreer']) && isset($_POST['username']) && isset($_POST['wachtwoord'])) {
    $wachtwoord = $_POST['wachtwoord'];
    $herhaalww =  $_POST['herhaalww'];
    $db = dbcon();
    if ($wachtwoord === $herhaalww){
        $submitdb = $db->prepare("INSERT INTO users  (user_username, user_password) VALUES (:user_username, :user_password)");

        $password = $_POST['wachtwoord'] ;
        $hashpassword = password_hash($password, PASSWORD_BCRYPT);
        $result = $submitdb->execute([
            ':user_username' => $_POST['username'],
            ':user_password' => $hashpassword
        ]);
        header("location: index.php");
    } else {
        echo 'Je wachtwoorden komen niet overheen';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <meta charset="utf-8">
    <title>Mees zijn registreer scherm</title>
    <meta name="description" content="Dit is informatie site van Frank Stevens.">
    <meta name="author" content="Frank Stevens">
    <link rel="stylesheet" type="text/css" href="../css/inlog.css">
</head>

<body>

<form action="" method="post">

    Username: <input type="text" name="username">
    Wachtwoord: <input type="password" name="wachtwoord">
    Herhaal Wachtwoord: <input type="password" name="herhaalww">
    <input type="submit" name="registreer">

</form>

</body>

</html>
