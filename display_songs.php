<h2>Song List</h2>
<table>
    <tr>
        <th>Album</th>
        <th>Song Duration</th>
        <th>Explicit</th>
        <th>Artist</th>
    </tr>
    <?php
    $sql = "SELECT s.album_name, s.song_duration, s.explicit, a.name as artist_name 
            FROM songs s 
            JOIN artists a ON s.artist_id = a.artist_id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['album_name']) . "</td>
                    <td>" . $row['song_duration'] . "</td>
                    <td>" . ($row['explicit'] ? 'Yes' : 'No') . "</td>
                    <td>" . htmlspecialchars($row['artist_name']) . "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No songs found</td></tr>";
    }
    ?>
</table>