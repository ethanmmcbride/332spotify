<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['artist_name'])) {
    $artist_name = $_POST['artist_name'];
    
    if (!isset($_SESSION['favorites'])) {
        $_SESSION['favorites'] = array();
    }
    
    $key = array_search($artist_name, $_SESSION['favorites']);
    if ($key !== false) {
        // Remove from favorites
        unset($_SESSION['favorites'][$key]);
    } else {
        // Add to favorites
        $_SESSION['favorites'][] = $artist_name;
    }
    
    // Redirect back to the previous page
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
?>