<?php
session_start();
include '../db.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$founders = mysqli_query($conn, "SELECT * FROM Founder");
$investors = mysqli_query($conn, "SELECT * FROM Investor");

if (!$founders || !$investors) {
    die("Query Failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Users</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="navbar">
    <h2>VentureConnect</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="startups.php">Startups</a>
    <a href="users.php">Users</a>
    <a href="../logout.php">Logout</a>
</div>

<div class="container">

    <h1>Users Management</h1>
    <p class="sub-text">View registered founders and investors.</p>

    <div class="table-box">
        <h2>Founders</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Equity</th>
                <th>Startup ID</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($founders)) { ?>
            <tr>
                <td>#<?php echo $row['founder_id']; ?></td>
                <td><b><?php echo $row['name']; ?></b></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['equity_percent']; ?>%</td>
                <td><?php echo $row['startup_id']; ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>

    <br>

    <div class="table-box">
        <h2>Investors</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Investor Type</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($investors)) { ?>
            <tr>
                <td>#<?php echo $row['investor_id']; ?></td>
                <td><b><?php echo $row['name']; ?></b></td>
                <td><?php echo $row['email']; ?></td>
                <td><span class="badge"><?php echo $row['investor_type']; ?></span></td>
            </tr>
            <?php } ?>
        </table>
    </div>

</div>

</body>
</html>