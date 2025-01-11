<?php
// Database credentials
$servername = "localhost"; 
$username = "root";       
$password = "";           
$dbname = "aigaleo";      

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "DB --- Connected successfully<br>";

// Start session
session_start();

// Get user input
$username2 = $_POST["username"];
$userpassword = $_POST["userpassword"];

// Prepare and execute query to validate username, password, and fetch balance
$sql = "SELECT username, userbalance FROM users WHERE username = ? AND userpassword = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username2, $userpassword); // "ss" means two strings
$stmt->execute();
$result = $stmt->get_result();

// Check if a match is found
if ($result->num_rows > 0) {
    // Fetch username and balance from result
    $row = $result->fetch_assoc();
    $_SESSION["UserName"] = $row["username"];
    $_SESSION["UserBalance"] = $row["userbalance"];
    
    echo "Login successful! Welcome, " . $_SESSION["UserName"] . ". Your balance is: " . $_SESSION["UserBalance"];
    
    // Redirect to dashboard or another page
    header("Location: dashboard.php");


} else {
    echo "Invalid username or password. Please try again.";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
