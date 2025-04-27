<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Client List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.html">Artisan Artwork</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="inventory.html">Inventory</a></li>
                <li class="nav-item"><a class="nav-link" href="development.php">Artwork in Development</a></li>
                <li class="nav-item"><a class="nav-link" href="previous_artwork.php">Previous Artwork</a></li>
                <li class="nav-item"><a class="nav-link active" href="client.php">Client List</a></li>
                <li class="nav-item"><a class="nav-link" href="ideas.html">Project Ideas</a></li>
                <li class="nav-item"><a class="nav-link" href="dreamlist.php">Dream List</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="text-center">Client List</h1>
    <p class="lead text-center">Explore our current, past, and prospective clients.</p>

    <table class="table">
        <thead>
            <tr>
                <th>Client Name</th>
                <th>Status</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
<?php
$con = mysqli_connect("db.luddy.indiana.edu", "i308s25_team53", "lodes3344tinge", "i308s25_team53");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT nameF, nameL, status, email FROM Client";
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['nameF']) . " " . htmlspecialchars($row['nameL']) . "</td>";
        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>No clients found.</td></tr>";
}

mysqli_free_result($result);
mysqli_close($con);
?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
