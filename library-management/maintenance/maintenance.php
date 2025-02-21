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
    <title>Maintenance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 30px;
        }

        .section {
            margin-top: 20px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .btn-group {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-between mb-3">
        <a href="<?= $homePage ?>" class="btn btn-primary">Home</a>
        <a href="../logout.php" class="btn btn-danger">Log Out</a>
    </div>
    <div class="container">
        <h2 class="text-center">Maintenance</h2>


        <!-- <div class="section">
        <h4>Housekeeping</h4>
        <a href="housekeeping.php" class="btn btn-primary">Manage Housekeeping</a>
    </div> -->


        <div class="section">
            <h4>Membership</h4>
            <div class="btn-group">
                <a href="./membership/membership_add.php" class="btn btn-success">Add</a>
                <a href="./membership/membership_update.php" class="btn btn-warning">Update</a>
            </div>
        </div>


        <div class="section">
            <h4>Books/Movies</h4>
            <div class="btn-group">
                <a href="./books/movies/add.php" class="btn btn-success">Add</a>
                <a href="./books/movies/update.php" class="btn btn-warning">Update</a>
            </div>
        </div>


        <div class="section">
            <h4>User Management</h4>
            <div class="btn-group">
                <a href="./user_mgmt/add.php" class="btn btn-success">Add</a>
                <a href="./user_mgmt/update.php" class="btn btn-warning">Update</a>
            </div>
        </div>
    </div>

</body>

</html>