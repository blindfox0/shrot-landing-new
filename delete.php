<?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('HTTP/1.0 403 Forbidden');
    exit();
}

$title = $_GET['title'];

$filepath = "./gigs/$title.json";

if (!is_readable($filepath)) {
    throw new Exception('Plik nie może być usunięty, bo prawdopodobnie nie istnieje');
} else {
    unlink($filepath);
    if (!is_readable($filepath)) {
        throw new Exception('Plik został usunięty prawidłowo');
    } else {
        throw new Exception('Plik nie został usunięty, coś poszło nie tak, spróbuj ponownie za chwilę');
    }
}
