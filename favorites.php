<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorite Artists</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>My Favorite Artists</h2>
    <?php
    if (!empty($_SESSION['favorites'])) {
        echo "<table>
                <tr>
                    <th>Artist Name</th>
                    <th>Action</th>
                </tr>";
        
        foreach ($_SESSION['favorites'] as $artist) {
            $artist_url = 'artist_details.php?artist=' . urlencode($artist);
            echo "<tr>
                    <td><a href='" . $artist_url . "'>" . htmlspecialchars($artist) . "</a></td>
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
    <p><a href="display_artists.php">Back to all artists</a></p>
</body>
</html>