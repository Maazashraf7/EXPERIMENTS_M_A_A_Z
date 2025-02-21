<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include('./includes/db.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if ($role == "user") {
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    } else {
        $sql = "SELECT * FROM admins WHERE username = '$username' AND password = '$password'";
    }

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        if ($role == "user") {
            $_SESSION['user'] = $user['username'];
            header("Location: user_homepage.php");
        } else {
            $_SESSION['admin'] = $user['username'];
            header("Location: admin_homepage.php");
        }
    } else {
        echo "<p class='text-center text-danger'>Invalid login credentials.</p>";
    }
}
?>
