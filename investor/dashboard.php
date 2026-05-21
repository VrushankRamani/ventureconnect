<?php
session_start();
include '../db.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'investor') {
    header("Location: ../login.php");
    exit();
}

$investor_id = $_SESSION['id'];

$q1 = "SELECT COUNT(*) AS total FROM Investment WHERE investor_id='$investor_id'";
$r1 = mysqli_query($conn, $q1);
$d1 = mysqli_fetch_assoc($r1);

$q2 = "SELECT IFNULL(SUM(amount),0) AS total_amount FROM Investment WHERE investor_id='$investor_id'";
$r2 = mysqli_query($conn, $q2);
$d2 = mysqli_fetch_assoc($r2);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Investor Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="navbar">
    <h2>VentureConnect</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="startups.php">Browse Startups</a>
    <a href="my_investments.php">My Investments</a>
    <a href="../logout.php">Logout</a>
</div>

<div class="container">
    <h1>Welcome Investor, <?php echo $_SESSION['name']; ?></h1>

    <<div class="cards">

    <a href="my_investments.php" class="card-link">
        <div class="card clickable-card">
            <h3>Total Investments</h3>
            <p><?php echo $d1['total']; ?></p>
            <span>View Investments →</span>
        </div>
    </a>

    <a href="my_investments.php" class="card-link">
        <div class="card clickable-card">
            <h3>Total Amount Invested</h3>
            <p>₹<?php echo $d2['total_amount']; ?></p>
            <span>View Portfolio →</span>
        </div>
    </a>

    <a href="startups.php" class="card-link">
        <div class="card clickable-card">
            <h3>Browse Startups</h3>
            <p>+</p>
            <span>Find Opportunities →</span>
        </div>
    </a>

</div>
</div>
<footer class="footer">
    © 2026 VentureConnect | Developed by Vrushank Ramani
</footer>

</body>
</html>