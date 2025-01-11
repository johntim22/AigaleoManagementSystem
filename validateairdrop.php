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

// Check if airdrop is set
if (isset($_POST["addtobalance"])) {
    $airdrop = $_POST["addtobalance"];

    // Validate if the input is numeric (you can extend validation as needed)
    if (is_numeric($airdrop) && $airdrop > 0) {
        // Prepare and execute query to update user balance
        $sql = "UPDATE users SET userbalance = userbalance + ? WHERE username = ?";
        if ($stmt = $conn->prepare($sql)) {
            // Bind the parameters
            $username = $_SESSION["UserName"]; // Assuming the session has a valid username
            $stmt->bind_param("ds", $airdrop, $username); // "d" for double (float) and "s" for string

            // Execute the statement
            if ($stmt->execute()) {
                // Check if the update was successful
                if ($stmt->affected_rows > 0) {
                    echo "Balance updated successfully!";
                } else {
                    echo "No changes made. Please check the username or other conditions.";
                }
            } else {
                echo "Error updating balance: " . $stmt->error;
            }

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
            
            // Add record to blockchain
            $blockchain_sql = "INSERT INTO aigaleo.blockchain (blockinfo) VALUES (?)";
            if ($blockchain_stmt = $conn->prepare($blockchain_sql)) {
                // Prepare the block info string safely
                $block_info = "Airdrop of $airdrop to " . $_SESSION["UserName"] . ". New Balance: " . $_SESSION["UserBalance"];
                $blockchain_stmt->bind_param("s", $block_info);
                if ($blockchain_stmt->execute()) {
                    echo "Blockchain entry added successfully!";
                } else {
                    echo "Error adding blockchain entry: " . $blockchain_stmt->error;
                }
                $blockchain_stmt->close();
            } else {
                echo "Error preparing blockchain statement: " . $conn->error;
            }

        } else {
            echo "Error preparing update statement: " . $conn->error;
        }

        // Redirect to dashboard (optional)
        header("Location: dashboard.php");
        exit; // Always use exit after header redirection
    } else {
        echo "Invalid amount for airdrop.";
    }
} else {
    echo "No airdrop amount provided.";
}

// Close connection
$conn->close();
?>
