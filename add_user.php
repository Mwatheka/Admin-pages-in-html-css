<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phplogin";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the user input from the form
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

// Check if the email already exists in the database
$stmt = $conn->prepare("SELECT * FROM accounts WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Email already exists, display an error message
    echo "Error: User with the same email already exists.";
    echo '<br><a href="admin.html">Go back to Admin Page</a>';
} else {
    // Email is unique, add the user to the database
    $stmt = $conn->prepare("INSERT INTO accounts (username, password, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $email);

    if ($stmt->execute()) {
        // User added successfully
        echo "User added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
