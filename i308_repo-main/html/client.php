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
                <li class="nav-item"><a class="nav-link" href="dreamlist.html">Dream List</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="text-center">Client List</h1>
    <p class="lead text-center">Explore our current, past, and prospective clients.</p>

    
    <form method="GET" class="mb-4 text-center">
        <label for="status">Filter by Client Status:</label>
        <select name="status" id="status" class="form-select d-inline w-auto">
            <option value="All">All</option>
            <option value="Current Client">Current Client</option>
            <option value="Past Client">Past Client</option>
            <option value="Prospective Client">Prospective Client</option>
        </select>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

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


$statusFilter = isset($_GET['status']) ? $_GET['status'] : 'All';


if ($statusFilter == 'All') {
    $sql = "SELECT nameF, nameL, status, email FROM Client";
} else {
    $sql = "SELECT nameF, nameL, status, email FROM Client WHERE status = ?";
}


if ($stmt = mysqli_prepare($con, $sql)) {
    if ($statusFilter != 'All') {
        mysqli_stmt_bind_param($stmt, "s", $statusFilter);
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

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

    mysqli_stmt_close($stmt);
}

mysqli_close($con);
?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
