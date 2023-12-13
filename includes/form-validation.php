<?php
$form_filled = false;
$errors = [];

    //Check if data is valid & generate error if not so
    if ($title == "") {
        $errors['title'] = "Album cannot be empty";
    } if ($author == "") {
        $authorError = "Artist cannot be empty";
    } if ($genre == "") {
        $genreError = "Genre cannot be empty";
    } if ($pages == "" || !is_numeric($_POST['pages'])) {
        $pagesError = "Must be a valid year";
    } if ($year == "" || !is_numeric($_POST['year'])) {
        $yearError = "Tracks cannot be empty";
    } else {
        $form_filled = true;
        return;
    }

