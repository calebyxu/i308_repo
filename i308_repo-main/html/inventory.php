<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory</title>
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
                <li class="nav-item"><a class="nav-link active" href="inventory.php">Inventory</a></li>
                <li class="nav-item"><a class="nav-link" href="development.php">Artwork in Development</a></li>
                <li class="nav-item"><a class="nav-link" href="previous_artwork.php">Previous Artwork</a></li>
                <li class="nav-item"><a class="nav-link" href="client.php">Client List</a></li>
                <li class="nav-item"><a class="nav-link" href="ideas.php">Project Ideas</a></li>
                <li class="nav-item"><a class="nav-link" href="dreamlist.html">Dream List</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="text-center">Inventory</h1>
    <p class="lead text-center">Browse materials available for artwork production.</p>

    <form method="GET" class="text-center mb-4">
        <label for="status">Filter by Status:</label>
        <select name="status" id="status" class="form-select d-inline-block w-auto mx-2">
            <option value="All">All</option>
            <option value="Available">Available</option>
            <option value="Low Stock">Low Stock</option>
            <option value="Sold Out">Sold Out</option>
        </select>

        <label for="type">Filter by Type:</label>
        <select name="type" id="type" class="form-select d-inline-block w-auto mx-2">
            <option value="All">All</option>
            <option value="Wood">Wood</option>
            <option value="Metal">Metal</option>
            <option value="Paint">Paint</option>
            <option value="Canvas">Canvas</option>
        </select>

        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Material Name</th>
                <th>Type</th>
                <th>Quantity</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
<?php
$con = mysqli_connect("db.luddy.indiana.edu", "i308s25_team53", "lodes3344tinge", "i308s25_team53");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$status = isset($_GET['status']) ? $_GET['status'] : 'All';
$type = isset($_GET['type']) ? $_GET['type'] : 'All';

$sql = "SELECT material_name, type, quantity, status FROM Inventory WHERE 1=1";
$params = array();
$types = "";

if ($status != "All") {
    $sql .= " AND status = ?";
    $params[] = $status;
    $types .= "s";
}

if ($type != "All") {
    $sql .= " AND type = ?";
    $params[] = $type;
    $types .= "s";
}

$stmt = mysqli_prepare($con, $sql);

if (!empty($params)) {
    mysqli_stmt_bind_param($stmt, $types, ...$params);
}

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['material_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['type']) . "</td>";
        echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No materials found.</td></tr>";
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
