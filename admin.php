<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <link rel="stylesheet" type="text/css" href="admin style.css"> <!-- Include your CSS file for styling -->
</head>
<body>
    <header>
        <h1>Welcome to the Admin Page</h1>
        <a href="logout.php">Logout</a> <!-- Link to the logout functionality -->
    </header>

    <nav>
        <ul>
            <li><a href="admin.php">Home</a></li>
            <li><a href="user_management.php">User Management</a></li>
            <li><a href="recipe_management.php">Recipe Management</a></li>
            <li><a href="analytics.php">Analytics</a></li>
            <li><a href="settings.html">Settings</a></li>
            <li><a href="reports.php">Reports</a></li>
        </ul>
    </nav>

    <main>
        <h2>User Management</h2>
        <form action="add_user.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <input type="submit" value="Add User">
        </form>

        <!-- Display a list of existing users -->
        <?php
        // Connect to the database
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "phplogin";
        $conn = mysqli_connect($host, $username, $password, $database);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Retrieve existing users from the database
        $sql = "SELECT * FROM accounts";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<h3>Existing Users:</h3>";
            echo "<ul>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li>" . $row['username'] . " - " . $row['email'] . " <a href='delete_user.php?id=" . $row['id'] . "'>Delete</a></li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No users found.</p>";
        }

        mysqli_close($conn);
        ?>
    </main>

    <footer>
        &copy; 2023 Your Catering Company
    </footer>
</body>
</html>
