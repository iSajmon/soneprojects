<?php 
session_start();
include '../../dbcon.php';



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];

    $action = $_POST['action'];

    if($action !== 'delete') {
        $name = $_POST['name'];
        $url = $_POST['url'];
        $img = $_POST['img'];
        $badge = $_POST['badge'];
    
        $description = $_POST['description'];
    
        $showcase = isset($_POST['showcase']) ? 'yes' : ''; 
        $currentDate = date('Y-m-d');

        $sql = "UPDATE projects SET 
                    nazwa = '$name', 
                    url = '$url', 
                    photo = '$img', 
                    badge = '$badge', 
                    description = '$description', 
                    showcase = '$showcase', 
                    lastUpdate = '$currentDate' 
                WHERE id = '$id'";
        $communicat = 'zmodyfikowany';
    } else {
        $sql = "DELETE FROM projects WHERE id = $id";
        $communicat = 'usunięty';
    }
            
        if ($conn->query($sql) === TRUE) {
            $_SESSION['success_message'] = "Projekt $name został $communicat!";
        } else {
            $_SESSION['error_message'] = "Błąd podczas modyfikacji projektu: " . $conn->error;
        }
  
    $_SESSION['last_active'] = "addProject";

    $conn->close();

    header("Location: ../admin.php");
    exit();

}