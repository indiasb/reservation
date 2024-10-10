<?php
session_start();

$_SESSION["compte-errors"] = [];

$name ="";
$email="";
$phone="";
$date ="";
$time ="";


if(isset($_SESSION["compte-données"]) && count($_SESSION["compte-données"]) > 0); {

  $_SESSION["compte-données"]["name"] = $name;  
  $_SESSION["compte-données"]["email"] = $email; 
  $_SESSION["compte-données"]["phone"] = $phone; 
  $_SESSION["compte-données"]["date"] = $date; 
  $_SESSION["compte-données"]["time"] = $time; 
}

unset($_SESSION["compte-données"]);

unset($_SESSION["compte-données"]);

if(isset($_SESSION["compte-errors-sql"])) {
  $errorsSQL = $_SESSION;["compte-errors-sql"];
  unset($_SESSION["compte-errors-sql"]);
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>eval</title>
  <link rel="stylesheet" href="assets/style.css">
 
</head>

<body>

  <header>
    <h1>Réservation de vol - Air Fictif</h1>
  </header>


  <div class="container">
    <form action="traitement_reservation.php" method="POST">
      <label for="name">Nom du passager :</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Email :</label>
      <input type="email" id="email" name="email" required>

      <label for="phone">Téléphone :</label>
      <input type="tel" id="phone" name="phone" required>

      <label for="date">Date du vol :</label>
      <input type="date" id="date" name="date" required>

      <label for="time">Heure du vol :</label>
      <input type="time" id="time" name="time" required>

      <button type="submit">Réserver maintenant</button>
    </form>

    <button><a href="tableau_reservation.php">Reservation</a></button>
  </div>

</body>
</html>