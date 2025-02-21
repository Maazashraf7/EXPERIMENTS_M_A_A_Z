<?php
session_start();
include(__DIR__ . '/../../includes/db.php'); // Database connection

$_SESSION['role'] = $_SESSION['role'] ?? 'user';
$homePage = ($_SESSION['role'] == 'admin') ? "/admin_homepage.php" : "/user_homepage.php";

$error = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $contact_number = trim($_POST['contact_number']);
    $contact_address = trim($_POST['contact_address']);
    $aadhar_card_no = trim($_POST['aadhar_card_no']);
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $membership_type = $_POST['membership_type'];

    // Validate required fields
    if (empty($first_name) || empty($last_name) || empty($contact_number) || empty($contact_address) || empty($aadhar_card_no) || empty($start_date) || empty($end_date) || empty($membership_type)) {
        $error = "All fields are required!";
    } else {
        // Insert into database
        $query = "INSERT INTO memberships (first_name, last_name, contact_number, contact_address, aadhar_card_no, start_date, end_date, membership_type) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("ssssssss", $first_name, $last_name, $contact_number, $contact_address, $aadhar_card_no, $start_date, $end_date, $membership_type);
            if ($stmt->execute()) {
                header("Location: ../confirmation.php");
                exit();
            } else {
                $error = "Failed to add membership!";
            }
            $stmt->close();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Membership</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="d-flex justify-content-between mb-3">
        <a href="<?= $homePage ?>" class="btn btn-primary">Home</a>
        <a href="/logout.php" class="btn btn-danger">Log Out</a>
    </div>
    <div class="container mt-5">
        <h2 class="text-center">Add Membership</h2>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label class="form-label">First Name</label>
                <input type="text" class="form-control" name="first_name" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Last Name</label>
                <input type="text" class="form-control" name="last_name" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Contact Number</label>
                <input type="text" class="form-control" name="contact_number" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Contact Address</label>
                <textarea class="form-control" name="contact_address" rows="2" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Aadhar Card No</label>
                <input type="text" class="form-control" name="aadhar_card_no" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Start Date</label>
                <input type="date" class="form-control" name="start_date" required>
            </div>

            <div class="mb-3">
                <label class="form-label">End Date</label>
                <input type="date" class="form-control" name="end_date" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Membership Duration</label><br>
                <input type="radio" name="membership_type" value="Six Months" required> Six Months
                <input type="radio" name="membership_type" value="One Year" required> One Year
                <input type="radio" name="membership_type" value="Two Years" required> Two Years
            </div>

            <button type="submit" class="btn btn-success">Confirm</button>
            <a href="/transaction_cancelled.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

</body>

</html>

<?php $conn->close(); ?>
