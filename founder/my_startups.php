<?php
session_start();
include '../db.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'founder') {
    header("Location: ../login.php");
    exit();
}

$founder_id = $_SESSION['id'];

$sql = "
SELECT 
    s.startup_id,
    s.name AS startup_name,
    s.industry,
    s.founded_year,
    s.valuation,
    f.name AS founder_name,
    f.email,
    f.equity_percent
FROM Founder f
JOIN Startup s 
ON f.startup_id = s.startup_id
WHERE f.founder_id='$founder_id'
";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Startup</title>
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

    <h1>My Startup Details</h1>

    <p class="sub-text">
        View your startup information, valuation, and founder equity details.
    </p>

    <div class="table-box">

        <table>

            <tr>
                <th>Startup</th>
                <th>Industry</th>
                <th>Founded Year</th>
                <th>Valuation</th>
                <th>Founder</th>
                <th>Email</th>
                <th>Equity</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($result)) { ?>

            <tr>
                <td><b><?php echo $row['startup_name']; ?></b></td>

                <td>
                    <span class="badge">
                        <?php echo $row['industry']; ?>
                    </span>
                </td>

                <td><?php echo $row['founded_year']; ?></td>

                <td>₹<?php echo number_format($row['valuation'], 2); ?></td>

                <td><?php echo $row['founder_name']; ?></td>

                <td><?php echo $row['email']; ?></td>

                <td><?php echo $row['equity_percent']; ?>%</td>
            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>