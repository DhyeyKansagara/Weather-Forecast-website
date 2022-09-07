<html lang="en">
<head>
    <title>NJ weather</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
  <a class="navbar-brand" href="weather.php">NJ weather</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link" href="newark.php">Newark</a>
        <a class="nav-link" href="hoboken.php">Hoboken</a>
        <a class="nav-link" href="clifton.php">Clifton</a>
        <a class="nav-link" href="kearny.php">Kearny</a>
        <a class="nav-link active" aria-current="page" href="trenton.php">Trenton</a>

      </div>
    </div>
  </div>
</nav>

<div class="container">
<table class="table">
<?php
    $cnx = new mysqli('localhost', 'root', 'vwxyz', 'weather');

    if ($cnx->connect_error)
        die('Connection failed: ' . $cnx->connect_error);

    $query = 'SELECT * FROM weather WHERE cityName="Trenton"';
    $cursor = $cnx->query($query);
    echo '<tr>';
    echo '<th> City Name </th>';
    echo '<th> Day </th>';
    echo '<th> Short Description </th>';
    echo '<th> Temperature </th>';
    echo '<th> Long Description </th>';
    echo '</th>';
    while ($row = $cursor->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['cityName'] . '</td><td>' . $row['day'] . '</td><td>' . $row['description'] .'</td><td>' . $row['temp'] . '</td><td>' . $row['lDescription'] . '</td>';
        echo '</tr>';
    }

    $cnx->close();
?>
</table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
<footer class="footer">
    <p> &copy Dhyeykumar Kansagara </p>
</footer>
</html>