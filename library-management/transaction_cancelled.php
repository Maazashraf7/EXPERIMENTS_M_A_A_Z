<?php
session_start();


$_SESSION['role'] = $_SESSION['role'] ?? 'user';


$homePage = ($_SESSION['role'] === 'admin') ? '../admin_homepage.php' : '../user_homepage.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Transaction Cancelled</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
	<style>
		body {
			display: flex;
			flex-direction: column;
			height: 100vh;
		}

		.top-bar {
			display: flex;
			justify-content: space-between;
			padding: 10px 20px;
			font-weight: bold;
		}

		.content {
			flex-grow: 1;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 24px;
			font-weight: bold;
		}

		.bottom-bar {
			text-align: right;
			padding: 10px 20px;
		}
	</style>
</head>

<body>


	<div class="top-bar">

		<span><a href="<?= $homePage ?>" class="text-decoration-none">Home</a></span>
	</div>

	<div class="content">
        <h4 class="fw-bold">Transaction cancelled.</h4>
        <a href="logout.php" class="btn btn-danger btn-sm">Log Out</a>
    </div>

</body>

</html>