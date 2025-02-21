<?php
session_start();
include('../includes/db.php');


$_SESSION['role'] = $_SESSION['role'] ?? 'user';
$homePage = ($_SESSION['role'] === 'admin') ? '../admin_homepage.php' : '../user_homepage.php';

$book_name = $_GET['book_name'] ?? '';
$author_name = $_GET['author_name'] ?? '';

$query = "SELECT book_name, author_name, serial_no, available FROM books WHERE 1=1";
$params = [];

if (!empty($book_name)) {
    $query .= " AND book_name = ?";
    $params[] = $book_name;
}

if (!empty($author_name)) {
    $query .= " AND author = ?";
    $params[] = $author;
}

$stmt = $conn->prepare($query);

if ($params) {
    $stmt->bind_param(str_repeat("s", count($params)), ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Availability</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
<div class="d-flex justify-content-between mb-3">
        <a href="<?= htmlspecialchars($homePage) ?>" class="btn btn-primary">Home</a>
        <a href="../logout.php" class="btn btn-danger">Log Out</a>
    </div>


    <h2 class="text-center mb-3">Book Availability</h2>

    <form action="./issue_bbok.php" method="POST">
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Book Name</th>
                    <th>Author</th>
                    <th>Serial Number</th>
                    <th>Available</th>
                    <th>Select</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row['book_name']) ?></td>
                        <td><?= htmlspecialchars($row['author_name']) ?></td>
                        <td><?= htmlspecialchars($row['serial_no']) ?></td>
                        <td><?= $row['available'] === 'Y' ? 'Yes' : 'No' ?></td>
                        <td>
                            <?php if ($row['available'] === 'Y') { ?>
                                <input type="radio" name="selected_book" value="<?= $row['serial_no'] ?>" required>
                            <?php } else { ?>
                                <span class="text-danger">Not Available</span>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="text-center mt-3">
        <button type="submit" class="btn btn-success">Search</button>
        <a href="../transaction_cancelled.php">Cancel</a>
        </div>
    </form>

</body>
</html>

<?php 
$stmt->close();
?>
