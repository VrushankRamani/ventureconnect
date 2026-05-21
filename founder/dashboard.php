<?php
session_start();
include '../db.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'founder') {
    header("Location: ../login.php");
    exit();
}

$founder_id = $_SESSION['id'];

$query1 = "
SELECT COUNT(*) AS total 
FROM Startup 
WHERE startup_id IN (
    SELECT startup_id FROM Founder WHERE founder_id='$founder_id'
)";

$result1 = mysqli_query($conn, $query1);
$data1 = mysqli_fetch_assoc($result1);

$query2 = "
SELECT IFNULL(SUM(i.amount),0) AS total_funding
FROM Investment i
JOIN Funding_Round fr ON i.round_id = fr.round_id
JOIN Startup s ON fr.startup_id = s.startup_id
JOIN Founder f ON s.startup_id = f.startup_id
WHERE f.founder_id='$founder_id'
";

$result2 = mysqli_query($conn, $query2);
$data2 = mysqli_fetch_assoc($result2);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Founder Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="navbar">
    <h2>VentureConnect</h2>

    <a href="dashboard.php">Dashboard</a>

    <a href="my_startups.php">My Startup</a>

    <a href="funding.php">Funding</a>

    <a href="../logout.php">Logout</a>
</div>

<div class="container">

    <h1>Welcome Founder, <?php echo $_SESSION['name']; ?></h1>

   <div class="cards">

    <a href="my_startups.php" class="card-link">
        <div class="card clickable-card">
            <h3>Total Startups</h3>
            <p><?php echo $data1['total']; ?></p>
            <span>View My Startup →</span>
        </div>
    </a>

    <a href="funding.php" class="card-link">
        <div class="card clickable-card">
            <h3>Total Funding</h3>
            <p>₹<?php echo $data2['total_funding']; ?></p>
            <span>View Funding →</span>
        </div>
    </a>

</div>

</div>
<footer class="footer">
    © 2026 VentureConnect | Developed by Vrushank Ramani
</footer>
</body>
</html>