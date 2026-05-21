<?php
session_start();
include '../db.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$startup_q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM Startup");
$startup = mysqli_fetch_assoc($startup_q);

$founder_q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM Founder");
$founder = mysqli_fetch_assoc($founder_q);

$investor_q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM Investor");
$investor = mysqli_fetch_assoc($investor_q);

$investment_q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM Investment");
$investment = mysqli_fetch_assoc($investment_q);

$amount_q = mysqli_query($conn, "SELECT IFNULL(SUM(amount),0) AS total FROM Investment");
$amount = mysqli_fetch_assoc($amount_q);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="navbar">
    <h2>VentureConnect</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="startups.php">Startups</a>
    <a href="users.php">Users</a>
    <a href="investments.php">Investments</a>
    <a href="../logout.php">Logout</a>
</div>

<div class="container">
    <h1>Welcome Admin, <?php echo $_SESSION['name']; ?></h1>

  <div class="cards">

    <a href="startups.php" class="card-link">
        <div class="card clickable-card">
            <h3>Total Startups</h3>
            <p><?php echo $startup['total']; ?></p>
            <span>View Startups →</span>
        </div>
    </a>

    <a href="users.php" class="card-link">
        <div class="card clickable-card">
            <h3>Total Founders</h3>
            <p><?php echo $founder['total']; ?></p>
            <span>View Founders →</span>
        </div>
    </a>

    <a href="users.php" class="card-link">
        <div class="card clickable-card">
            <h3>Total Investors</h3>
            <p><?php echo $investor['total']; ?></p>
            <span>View Investors →</span>
        </div>
    </a>

    <a href="startups.php" class="card-link">
        <div class="card clickable-card">
            <h3>Total Investments</h3>
            <p><?php echo $investment['total']; ?></p>
            <span>View Records →</span>
        </div>
    </a>

    <a href="startups.php" class="card-link">
        <div class="card clickable-card">
            <h3>Total Funding</h3>
            <p>₹<?php echo $amount['total']; ?></p>
            <span>View Funding →</span>
        </div>
    </a>
    

</div>
    </div>
</div>
<footer class="footer">
    © 2026 VentureConnect | Developed by Vrushank Ramani
</footer>
</body>
</html>