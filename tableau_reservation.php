<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/style.css">
  <title>eval</title>
 
</head>

<body>
<?php
include_once("inc/constant.php");

try {

    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

$stmt = $pdo->prepare("SELECT name, email, phone FROM reservations");
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
  <header>
    <h1>Mes reservations</h1>
  </header>

  <div class="container">
    <table>
      <thead>
        <tr>
          <th>Nom du passager</th>
          <th>Email </th>
          <th>Téléphone </th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($results as $row): ?>
        <tr>
        <td><?= htmlspecialchars($row['name']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= htmlspecialchars($row['phone']) ?></td>
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>

  <button><a href="index.php">Reservation</a></button>
  
</body>
</html>