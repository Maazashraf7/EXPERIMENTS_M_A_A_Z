<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Confirmation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            width: 100%;
            padding: 10px 20px;
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>

    <div class="container">
        <h4 class="fw-bold">You have Successfully logout.</h4>
        <a href="/index.php" class="btn btn-danger btn-sm">LogIN</a>
    </div>


</body>

</html>
<?php
session_start();
session_unset(); // Remove all session variables
session_destroy(); // Destroy the session
// header("Location: index.php"); // Redirect to login page
exit();
?>