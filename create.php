<?php

/** @var mysqli $db */
require_once 'includes/database.php';

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $artist = $_POST['artist'];
    $genre = $_POST['genre'];
    $year = $_POST['year'];
    $tracks = $_POST['tracks'];
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


        $query = "INSERT INTO `albums`(`name`, `artist`, `genre`, `year`, `tracks`) 
                VALUES ('$name', '$artist', '$genre', $year, $tracks)";

        $result = mysqli_query($db, $query)
        or die('Error '.mysqli_error($db).' with query '.$query);

        header(header: 'Location: index.php');
        exit;
    }



    mysqli_close($db);

}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>Muziekalbums - Create</title>
</head>
<body>
<div class="container px-4">

    <section class="columns is-centered">
        <div class="column is-10">
            <h2 class="title mt-4">Create new album</h2>

            <form class="column is-6" action="" method="post">

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="name">Name</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" id="name" type="text" name="name" value="<?= isset($_POST['name']) ? $_POST['name'] : ''; ?>"/>
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
                        <label class="label" for="artist">Artist</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" id="artist" type="text" name="artist" value="<?= isset($_POST['artist']) ? $_POST['artist'] : ''; ?>"/>
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
                        <label class="label" for="genre">Genre</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" id="genre" type="text" name="genre" value="<?= isset($_POST['genre']) ? $_POST['genre'] : ''; ?>"/>
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
                        <label class="label" for="year">Year</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" id="year" type="number" name="year" value="<?= isset($_POST['year']) ? $_POST['year'] : ''; ?>"/>
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
                        <label class="label" for="tracks">Tracks</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" id="tracks" type="number" name="tracks" value="<?= isset($_POST['tracks']) ? $_POST['tracks'] : ''; ?>"/>
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
