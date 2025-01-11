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

// Fetch the updated balance
$sql = "SELECT userbalance FROM users WHERE username = ?";
if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $_SESSION["UserName"]);
        $stmt->execute();
        $result = $stmt->get_result();

        // Update session balance
        if ($row = $result->fetch_assoc()) {
            $_SESSION["UserBalance"] = $row["userbalance"];
            }

        $stmt->close();
        }
            
//Go to previous page
    if (isset($_SERVER['HTTP_REFERER'])) {
        // Redirect to the previous page
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit(); // Always call exit after header to stop further script execution
            } 
    else {
        // If the referer is not set, redirect to a default page (e.g., home page)
        header("Location: dashboard.php");
        exit();
        }

// Close connection
$conn->close();
?>
