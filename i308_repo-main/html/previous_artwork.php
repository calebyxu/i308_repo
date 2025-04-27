<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Choose Artwork Medium</title>
</head>
<body>

<h1>Choose a Medium to View Artwork</h1>

<form action="previous_artwork_results.php" method="POST">
    <label for="form-medium">Choose Medium:</label>
    <select name="form-medium" id="form-medium" required>

<?php
$con = mysqli_connect("db.luddy.indiana.edu", "i308s25_team53", "lodes3344tinge", "i308s25_team53");
if (!$con) { die("Connection failed: " . mysqli_connect_error()); }

$sql = "SELECT DISTINCT medium FROM Previous_Artwork ORDER BY medium";
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='" . $row['medium'] . "'>" . $row['medium'] . "</option>";
    }
} else {
    echo "<option disabled>No mediums found</option>";
}

mysqli_free_result($result);
mysqli_close($con);
?>

    </select>
    <br><br>
    <button type="submit">View Artwork</button>
</form>

</body>
</html>
