<?php
session_start();
include '../../dbcon.php';
    
    if (isset($_POST['id']) && isset($_POST['action'])) {
        $id = $_POST['id'];
        $action = $_POST['action'];
       
        if ($action === 'complete') {
            $currentDate = date('Y-m-d');
            $sql = "UPDATE plany SET ukonczone = '1', dataUkonczenia = '$currentDate' WHERE id = $id";
            if ($conn->query($sql) === TRUE) {
                $_SESSION['success_message_plans'] = "Plan został ukończony dnia: $currentDate";
            } else {
                $_SESSION['error_message_plans'] = "Błąd podczas zmiany statusu: " . $conn->error;
            }
          }else   if ($action === 'delete') {
            $sql = "DELETE FROM plany WHERE id = $id";
            if ($conn->query($sql) === TRUE) {
                $_SESSION['success_message_plans'] = "Plan został usunięty";
            } else {
                $_SESSION['error_message_plans'] = "Błąd podczas usuwania: " . $conn->error;
            }
        }

        $_SESSION['last_active'] = "addPlan";
        
    }
        $conn->close();
        header("Location: ../admin.php");
        exit();