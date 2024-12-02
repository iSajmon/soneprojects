<?php
session_start();
include '../../dbcon.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['update']) && is_array($_POST['update'])) {
 
        $zmiany = implode(', ', $_POST['update']);
        $data = isset($_POST['date']) ? $_POST['date'] : null;
        $id = $_POST['updatedProject'] != '' ? $_POST['updatedProject'] : null;
        
        
        $resetAutoIncrement = "ALTER TABLE coNowego AUTO_INCREMENT = 1;";
        $conn->query($resetAutoIncrement);

        $currentDate = date('d-m-Y'); 
        $currentDateUpdate = date('Y-m-d'); 
        $sql = "INSERT INTO coNowego (zmiany, data) VALUES ('$zmiany', '$currentDate')";
        $sql2 = "UPDATE `newUpdate` SET `data` = '$currentDateUpdate' WHERE `newUpdate`.`id` = 1;";
        if(isset($id)) {
            $sql3 = " UPDATE projects SET lastUpdate = '$currentDateUpdate' WHERE id LIKE $id";
            $conn->query($sql3);
        }
    
        if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE) {
            $_SESSION['success_message_update'] = "Aktualizacja została dodana";
        } else {
            $_SESSION['error_message_update'] = "Błąd podczas dodawania: " . $conn->error;
        }

    } else {
        echo "Brak danych z formularza.";
    }
    $_SESSION['last_active'] = "addUpdate";
    $conn->close();

    header("Location: ../admin.php");
    exit();
} 


