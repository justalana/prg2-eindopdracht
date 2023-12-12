<?php
/** @var mysqli $db */
// Setup connection with database
require_once 'includes/database.php';

// Select all the albums from the database
$query = "SELECT * FROM albums INNER JOIN artists ON albums.artist_id = artists.artist_id";
$result = mysqli_query($db, $query)
or die('Error '.mysqli_error($db).' with query '.$query);

// Store the albums in an array
$albums = [];
while($row = mysqli_fetch_assoc($result))
{
    $albums[] = $row;
}
// Close the connection
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Music Collection</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body>
<div class="container px-4">
    <h1 class="title mt-4">Music Collection</h1>
    <hr>
    <div>
        <a class="button" href="create.php">Create new album</a>
    </div>
    <div class="columns is-centered">
        <div class="column is-narrow">

            <table class="table is-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Artist</th>
                    <th>Album</th>
                    <th>Genre</th>
                    <th>Year</th>
                    <th>Tracks</th>
                    <th></th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <td colspan="9" class="has-text-centered">&copy; My Collection</td>
                </tr>
                </tfoot>
                <tbody>
                <?php foreach ($albums as $index => $album) { ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $album['name'] ?></td>
                        <td><?= $album['album_name'] ?></td>
                        <td><?= $album['genre'] ?></td>
                        <td><?= $album['year'] ?></td>
                        <td><?= $album['tracks'] ?></td>
                        <td><a href="details.php?id=<?= $album['id'] ?>">Details</a></td>
                        <td><a href="edit.php?id=<?= $album['id'] ?>">Edit</a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>