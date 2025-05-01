<h2>Artist List</h2>
<table>
    <tr>
        <th>Artist Name</th>
        <th>Streams</th>
        <th>Features</th>
        <th>Tracks</th>
        <th>Action</th>
    </tr>
    <?php
    session_start();
    // Initialize favorites array if it doesn't exist
    if (!isset($_SESSION['favorites'])) {
        $_SESSION['favorites'] = array();
    }

    $sql = "SELECT `Artist Name`, `Lead Streams`, `Feats`, `Tracks`, `One Billion`, `100 Million`, `Last Updated` 
            FROM spotify_artist_data";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $artist_name = htmlspecialchars($row['Artist Name']);
            $artist_url = 'artist_details.php?artist=' . urlencode($row['Artist Name']);
            $is_favorite = in_array($row['Artist Name'], $_SESSION['favorites']);
            
            echo "<tr style='cursor: pointer;' onclick=\"window.location='". $artist_url . "'\">
                    <td>" . $artist_name . "</td>
                    <td>" . htmlspecialchars($row['Lead Streams']) . "</td>
                    <td>" . htmlspecialchars($row['Feats']) . "</td>
                    <td>" . htmlspecialchars($row['Tracks']) . "</td>
                    <td>
                        <form method='post' action='toggle_favorite.php' style='display: inline;'>
                            <input type='hidden' name='artist_name' value='" . htmlspecialchars($row['Artist Name']) . "'>
                            <button type='submit'>" . ($is_favorite ? '★ Remove' : '☆ Add') . "</button>
                        </form>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No artists found</td></tr>";
    }
    ?>
</table>