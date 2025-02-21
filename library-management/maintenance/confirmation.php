<?php
session_start();

$_SESSION['role'] = $_SESSION['role'] ?? 'user'; 

$homePage = ($_SESSION['role'] === 'admin') ? '../admin_homepage.php' : '../user_homepage.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Confirmation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .top-bar {
            display: flex;
            justify-content: space-between;
            width: 100%;
            padding: 10px 20px;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>

<div class="top-bar d-flex justify-content-start p-3">
    <a href="<?= $homePage ?>" class="btn btn-primary">Home</a>
</div>

    <div class="container">
        <h4 class="fw-bold">Transaction completed successfully.</h4>
        <a href="logout.php" class="btn btn-danger btn-sm">Log Out</a>
    </div>

   
</body>
</html>
