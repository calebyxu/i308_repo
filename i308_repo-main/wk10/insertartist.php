<?php
// Replace with your actual Burrow DB credentials

// Get form values
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$dob = $_POST['dob'];
$instrument = $_POST['instrument'];
$gender = $_POST['gender'];

// Connect to DB
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare insert
$stmt = $conn->prepare("INSERT INTO p_artist (fname, lname, dob, instrument, gender) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $fname, $lname, $dob, $instrument, $gender);

if ($stmt->execute()) {
    echo "<h2>✅ Artist <em>$fname $lname</em> added successfully!</h2>";
} else {
    echo "<h2>❌ Error: " . $stmt->error . "</h2>";
}

$stmt->close();
$conn->close();
?>