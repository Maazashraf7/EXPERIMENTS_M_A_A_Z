<?php
session_start();
include(__DIR__ . '/../../includes/db.php');

$_SESSION['role'] = $_SESSION['role'] ?? 'user';
$homePage = ($_SESSION['role'] == 'admin') ? "/admin_homepage.php" : "/user_homepage.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="container mt-5">
<div class="d-flex justify-content-between mb-3">
        <a href="<?= $homePage ?>" class="btn btn-primary">Home</a>
        <a href="/logout.php" class="btn btn-danger">Log Out</a>
    </div>

    <h2 class="text-center">User Management</h2>

    <form action="../confirmation.php" method="POST" class="p-4 border rounded">
        <div class="mb-3">
            <label>User Type</label> <br>
            <input type="radio" name="user_type" value="new" required> New User
            <input type="radio" name="user_type" value="existing" required> Existing User
        </div>

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Status</label> <br>
            <input type="checkbox" name="status" value="active"> Active
        </div>

        <div class="mb-3">
            <label>Admin</label> <br>
            <input type="checkbox" name="admin" value="admin"> Admin
        </div>

        <button type="submit">Confirm</button>
        <a href="/transaction_cancelled.php">Cancel</a>
    </form>

</body>

</html>