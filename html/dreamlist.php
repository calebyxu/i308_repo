<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                    <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="inventory.html">Inventory</a></li>
                    <li class="nav-item"><a class="nav-link" href="previous_artwork.html">Previous Artwork</a></li>
                    <li class="nav-item"><a class="nav-link" href="development.html">Artwork In Development</a></li>
                    <li class="nav-item"><a class="nav-link" href="client.html">Client List</a></li>
                    <li class="nav-item"><a class="nav-link active" href="ideas.html">Project Ideas</a></li>
                    <li class="nav-item"><a class="nav-link" href="dreamlist.html">Dream List</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container mt-5">
        <h1 class="text-center">Dream List</h1>
        <p class="lead text-center">Describe your dream artwork, and we will help bring it to life.</p>

        <?php
            $con=mysqli_connect();
            //above needs to be completed
            // Check connection
            if (!$con) {
                die("Failed to connect to MySQL: " .
                    mysqli_connect_error());
            } else {
                echo "Established Database Connection";
            };

            $name = $_POST['form-name'];
            $email = $_POST['form-email'];
            $style = $_POST['form-style'];
            $desc = $_POST['form-desc'];

            $sql = ;
            //above needs to be completed
            
            if (mysqli_query($con,$sql))
                {echo "<p>1 record added</p>";}
            else
                {die('SQL Error: ' . mysqli_error($con));}
            
            mysqli_close($con);
        ?>
       


    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>