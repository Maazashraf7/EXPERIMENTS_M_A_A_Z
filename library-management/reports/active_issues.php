<?php
include('../includes/db.php'); 
session_start();
$_SESSION['role'] = $_SESSION['role'] ?? 'user';
$homePage = ($_SESSION['role'] === 'admin') ? '../admin_homepage.php' : '../user_homepage.php';

// Fetch Issued Books from the Database
$sql = "SELECT 
            issue_books.id AS issue_id, 
            books.book_name, 
            issue_books.author_name, 
            issue_books.issue_date, 
            issue_books.return_date 
        FROM issue_books
        INNER JOIN books ON issue_books.book_id = books.id";

$result = mysqli_query($conn, $sql);
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Active Issues</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { margin-top: 30px; }
        .table { margin-top: 20px; }
    </style>
</head>
<body>
<div class="d-flex justify-content-between mb-3">
        <a href="<?= $homePage ?>" class="btn btn-primary">Home</a>
        <a href="/logout.php" class="btn btn-danger">Log Out</a>
</div>

<div class="container">
    <h2 class="text-center">Issued Books Report</h2>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Serial No</th>
                <th>Book Name</th>
                <th>Author</th>
                <th>Issue Date</th>
                <th>Return Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                $serial_no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$serial_no}</td>
                        <td>{$row['book_name']}</td>
                        <td>{$row['author_name']}</td>
                        <td>{$row['issue_date']}</td>
                        <td>{$row['return_date']}</td>
                    </tr>";
                    $serial_no++;
                }
            } else {
                echo "<tr><td colspan='5' class='text-center text-danger'>No books issued</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="reports.php" class="btn btn-secondary">Back</a>
</div>

</body>
</html>

<?php mysqli_close($conn); ?> 
