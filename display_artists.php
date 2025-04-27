<h2>Artist List</h2>
<table>
    <tr>
        <th>Artist Name</th>
        <th>Streams</th>
        <th>Features</th>
        <th>Tracks</th>
    </tr>
    <?php
    $sql = "SELECT `Artist Name`, `Lead Streams`, `Feats`, `Tracks`, `One Billion`, `100 Million`, `Last Updated` 
            FROM spotify_artist_data";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr style='cursor: pointer;' onclick=\"window.location='index.php'\">
                    <td>" . htmlspecialchars($row['Artist Name']) . "</td>
                    <td>" . htmlspecialchars($row['Lead Streams']) . "</td>
                    <td>" . htmlspecialchars($row['Feats']) . "</td>
                    <td>" . htmlspecialchars($row['Tracks']) . "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No artists found</td></tr>";
    }
    ?>
</table>