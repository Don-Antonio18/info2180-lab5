<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if (isset($_GET['lookup']) && $_GET['lookup'] === 'cities') {
  // query cities with JOIN
  if (isset($_GET['country']) && !empty($_GET['country'])) {
    $stmt = $conn->query("SELECT cities.name, cities.district, cities.population
    FROM cities JOIN countries ON cities.country_code = countries.code WHERE countries.name LIKE '%" . $_GET['country'] . "%'");
  } else {
    // query all cities with country names
    $stmt = $conn->query("SELECT cities.name, cities.district, cities.population
    FROM cities JOIN countries ON cities.country_code = countries.code");
  }

  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  ?>
  <table class="country-table">
    <thead>
      <tr>
        <th>Name</th>
        <th>District</th>
        <th>Population</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($results as $row): ?>
        <tr>
          <td><?= $row['name']; ?></td>
          <td><?= $row['district']; ?></td>
          <td><?= $row['population']; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php
} else {
  // base case, query countries
  if (isset($_GET['country']) && !empty($_GET['country'])) {
    $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%" . $_GET['country'] . "%'");
  } else {
    $stmt = $conn->query("SELECT * FROM countries");
  }

  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  ?>
  <table class="country-table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Continent</th>
        <th>Independence Year</th>
        <th>Head of State</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($results as $row): ?>
        <tr>
          <td><?= $row['name']; ?></td>
          <td><?= $row['continent']; ?></td>
          <td><?= $row['independence_year']; ?></td>
          <td><?= $row['head_of_state']; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php
}
?>
