<?php
session_start();  

include '../../dbcon.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['login'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM adminLogin WHERE name = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {

            $_SESSION['logged_in'] = true;  
            $_SESSION['username'] = $username;  


            header("Location: ../admin.php");  
            exit();
        } else {
            echo "Nieprawidłowe hasło.";
        }
    } else {
        echo "Nie znaleziono użytkownika.";
    }
}

$conn->close();
