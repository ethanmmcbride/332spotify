<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'music_project');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get artist name from URL parameter
$artist_name = isset($_GET['artist']) ? $_GET['artist'] : '';

// If no artist specified, redirect back to index
if (empty($artist_name)) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($artist_name); ?> - Music Database</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($artist_name); ?></h1>
        
        <div class="buttons">
            <a href="index.php" class="btn">Back to Home</a>
        </div>
        
        <div class="content">
            <h2>Artist Details</h2>
            <?php
            // Get artist details
            $sql = "SELECT `Artist Name`, `Lead Streams`, `Feats`, `Tracks`, `One Billion`, `100 Million`, `Last Updated` 
                    FROM spotify_artist_data
                    WHERE `Artist Name` = ?";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $artist_name);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
                <table>
                    <tr>
                        <th>Artist Name</th>
                        <th>Total Streams</th>
                        <th>Features</th>
                        <th>Tracks</th>
                        <th>One Billion</th>
                        <th>100 Million</th>
                        <th>Last Updated</th>
                    </tr>
                    <tr>
                        <td><?php echo htmlspecialchars($row['Artist Name']); ?></td>
                        <td><?php echo htmlspecialchars($row['Lead Streams']); ?></td>
                        <td><?php echo htmlspecialchars($row['Feats']); ?></td>
                        <td><?php echo htmlspecialchars($row['Tracks']); ?></td>
                        <td><?php echo htmlspecialchars($row['One Billion']); ?></td>
                        <td><?php echo htmlspecialchars($row['100 Million']); ?></td>
                        <td><?php echo htmlspecialchars($row['Last Updated']); ?></td>
                    </tr>
                </table>
                <?php
            } else {
                echo "<p>Artist not found.</p>";
            }
            ?>
            
            <h2>Songs by <?php echo htmlspecialchars($artist_name); ?></h2>
            <table>
                <tr>
                    <th>Song</th>
                    <th>Duration</th>
                    <th>Explicit</th>
                </tr>
                <?php
                // Get songs for this artist
                function formatDuration($ms) {
                    $seconds = floor($ms / 1000);
                    $minutes = floor($seconds / 60);
                    $seconds = $seconds % 60;
                    return sprintf("%d:%02d", $minutes, $seconds);
                }
                
                $sql = "SELECT song, explicit, duration_ms
                        FROM songs_normalize
                        WHERE artist = ?";
                
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $artist_name);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['song']) . "</td>
                                <td>" . formatDuration($row['duration_ms']) . "</td>
                                <td>" . ($row['explicit'] ? 'Yes' : 'No') . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No songs found for this artist.</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
<?php $conn->close(); ?>