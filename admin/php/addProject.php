<?php
session_start();

include '../../dbcon.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $url = $_POST['url'];
    $img = $_POST['img'];
    $badge = isset($_POST['badge']) && $_POST['badge'] !== '' ? $_POST['badge'] : NULL;

    $description = $_POST['description'];

    $showcase = isset($_POST['showcase']) ? 'yes' : ''; 
    $currentDate = date('Y-m-d');

    $sql = "INSERT INTO projects (nazwa, url, photo, badge, description, showcase, lastUpdate) 
            VALUES ('$name', '$url', '$img', '$badge', '$description', '$showcase', '$currentDate')";
    

    if ($conn->query($sql) === TRUE) {
        $_SESSION['success_message'] = "Projekt $name dodany pomyślnie!";
    } else {
        $_SESSION['error_message'] = "Błąd podczas dodawania projektu: " . $conn->error;
    }
    $_SESSION['last_active'] = "addProject";

    $conn->close();

    header("Location: ../admin.php");
    exit();
}


