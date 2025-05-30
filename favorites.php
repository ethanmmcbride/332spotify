<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorite Artists</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>My Favorite Artists</h2>
    <?php
    if (!empty($_SESSION['favorites'])) {
        echo "<table>
                <tr>
                    <th>Artist Name</th>
                    <th> </th>
                </tr>";
        
        foreach ($_SESSION['favorites'] as $artist) {
            $artist_url = 'artist_details.php?artist=' . urlencode($artist);
            echo "<tr style='cursor: pointer;' onclick=\"window.location='". $artist_url . "'\">
                    <td>" . htmlspecialchars($artist) . "</td>
                    <td>
                        <form method='post' action='toggle_favorite.php' style='display: inline;'>
                            <input type='hidden' name='artist_name' value='" . htmlspecialchars($artist) . "'>
                            <button type='submit'>Remove</button>
                        </form>
                    </td>
                  </tr>";
        }
        
        echo "</table>";
    } else {
        echo "<p>You haven't added any artists to your favorites yet.</p>";
    }
    ?>
</body>
</html>