<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Artwork Results</title>
</head>
<body>

<h1>Artwork Results</h1>

<?php
$con = mysqli_connect("db.luddy.indiana.edu", "i308s25_team53", "lodes3344tinge", "i308s25_team53");
if (!$con) { die("Connection failed: " . mysqli_connect_error()); }

$selected_medium = $_POST['form-medium'];

$sql = "SELECT title, description, medium, buyer_name FROM Previous_Artwork WHERE medium = '$selected_medium'";
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<h2>" . $row['title'] . "</h2>";
        echo "<p><strong>Description:</strong> " . $row['description'] . "</p>";
        echo "<p><strong>Medium:</strong> " . $row['medium'] . "</p>";
        echo "<p><strong>Sold to:</strong> " . $row['buyer_name'] . "</p>";
        echo "<hr>";
    }
} else {
    echo "<p>No artwork found for that medium.</p>";
}

mysqli_free_result($result);
mysqli_close($con);
?>

</body>
</html>
