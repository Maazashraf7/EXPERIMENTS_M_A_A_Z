<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}
include('./includes/db.php');
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if (!$result) {
    die("SQL Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Homepage - Library Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Welcome, Admin <?php echo $_SESSION['admin']; ?>!</h2>
        <a href="/maintenance/maintenance.php" class="btn btn-primary">Maintenance</a>
        <a href="/reports/reports.php" class="btn btn-secondary">View Reports</a>
        <a href="/transaction/transaction.php" class="btn btn-info">Manage Transactions</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
    <div class="container mt-4">
    <h2 class="text-center">Product Details</h2>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Code No From</th>
                <th>Code No To</th>
                <th>Category</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['code_from']); ?></td>
                <td><?php echo htmlspecialchars($row['code_to']); ?></td>
                <td><?php echo htmlspecialchars($row['category']); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
