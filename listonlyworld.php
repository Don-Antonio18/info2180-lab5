<!-- this code displays list of countries instead of table. here for reference. -->
 <?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if (isset($_GET['country']) && !empty($_GET['country'])) {
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%" . $_GET['country'] . "%'");
} else {
  // if no country specified, query all countries
  $stmt = $conn->query("SELECT * FROM countries");
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>