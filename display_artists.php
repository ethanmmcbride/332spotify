<h2>Artist List</h2>
<table>
    <tr>
        <th>Name</th>
        <th>Genre</th>
    </tr>
    <?php
    $sql = "SELECT name, genre FROM artists";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['name']) . "</td>
                    <td>" . htmlspecialchars($row['genre']) . "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No artists found</td></tr>";
    }
    ?>
</table>