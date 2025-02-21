<?php
// Start session (if not already started)
session_start();

// Database connection
include('../includes/db.php');

// Check if form data exists
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_name'], $_POST['serial_no'])) {
    $_SESSION['pay_fine_data'] = $_POST; // Store form data in session
} elseif (isset($_SESSION['pay_fine_data'])) {
    $_POST = $_SESSION['pay_fine_data']; // Retrieve session data if available
} else {
    // Redirect if accessed directly without form submission
    header("Location: return_book.php?error=unauthorized");
    exit();
}

// Extract form data
$book_name = $_POST['book_name'] ?? '';
$author_name = $_POST['author_name'] ?? '';
$serial_no = $_POST['serial_no'] ?? '';
$issue_date = $_POST['issue_date'] ?? '';
$return_date = $_POST['return_date'] ?? '';
$remarks = $_POST['remarks'] ?? '';

// Fine Calculation (Example: Rs.10 per day late)
$fine_amount = 0;
$due_date = new DateTime($issue_date);
$due_date->modify('+14 days'); // Assume 2-week return period

$returned_date = new DateTime($return_date);
if ($returned_date > $due_date) {
    $interval = $due_date->diff($returned_date);
    $days_late = $interval->days;
    $fine_amount = $days_late * 10; // Rs.10 per extra day
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay Fine</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { max-width: 400px; margin: auto; padding: 15px; border: 1px solid #ccc; }
        label, select, input, textarea, button { display: block; width: 100%; margin-top: 10px; }
        .message { color: green; font-weight: bold; }
    </style>
</head>
<body class="container mt-5">
<div class="top-bar d-flex justify-content-start p-3">
        <a href="<?= $homePage ?>" class="btn btn-primary">Home</a>
    </div>  
    <h3 class="mb-4">Pay Fine</h3>

    <form action="../maintenance/confirmation.php" method="POST">
        <!-- Book Details -->
        <div class="mb-3">
            <label class="form-label">Book Name</label>
            <input type="text" class="form-control" name="book_name" value="<?= htmlspecialchars($book_name) ?>" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Author Name</label>
            <input type="text" class="form-control" name="author_name" value="<?= htmlspecialchars($author_name) ?>" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Serial No</label>
            <input type="text" class="form-control" name="serial_no" value="<?= htmlspecialchars($serial_no) ?>" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Issue Date</label>
            <input type="date" class="form-control" name="issue_date" value="<?= htmlspecialchars($issue_date) ?>" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Return Date</label>
            <input type="date" class="form-control" name="return_date" value="<?= htmlspecialchars($return_date) ?>" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Remarks</label>
            <textarea class="form-control" name="remarks" readonly><?= htmlspecialchars($remarks) ?></textarea>
        </div>

        <!-- Fine Amount -->
        <div class="mb-3">
            <label class="form-label">Fine Amount (Rs.)</label>
            <input type="text" class="form-control" name="fine_amount" value="<?= $fine_amount ?>" readonly>
        </div>


        <!-- Buttons -->
        <div class="d-flex gap-3">
        <button type="submit">Confirm</button>
        <a href="../transaction_cancelled.php">Cancel</a>
        </div>
        <div class="text-center">
        <a href="../logout.php" class="btn btn-danger btn-logout">Log Out</a>
    </div>
    </form>

</body>
</html>
