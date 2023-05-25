<?php
// Check if the user ID is provided in the query string
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Connect to the database
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "phplogin";
    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Delete the user from the database
    $sql = "DELETE FROM accounts WHERE id = '$user_id'";

    if (mysqli_query($conn, $sql)) {
        echo "User deleted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
