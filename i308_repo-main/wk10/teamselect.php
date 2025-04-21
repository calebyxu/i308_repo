<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Select a Team</h1>
    
    <form action="teaminfo.php" method="post">
        <label for="team_id">Choose a team:</label>
        <select id="team_id" name="team_id" required>
            <?php
            $host = "db.luddy.indiana.edu";
            $username = "i308s25_calxu";
            $password = "pases2914ghyll";
            $database = "i308s25_calxu";
        
            $conn = mysqli_connect($host, $username, $password, $database);
        
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            
            $sql = "SELECT id, tname FROM B_team ORDER BY tname ASC";
            $result = mysqli_query($conn, $sql);

            while($row = mysqli_fetch_assoc($result)) {
                echo "<option value='". $row['id'] . "'>" . $row['tname'] . "</option>";
            }

            mysqli_free_result($result);
            mysqli_close($conn);
            ?>
        </select>
        <button type="submit">Show Team Details</button>
        </form>            
</body>
</html>