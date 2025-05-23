<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Project Ideas</title>
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
                <li class="nav-item"><a class="nav-link" href="inventory.php">Inventory</a></li>
                <li class="nav-item"><a class="nav-link" href="development.php">Artwork in Development</a></li>
                <li class="nav-item"><a class="nav-link" href="previous_artwork.php">Previous Artwork</a></li>
                <li class="nav-item"><a class="nav-link" href="client.php">Client List</a></li>
                <li class="nav-item"><a class="nav-link active" href="ideas.php">Project Ideas</a></li>
                <li class="nav-item"><a class="nav-link" href="dreamlist.html">Dream List</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="text-center">Project Ideas</h1>
    <p class="lead text-center">Explore upcoming art projects and concepts.</p>

    <div class="row">
<?php
$con = mysqli_connect("db.luddy.indiana.edu", "i308s25_team53", "lodes3344tinge", "i308s25_team53");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT idea_name, description, image_filename FROM ProjectIdeas";
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='col-md-4'>";
        echo "<div class='card'>";
        echo "<img src='../images/" . htmlspecialchars($row['image_filename']) . "' class='card-img-top' alt='Idea Image'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>" . htmlspecialchars($row['idea_name']) . "</h5>";
        echo "<p class='card-text'>" . htmlspecialchars($row['description']) . "</p>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "<p class='text-center'>No project ideas found.</p>";
}

mysqli_free_result($result);
mysqli_close($con);
?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
