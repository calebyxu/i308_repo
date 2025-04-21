<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $tname = null;
        $tyear = null;
        $riders = [];
        $race_years = [];

        $id = $_POST['team_id'];

        $host = "db.luddy.indiana.edu";
        $username = "i308s25_calxu";
        $password = "pases2914ghyll";
        $database = "i308s25_calxu";

        $conn = mysqli_connect($host, $username, $password, $database);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT tname, year_formed FROM B_team WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $tname = $row['tname'];
            $tyear = $row['year_formed'];
        }

        mysqli_free_result($result);

        $sql = "SELECT CONCAT(B_rider.fname,' ', B_rider.lname) AS name
                FROM B_rider
                JOIN B_member ON B_rider.id = B_member.rider_id
                JOIN B_team ON B_team.id = B_member.team_id
                WHERE B_team.id='$id'";

        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            array_push($riders, $row['name']);
        }

        mysqli_free_result($result);

        $sql = "SELECT DISTINCT B_race.race_year
                FROM B_race
                JOIN B_results ON B_race.id = B_results.race_id
                JOIN B_team ON B_team.id = B_results.team_id
                WHERE B_team.id='$id'";

        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            array_push($race_years, $row['race_year']);
        }

        mysqli_free_result($result);
        mysqli_close($conn);

        echo '<h1>Team Name: '. $tname. '</h1>';
        echo '<h1>Year Formed: '. $tyear. '</h1>';
        echo '<h1>Riders</h1>';

        for ($i = 0; $i < count($riders); $i++) {
            echo '<h3>'. $riders[$i]. '</h3>';
        }

        echo '<h1>Years The Team Competed in</h1>';
        
        for ($i = 0; $i < count($race_years); $i++) {
            echo '<h3>'. $race_years[$i]. '</h3>';
        }
    ?>
</body>
</html>