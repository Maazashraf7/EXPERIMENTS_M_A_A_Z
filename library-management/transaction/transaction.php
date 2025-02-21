<?php
session_start();
$_SESSION['role'] = $_SESSION['role'] ?? 'user';
$homePage = ($_SESSION['role'] === 'admin') ? '../admin_homepage.php' : '../user_homepage.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Transactions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

    
    <div class="d-flex justify-content-start p-3">
        <a href="<?= $homePage ?>" class="btn btn-primary">Home</a>
    </div>


    <div class="card shadow-sm p-4">
        <h2 class="h5 mb-3">Transactions</h2>
        <ul class="list-group">
            <li class="list-group-item"><a href="check_availability.php" class="text-decoration-none">Check Availability</a></li>
            <li class="list-group-item"><a href="issue_bbok.php" class="text-decoration-none">Issue Book</a></li>
            <li class="list-group-item"><a href="return_book.php" class="text-decoration-none">Return Book</a></li>
            <li class="list-group-item"><a href="pay_fine.php" class="text-decoration-none">Pay Fine</a></li>
        </ul>
    </div>

    <div class="d-flex justify-content-end p-3">
        <a href="/logout.php" class="btn btn-danger">Log Out</a>
    </div>

</body>
</html>
