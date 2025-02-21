<?php
// Database connection
include('../includes/db.php');
session_start();
$_SESSION['role'] = $_SESSION['role'] ?? 'user';
$homePage = ($_SESSION['role'] === 'admin') ? '../admin_homepage.php' : '../user_homepage.php';

// Fetch books for dropdown
$book_query = "SELECT DISTINCT book_name FROM books";
$book_result = $conn->query($book_query);

// Fetch serial numbers
$serial_query = "SELECT serial_no FROM books";
$serial_result = $conn->query($serial_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

    <!-- Top Bar -->
    <div class="d-flex justify-content-between mb-3">
        <a href="<?= $homePage ?>" class="btn btn-primary">Home</a>
        <a href="../logout.php" class="btn btn-danger">Log Out</a>
    </div>

    <!-- Return Book Form -->
    <div class="card shadow p-4 mx-auto" style="max-width: 500px;">
        <h2 class="text-center mb-3">Return Book</h2>

        <form action="./pay_fine.php" method="POST">

            <!-- Book Name Dropdown -->
            <div class="mb-3">
                <label class="form-label">Enter Book Name</label>
                <select name="book_name" class="form-select" required>
                    <option value="">Select a Book</option>
                    <?php while ($row = $book_result->fetch_assoc()): ?>
                        <option value="<?= $row['book_name']; ?>"><?= $row['book_name']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <!-- Author Name (Read-only) -->
            <div class="mb-3">
                <label class="form-label">Enter Author</label>
                <textarea class="form-control" name="author_name" readonly></textarea>
            </div>

            <!-- Serial Number Dropdown -->
            <div class="mb-3">
                <label class="form-label">Serial No <span class="text-danger">*</span></label>
                <select name="serial_no" class="form-select" required>
                    <option value="">Select Serial No</option>
                    <?php while ($row = $serial_result->fetch_assoc()): ?>
                        <option value="<?= $row['serial_no']; ?>"><?= $row['serial_no']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <!-- Issue Date (Read-only) -->
            <div class="mb-3">
                <label class="form-label">Issue Date</label>
                <input type="date" class="form-control" name="issue_date" readonly>
            </div>

            <!-- Return Date -->
            <div class="mb-3">
                <label class="form-label">Return Date</label>
                <input type="date" class="form-control" name="return_date" required>
            </div>

            <!-- Remarks (Optional) -->
            <div class="mb-3">
                <label class="form-label">Remarks</label>
                <textarea class="form-control" name="remarks"></textarea>
            </div>

            <!-- Buttons -->
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Confirm</button>
                <a href="../transaction_cancelled.php" class="btn btn-secondary">Cancel</a>
            </div>

        </form>
    </div>

</body>

</html>
