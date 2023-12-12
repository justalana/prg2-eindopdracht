<?php
//Check if ID is valid
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
//Error bericht aanpassen zodat die in html staat ipv de php
//variabelen apart aanpassen ipv in 1 statement
if(isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $artist = mysqli_real_escape_string($db, $_POST['artist']);
    $genre = mysqli_real_escape_string($db, $_POST['genre']);
    $year = mysqli_real_escape_string($db, $_POST['year']);
    $tracks = mysqli_real_escape_string($db, $_POST['tracks']);
    if ($name == "") {
        $nameError = "Album cannot be empty";
    } if  ($artist == "") {
        $artistError = "Artist cannot be empty";
    } if ($genre == "") {
        $genreError = "Genre cannot be empty";
    } if ($year == "" || !is_numeric($_POST['tracks'])) {
        $yearError = "Must be a valid year";
    } if ($tracks == "" || !is_numeric($_POST['tracks'] )) {
        $trackError = "Tracks cannot be empty";
    } else {


        $query = "UPDATE albums 
                SET `name`='$name',`artist`='$artist',`genre`='$genre',`year`=$year,`tracks`=$tracks   
                WHERE id =" .$id;
        echo $query;
        exit;
        $result = mysqli_query($db, $query)
        or die('Error '.mysqli_error($db).' with query '.$query);

        header(header: 'Location: index.php');
        exit;
    }

}
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <title>Music Collection Edit</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body>
<div class="container px-4">

    <section class="columns is-centered">
        <div class="column is-10">
            <h2 class="title mt-4">Edit <?= $album['name']?></h2>

            <form class="column is-6" action="" method="post">

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="name">Name</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" id="name" type="text" name="name" value="<?= $album['album_name']?>"/>
                            </div>
                            <?php if(isset($nameError)) { ?>
                                <p class="help is-danger">
                                    <?= $nameError ?>
                                </p>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="name">Artist</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" id="artist" type="text" name="artist" value="<?= $album['name']?>"/>
                            </div>
                            <?php if(isset($artistError)) { ?>
                                <p class="help is-danger">
                                    <?= $artistError ?>
                                </p>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="name">Genre</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" id="genre" type="text" name="genre" value="<?= $album['genre']?>"/>
                            </div>
                            <?php if(isset($genreError)) { ?>
                                <p class="help is-danger">
                                    <?= $genreError ?>
                                </p>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="name">Year</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" id="year" type="number" name="year" value="<?= $album['year']?>"/>
                            </div>
                            <?php if(isset($yearError)) { ?>
                                <p class="help is-danger">
                                    <?= $yearError ?>
                                </p>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="name">Tracks</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" id="tracks" type="number" name="tracks" value="<?= $album['tracks']?>"/>
                            </div>
                            <?php if(isset($trackError)) { ?>
                                <p class="help is-danger">
                                    <?= $trackError ?>
                                </p>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal"></div>
                    <div class="field-body">
                        <button class="button is-link is-fullwidth" type="submit" name="submit">Save</button>
                    </div>
                </div>
            </form>

            <a class="button mt-4" href="index.php">&laquo; Go back to the list</a>
        </div>
    </section>
</div>
</body>
</html>
