<?php
session_start();
include '../db.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$sql = "
SELECT 
    s.startup_id,
    s.name AS startup_name,
    s.industry,
    s.founded_year,
    s.valuation,
    f.name AS founder_name,
    f.email AS founder_email
FROM Startup s
LEFT JOIN Founder f 
ON s.startup_id = f.startup_id
ORDER BY s.startup_id DESC
";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Startups</title>
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

    <h1>All Startups</h1>
    <p class="sub-text">Admin can view all startup records and founder details.</p>

    <div class="table-box">

        <table>
            <tr>
                <th>ID</th>
                <th>Startup</th>
                <th>Industry</th>
                <th>Founded Year</th>
                <th>Valuation</th>
                <th>Founder</th>
                <th>Founder Email</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td>#<?php echo $row['startup_id']; ?></td>
                <td><b><?php echo $row['startup_name']; ?></b></td>
                <td><span class="badge"><?php echo $row['industry']; ?></span></td>
                <td><?php echo $row['founded_year']; ?></td>
                <td>₹<?php echo number_format($row['valuation'], 2); ?></td>
                <td><?php echo $row['founder_name']; ?></td>
                <td><?php echo $row['founder_email']; ?></td>
            </tr>
            <?php } ?>
        </table>

    </div>

</div>

</body>
</html>