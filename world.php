<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// get the country from GET
$country = isset($_GET['country']) ? $_GET['country'] : '';

if ($country) {
  // prepared statement with LIKE to avoid SQL injection
  $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE ?");
  $stmt->execute(['%' . $country . '%']);
} else {
  // return all countries if no country provided
  $stmt = $conn->query("SELECT * FROM countries");
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<ul>
<?php foreach ($results as $row): ?>
  <li><?= htmlspecialchars($row['name']) . ' is ruled by ' . htmlspecialchars($row['head_of_state']); ?></li>
<?php endforeach; ?>
</ul>

