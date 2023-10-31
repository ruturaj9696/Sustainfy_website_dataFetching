<?php
include 'connect.php';

$searchResults = "";

if (isset($_POST['search'])) {
    // Get the search query from the form
    $searchQuery = $_POST['searchQuery'];

    // Database connection code (same as before)

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to search for a user by ID or username
    $sql = "SELECT * FROM crud WHERE id = '$searchQuery' OR fname = '$searchQuery' OR lname = '$searchQuery'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of the user(s)
        $searchResults .= '<div class="results">';
        while ($row = $result->fetch_assoc()) {
            $searchResults .= "<div class='user'>";
            $searchResults .= "ID: " . $row["id"] . "<br>";
            $searchResults .= "First Name: " . $row["fname"] . "<br>";
            $searchResults .= "Last Name: " . $row["lname"] . "<br>";
            $searchResults .= "Email: " . $row["email"] . "<br>";
            $searchResults .= "Phone: " . $row["phone"] . "<br>";
            $searchResults .= "</div>";
        }
        $searchResults .= '</div>';
    } else {
        $searchResults = '<div class="no-results">No records found for \'' . htmlspecialchars($searchQuery) . '\'</div>';
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Database Data Display</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        .search-container {
            text-align: center;
            margin-top: 20px;
        }

        .search-form {
            display: inline-block;
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .search-form label {
            font-weight: bold;
        }

        .search-form input[type="text"] {
            padding: 5px;
            width: 200px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .search-form input[type="submit"] {
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .results {
            background-color: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .user {
            margin-bottom: 10px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }

        .no-results {
            background-color: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            color: #ff0000;
        }
    </style>
</head>
<body>
    <h1>Database Data Fetching </h1>

    <!-- Search form -->
    <div class="search-container">
        <form class="search-form" method="post">
            <label for="searchQuery">Search by ID or Name:</label>
            <input type="text" name="searchQuery" id="searchQuery" required>
            <input type="submit" name="search" value="Search">
        </form>
    </div>

    <!-- Display search results -->
    <div class="search-results">
        <?php echo $searchResults; ?>
    </div>
</body>
</html>