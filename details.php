<?php

if (!isset($_GET['id']) || $_GET['id'] == '') {
    header(header: 'Location: index.php');
    exit;
}

$id = $_GET['id'];

/** @var mysqli $db */
require_once 'includes/database.php';

$query = 'SELECT * FROM albums INNER JOIN artists ON albums.artist_id = artists.artist_id WHERE id ='.$id;
$result = mysqli_query($db, $query)
or die('Error '.mysqli_error($db).' with query '.$query);

if(mysqli_num_rows($result) != 1) {
    header(header: 'Location: index.php');
    exit;
}

$album = mysqli_fetch_assoc($result);

mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>Details [ALBUM NAME] | Music Collection</title>
</head>
<body>
<div class="container px-4">
    <div class="columns is-centered">
        <div class="column is-narrow">
            <h2 class="title mt-4"><?= $album['album_name']?> details</h2>
            <section class="content">
                <ul>
                    <li>Genre: <?= $album['genre']?></li>
                    <li>Year: <?= $album['year']?></li>
                    <li>Tracks: <?= $album['tracks']?></li>
                    <li>Artist: <?= $album['name']?></li>
                </ul>
            </section>
            <div>
                <a class="button" href="index.php">Go back to the list</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>