<?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('HTTP/1.0 403 Forbidden');
    exit();
}

$date = $_GET['date'];

$filepath = "./gigs/$date.json";

if (!is_readable($filepath)) {
    throw new Exception('Plik nie może być usunięty, bo prawdopodobnie nie istnieje');
} else {
    unlink($filepath);
    if (!is_readable($filepath)) {
        echo('Plik został usunięty prawidłowo');
        $_SESSION['message'] = "Wydarzenie o dacie $date zostało pomyślnie usunięte";
        $_SESSION['messageType'] = "success";
        header('Location: addNewGigForm.php');
    } else {
        throw new Exception('Plik nie został usunięty, coś poszło nie tak, spróbuj ponownie za chwilę');
    }
}
