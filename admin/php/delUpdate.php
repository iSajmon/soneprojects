<?php
session_start();
include '../../dbcon.php';
    
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM `coNowego` WHERE `id` =  $id";
        $conn->query($sql);
        if ($conn->query($sql) === TRUE) {
            $_SESSION['error_message_update'] = "Aktualizacja została usunięta";
        } else {
            $_SESSION['error_message_update'] = "Błąd podczas dodawania: " . $conn->error;
        }
        
        $_SESSION['last_active'] = "addUpdate";
    }
        $conn->close();
        header("Location: ../admin.php");
        exit();