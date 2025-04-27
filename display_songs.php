<h2>Song List</h2>
<table>
    <tr>
        <th>Song</th>
        <th>Duration</th>
        <th>Explicit</th>
        <th>Artist</th>
    </tr>
    <?php
    function formatDuration($ms) {
        $seconds = floor($ms / 1000);
        $minutes = floor($seconds / 60);
        $seconds = $seconds % 60;
        return sprintf("%d:%02d", $minutes, $seconds);
    }
    $sql = "SELECT song, artist, explicit, duration_ms
            FROM songs_normalize";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr style='cursor: pointer;' onclick=\"window.location='index.php'\">
                    <td>" . htmlspecialchars($row['song']) . "</td>
                    <td>" . formatDuration($row['duration_ms']) . "</td>
                    <td>" . ($row['explicit'] ? 'Yes' : 'No') . "</td>
                    <td>" . htmlspecialchars($row['artist']) . "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No songs found</td></tr>";
    }
    ?>
</table>