<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Car Exhibition</title>
</head>
<body>
    <h1>Car Exhibition</h1>

    <?php
    require_once("settings.php");

    $conn = mysqli_connect($host, $user, $pwd, $sql_db);

    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM cars";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1'>";
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
        echo "<p>There are no cars to display.</p>";
    }

    mysqli_free_result($result);
    mysqli_close($conn);
    ?>
</body>
</html>