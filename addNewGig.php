<?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('HTTP/1.0 403 Forbidden');
    exit();
}

$date = $_GET['date'];
$title = $_GET['title'];
$place = $_GET['place'];
$location = $_GET['location'];
$description = $_GET['description'];
$tickets = $_GET['tickets'];
$link = $_GET['link'];

$template = [
    'Date' => $date,
    'Title' => $title,
    'Place' => $place,
    'Location' => $location,
    'Description' => $description,
    'Tickets' => $tickets,
    'Link' => $link
];

$filepath = "./gigs/$date.json";

$file = fopen("./gigs/$date.json", 'w') or die('Unable to open file');
fwrite($file, json_encode($template));
fclose($file);

if (!is_readable($filepath)) {
    $_SESSION['message'] = 'Nie udało się dodać pliku, spróbuj jeszcze raz za chwilę';
    $_SESSION['messageType'] = 'error';
    header('Location: addNewGigForm.php');
    exit();
} else {
    $_SESSION['message'] = "Udało się utworzyć wydarzenie o dacie $date";
    $_SESSION['messageType'] = 'success';
    header('Location: addNewGigForm.php');
    exit();
}
