<?php
session_start();
include('../includes/db.php');


$_SESSION['role'] = $_SESSION['role'] ?? 'user';
$homePage = ($_SESSION['role'] === 'admin') ? '../admin_homepage.php' : '../user_homepage.php';

$booksQuery = "SELECT DISTINCT book_name FROM books";
$booksResult = $conn->query($booksQuery);

$authorsQuery = "SELECT DISTINCT author_name FROM books";
$authorsResult = $conn->query($authorsQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Availability</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    
    <div class="d-flex justify-content-between mb-3">
        <a href="<?= htmlspecialchars($homePage) ?>" class="btn btn-primary">Home</a>
        <a href="../logout.php" class="btn btn-danger">Log Out</a>
    </div>

    <!-- Book Availability Form -->
    <div class="card shadow p-4 mx-auto" style="max-width: 500px;">
        <h2 class="text-center mb-3">Search Books</h2>

        <form action="./search.php" method="GET">
            <div class="mb-3">
                <label class="form-label">Select Book:</label>
                <select name="book_name" class="form-select">
                    <option value="">-- Any Book --</option>
                    <?php while ($row = $booksResult->fetch_assoc()) { ?>
                        <option value="<?= htmlspecialchars($row['book_name']); ?>">
                            <?= htmlspecialchars($row['book_name']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Select Author:</label>
                <select name="author" class="form-select">
                    <option value="">-- Any Author --</option>
                    <?php while ($row = $authorsResult->fetch_assoc()) { ?>
                        <option value="<?= htmlspecialchars($row['author_name']); ?>">
                            <?= htmlspecialchars($row['author_name']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <a href="javascript:history.back()" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-success">Search</button>
            </div>
        </form>
    </div>

</body>
</html>

<?php $conn->close(); ?>
