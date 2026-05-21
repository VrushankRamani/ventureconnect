<?php
session_start();
include '../db.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$sql = "
SELECT 
    inv.investment_id,
    i.name AS investor_name,
    i.investor_type,
    s.name AS startup_name,
    s.industry,
    fr.round_type,
    inv.amount,
    inv.equity_given
FROM Investment inv
JOIN Investor i ON inv.investor_id = i.investor_id
JOIN Funding_Round fr ON inv.round_id = fr.round_id
JOIN Startup s ON fr.startup_id = s.startup_id
ORDER BY inv.investment_id DESC
";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Investments</title>
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
    <h1>All Investments</h1>
    <p class="sub-text">Admin can view all investor funding records.</p>

    <div class="table-box">
        <table>
            <tr>
                <th>ID</th>
                <th>Investor</th>
                <th>Type</th>
                <th>Startup</th>
                <th>Industry</th>
                <th>Round</th>
                <th>Amount</th>
                <th>Equity</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td>#<?php echo $row['investment_id']; ?></td>
                <td><b><?php echo $row['investor_name']; ?></b></td>
                <td><span class="badge"><?php echo $row['investor_type']; ?></span></td>
                <td><?php echo $row['startup_name']; ?></td>
                <td><?php echo $row['industry']; ?></td>
                <td><?php echo $row['round_type']; ?></td>
                <td><span class="amount">₹<?php echo number_format($row['amount'], 2); ?></span></td>
                <td><?php echo $row['equity_given']; ?>%</td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

</body>
</html>