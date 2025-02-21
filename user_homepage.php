<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Homepage - Library Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Welcome, <?php echo $_SESSION['user']; ?></h2>
        <a href="./reports/reports.php" class="btn btn-primary">View Reports</a>
        <a href="./transaction/transaction.php" class="btn btn-secondary">Manage Transactions</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</body>
</html>
