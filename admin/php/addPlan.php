<?php
session_start();

include '../../dbcon.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = $_POST['title'];
    $description = $_POST['description'];
    
    $date = $_POST['date'];
    $img = $_POST['img'] === ''?  'gear.png' : $_POST['img'] ;
 
    

    

    $sql = "INSERT INTO plany (tytul, opis, przewidywanaData, zdjecie) 
            VALUES ('$title', '$description', '$date', '$img')";
    

    if ($conn->query($sql) === TRUE) {
        $_SESSION['success_message_plans'] = "Plan został dodany pomyślnie!";
    } else {
        $_SESSION['error_message_plans'] = "Błąd podczas dodawania planu: " . $conn->error;
    }
    $_SESSION['last_active'] = "addPlan";


    $conn->close();

    header("Location: ../admin.php");
    exit();
}

