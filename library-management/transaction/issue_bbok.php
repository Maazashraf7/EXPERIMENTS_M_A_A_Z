<?php
session_start();
include('../includes/db.php');

// Ensure session role is set
$_SESSION['role'] = $_SESSION['role'] ?? 'user';
$homePage = ($_SESSION['role'] === 'admin') ? '../admin_homepage.php' : '../user_homepage.php';

$bookQuery = "SELECT id, book_name FROM books";
$bookResult = $conn->query($bookQuery);

$message = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST['book_id'] ?? null;
    $author_name = trim($_POST['author_name'] ?? "");
    $issue_date = $_POST['issue_date'] ?? null;
    $return_date = $_POST['return_date'] ?? null;
    $remarks = trim($_POST['remarks'] ?? '');

    if (empty($book_id) || empty($author_name) || empty($issue_date) || empty($return_date)) {
        $message = "<p class='text-danger text-center fw-bold'>All mandatory fields must be filled!</p>";
    } else {
        $sql = "INSERT INTO issue_books (book_id, author_name, issue_date, return_date, remarks) 
                VALUES (?, ?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("issss", $book_id, $author_name, $issue_date, $return_date, $remarks);
            if ($stmt->execute()) {
                $stmt->close();
                $conn->close();
                header("Location: ../maintenance/confirmation.php?success=true");
                exit(); 
            } else {
                $message = "<p class='text-danger text-center fw-bold'>Error: " . $stmt->error . "</p>";
            }
            $stmt->close();
        } else {
            $message = "<p class='text-danger text-center fw-bold'>Database Error: " . $conn->error . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issue Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <div class="d-flex justify-content-between mb-3">
        <a href="<?= htmlspecialchars($homePage) ?>" class="btn btn-primary">Home</a>
        <a href="../logout.php" class="btn btn-danger">Log Out</a>
    </div>

    <div class="card shadow p-4 mx-auto" style="max-width: 500px;">
        <h2 class="text-center mb-3">Issue Book</h2>

        <?= $message ?>

        <form action="" method="POST">
            <div class="mb-3">
                <label class="form-label">Select Book:</label>
                <select name="book_id" class="form-select" required>
                    <option value="">-- Select Book --</option>
                    <?php while ($row = $bookResult->fetch_assoc()) { ?>
                        <option value="<?= htmlspecialchars($row['id']); ?>"><?= htmlspecialchars($row['book_name']); ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Enter Author:</label>
                <input type="text" name="author_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Issue Date:</label>
                <input type="date" name="issue_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Return Date:</label>
                <input type="date" name="return_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Remarks (Optional):</label>
                <textarea name="remarks" class="form-control"></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Confirm</button>
                <a href="../transaction_cancelled.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>

<?php $conn->close(); ?>
