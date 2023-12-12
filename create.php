<?php

/** @var mysqli $db */
require_once 'includes/database.php';

if(isset($_POST['submit'])) {
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $author = mysqli_real_escape_string($db, $_POST['author']);
    $genre = mysqli_real_escape_string($db, $_POST['genre']);
    $pages = mysqli_real_escape_string($db, $_POST['pages']);
    $year = mysqli_real_escape_string($db, $_POST['year']);
    if ($title == "") {
        $titleError = "Album cannot be empty";
    } if  ($author == "") {
        $authorError = "Artist cannot be empty";
    } if ($genre == "") {
        $genreError = "Genre cannot be empty";
    } if ($pages == "" || !is_numeric($_POST['pages'])) {
        $pagesError = "Must be a valid year";
    } if ($year == "" || !is_numeric($_POST['year'] )) {
        $yearError = "Tracks cannot be empty";
    } else {


        $query = "INSERT INTO `book`(`title`, `author`, `genre`, `pages`, `year`) 
                VALUES ('$title', '$author', '$genre', $pages, $year)";

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
            <h2 class="title mt-4">Add new book</h2>

            <form class="column is-6" action="" method="post">

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="name">Title</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" id="title" type="text" name="title" value="<?= isset($_POST['title']) ? $_POST['title'] : ''; ?>"/>
                            </div>
                            <?php if(isset($titleError)) { ?>
                                <p class="help is-danger">
                                    <?= $titleError ?>
                                </p>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="artist">Author</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" id="author" type="text" name="author" value="<?= isset($_POST['author']) ? $_POST['author'] : ''; ?>"/>
                            </div>
                            <?php if(isset($authorError)) { ?>
                                <p class="help is-danger">
                                    <?= $authorError ?>
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
                                <select class="input" name="genre">
                                    <option value="<?php isset($_POST['genre']) ? $_POST['genre'] : ''; ?>"></option>
                                    <option value="Romance">Romance</option>
                                    <option value="Fantasy">Fantasy</option>
                                    <option value="Young Adult">Young Adult</option>
                                    <option value="LGBTQIA+">LGBTQIA</option>
                                    <option value="Sciencefiction">Sciencefiction</option>
                                    <option value="Thriller">Thriller</option>
                                </select>
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
                        <label class="label" for="year">Pages</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" id="pages" type="number" name="pages" value="<?= isset($_POST['pages']) ? $_POST['pages'] : ''; ?>"/>
                            </div>
                            <?php if(isset($pagesError)) { ?>
                                <p class="help is-danger">
                                    <?= $pagesError ?>
                                </p>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="tracks">Year</label>
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
