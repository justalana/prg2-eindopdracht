<?php
//Check if data is valid & generate error if not so
$submit = false;
if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $artist = $_POST['artist'];
    $genre = $_POST['genre'];
    $year = $_POST['year'];
    $tracks = $_POST['tracks'];
    if ($name == "") {
        $nameError = "Album cannot be empty";
    }
    if ($artist == "") {
        $artistError = "Artist cannot be empty";
    }
    if ($genre == "") {
        $genreError = "Genre cannot be empty";
    }
    if ($year == "" || !is_numeric($_POST['tracks'])) {
        $yearError = "Must be a valid year";
    }
    if ($tracks == "" || !is_numeric($_POST['tracks'])) {
        $trackError = "Tracks cannot be empty";
    } else {
        $submit = true;
    }
}