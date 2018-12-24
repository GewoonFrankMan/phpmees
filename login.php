<?php
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 2-2-2018
 * Time: 13:12
 */
# hier haalt hij de session op en start hem weer.
# hier haalt hij de Datavase connectie op/
require_once 'dbconnectie.php';
# Als de gebruikersnaam en het wachtwoord gezet zijn haal het op uit de database
if (isset($_POST['username']) && isset($_POST['wachtwoord'])) {
    # hier word de username gefiltert op de variable USERNAME. Dit om hacks te voorkomen
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    # hier word het wachtwoord gefiltert op de variable Wachtwoord. dit om eventuele hacks te voorkomen
    $password = filter_var($_POST['wachtwoord'], FILTER_SANITIZE_STRING);
    # hier zet hij een nieuwe variable met de waar DBCON waar dus de databse connectie inzit
    $db = dbcon();
    # hier haalt hij via de vorige variable de connectie op. Deze prepare ik en daarmee haalt is dus de gegeven van username op
    $showDb = $db->prepare("SELECT * FROM `users` WHERE `user_username` = :username ");
    # Hier voert hij het daadwerlijk uit met de username. Het moet wel overheen komen met wat er in dataabase staat.
    $showDb->execute(array(':username' => $username));
    # hier haalt uit de datavase de wachtwoord row.
    $row = $showDb->fetch();
    # hier checkt hij of het wachtwoord overeenkomt met de Username die werd opgegeven. Als het goed word bevonden dan word de user in een session geset.
    # en als het klopt stuurt hij je terug naar de main page. Als de gegeven niet overeen komen geeft hij een foutmelding.
    if (password_verify($password, $row['user_password'])){
        $_SESSION['username'] =  $username;
        header('location: index.php');
    } else {
        echo "Wachtwoord of gebruikersnaam is fout!";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>

</head>

<body>

<form action="" method="post">

    Username: <input type="text" name="username">
    Wachtwoord: <input type="password" name="wachtwoord">
    <input type="submit" name="registreer">

</form>


</body>

</html>