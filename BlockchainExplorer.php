<!doctype html>
<?php
session_start();
if (!empty($_SESSION["UserName"])){
//Do nothing, just check that user name exists
}
else {
    //If username is not set then session has not been established
    header("Location: http://localhost/aigaleo.sevenchc.com");
}
?>
<html lang="en">
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Aigaleo Management Platform</title>
  </head>
  <body>
    <!---navbar here--->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Aigaleo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="BlockchainExplorer.php">Blockchain Explorer</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="validatelogout.php">Logout</a>
        </li>
      </ul>
      <span class="navbar-text">
        Balance: <?php echo $_SESSION["UserBalance"] ?> AIGS
        <a href="validaterefresh.php">
  <button type="button">Refresh</button>
</a>
      </span>
    </div>
  </div>
</nav>
<!---navbar ends--->
<br><br>
<!---main body begins--->
<div class="container">
<?php
// Database credentials
$servername = "localhost"; 
$username = "root";       
$password = "";           
$dbname = "aigaleo";       // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select all records from a table (change 'your_table_name' to your table name)
$sql = "SELECT * FROM blockchain"; // Replace with your actual table name
$result = $conn->query($sql);

// Start the HTML table
echo "<table class='table' border='1'>";
echo "<tr>";

// Get the column names to dynamically generate table headers
if ($result->num_rows > 0) {
    // Fetching the column names for the header
    $fields = $result->fetch_fields();
    foreach ($fields as $field) {
        echo "<th>" . htmlspecialchars($field->name) . "</th>";
    }

    echo "</tr>";

    // Loop through the rows and output data in table rows
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>" . htmlspecialchars($value) . "</td>";
        }
        echo "</tr>";
    }

    // End the table
    echo "</table>";
} else {
    echo "0 results found";
}

// Close the connection
$conn->close();
?>
</div>
  </body>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</html>