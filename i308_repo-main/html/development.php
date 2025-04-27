<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Artwork In Development</title>
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
                <li class="nav-item"><a class="nav-link active" href="development.php">Artwork in Development</a></li>
                <li class="nav-item"><a class="nav-link" href="previous_artwork.php">Previous Artwork</a></li>
                <li class="nav-item"><a class="nav-link" href="client.php">Client List</a></li>
                <li class="nav-item"><a class="nav-link" href="ideas.php">Project Ideas</a></li>
                <li class="nav-item"><a class="nav-link" href="dreamlist.html">Dream List</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="text-center">Artwork In Development</h1>
    <p class="lead text-center">Explore ongoing artwork projects and their progress.</p>

    <form action="development.php" method="POST" class="row mb-4">
        <div class="col-md-5">
            <label>Filter by Completion Month:</label>
            <select name="form-month" class="form-select">
                <option value="">All Months</option>
                <option value="April 2025">April 2025</option>
                <option value="May 2025">May 2025</option>
                <option value="June 2025">June 2025</option>
            </select>
        </div>
        <div class="col-md-5">
            <label>Filter by Completion Status:</label>
            <select name="form-status" class="form-select">
                <option value="">All Status</option>
                <option value="below50">Below 50%</option>
                <option value="above50">50% and Above</option>
            </select>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    <div class="row">
<?php
$con = mysqli_connect("db.luddy.indiana.edu", "i308s25_team53", "lodes3344tinge", "i308s25_team53");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$month = $_POST['form-month'] ?? '';
$status = $_POST['form-status'] ?? '';

$sql = "SELECT * FROM Development_Artwork WHERE 1=1";

if (!empty($month)) {
    $sql .= " AND expected_completion = '" . mysqli_real_escape_string($con, $month) . "'";
}

if (!empty($status)) {
    if ($status == 'below50') {
        $sql .= " AND completion_percent < 50";
    } elseif ($status == 'above50') {
        $sql .= " AND completion_percent >= 50";
    }
}

$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $imagePath = '../images/' . htmlspecialchars($row['image_filename']);

        echo "<div class='col-md-4 mb-4'>";
        echo "<div class='card'>";
        echo "<img src='" . $imagePath . "' class='card-img-top' alt='Artwork'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>" . htmlspecialchars($row['title']) . "</h5>";
        echo "<p class='card-text'>Expected Completion: " . htmlspecialchars($row['expected_completion']) . "</p>";
        echo "<p class='card-text'>Status: " . htmlspecialchars($row['completion_percent']) . "% Complete</p>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "<p class='text-center'>No artworks found matching your filters.</p>";
}

mysqli_free_result($result);
mysqli_close($con);
?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
