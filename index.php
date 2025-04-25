<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'music_project');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Determine what to display
$display = isset($_GET['display']) ? $_GET['display'] : 'none';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Database</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Music Database</h1>
        
        <div class="buttons">
            <a href="index.php?display=songs" class="btn">Show Songs</a>
            <a href="index.php?display=artists" class="btn">Show Artists</a>
        </div>
        
        <div class="content">
            <?php
            if ($display == 'songs') {
                include 'display_songs.php';
            } elseif ($display == 'artists') {
                include 'display_artists.php';
            }
            ?>
        </div>
    </div>
</body>
</html>
<?php $conn->close(); ?>`