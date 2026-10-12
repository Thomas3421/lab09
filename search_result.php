<?php
require_once("settings.php");

$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$model = isset($_GET["model"]) ? trim($_GET["model"]) : "";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Car Search Results</title>
</head>
<body>
    <h1>Car Search Results</h1>

    <?php
    if ($model !== "") {
        $query = "SELECT * FROM cars WHERE model LIKE ?";
        $stmt = mysqli_prepare($conn, $query);
        $search = "%" . $model . "%";

        mysqli_stmt_bind_param($stmt, "s", $search);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Make</th><th>Model</th><th>Price</th><th>Year</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["car_id"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["make"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["model"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["price"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["yom"]) . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No matching cars found.</p>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<p>Please enter a model to search.</p>";
    }

    mysqli_close($conn);
    ?>

    <p><a href="search_form.php">Search Again</a></p>
</body>
</html>