<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Previous Artwork</title>


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
                    <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="inventory.html">Inventory</a></li>
                    <li class="nav-item"><a class="nav-link active" href="previous_artwork.html">Previous Artwork</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="development.html">Artwork in Development</a></li>
                    <li class="nav-item"><a class="nav-link" href="client.html">Client List</a></li>
                    <li class="nav-item"><a class="nav-link" href="ideas.html">Project Ideas</a></li>
                    <li class="nav-item"><a class="nav-link" href="dreamlist.html">Dream List</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container mt-5">
        <h1 class="text-center">Previous Artwork</h1>
        <p class="lead text-center">Browse our collection of completed and sold artwork.</p>


        
        <div class="row">
<?php
$con = mysqli_connect("db.luddy.indiana.edu", "i308s25_team53", "lodes3344tinge", "i308s25_team53");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT title, description, medium, buyer_name FROM Previous_Artwork";
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

        if ($row['title'] == 'Rainy Walk') {
            $imagePath = '../images/art2.jpeg';
        } elseif ($row['title'] == 'Autumn Romance') {
            $imagePath = '../images/art3.jpeg';
        } elseif ($row['title'] == 'The Red Muse') {
            $imagePath = '../images/art4.jpeg';
        } else {
            $imagePath = '../images/art-default.jpg';
        }

        echo "<div class='col-md-4'>";
        echo "<div class='card'>";
        echo "<img src='" . $imagePath . "' class='card-img-top' alt='Artwork'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>" . htmlspecialchars($row['title']) . "</h5>";
        echo "<p class='card-text'>" . htmlspecialchars($row['description']) . " Sold to " . htmlspecialchars($row['buyer_name']) . ".</p>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "<p>No artworks found.</p>";
}

mysqli_free_result($result);
mysqli_close($con);
?>
</div> 

       
        



   


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>