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
    s.name AS startup_name,
    fr.round_type,
    fr.round_date,
    fr.valuation_after,
    i.name AS investor_name,
    inv.amount,
    inv.equity_given

FROM Founder f

JOIN Startup s 
ON f.startup_id = s.startup_id

JOIN Funding_Round fr
ON s.startup_id = fr.startup_id

LEFT JOIN Investment inv
ON fr.round_id = inv.round_id

LEFT JOIN Investor i
ON inv.investor_id = i.investor_id

WHERE f.founder_id='$founder_id'

ORDER BY fr.round_date DESC
";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Funding Analytics</title>
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

    <h1>Funding Analytics</h1>

    <p class="sub-text">
        Track all funding rounds and investments received by your startup.
    </p>

    <div class="table-box">

        <table>

            <tr>
                <th>Startup</th>
                <th>Round</th>
                <th>Round Date</th>
                <th>Valuation</th>
                <th>Investor</th>
                <th>Investment</th>
                <th>Equity Given</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($result)) { ?>

            <tr>

                <td>
                    <b><?php echo $row['startup_name']; ?></b>
                </td>

                <td>
                    <?php echo $row['round_type']; ?>
                </td>

                <td>
                    <?php echo $row['round_date']; ?>
                </td>

                <td>
                    ₹<?php echo number_format($row['valuation_after'],2); ?>
                </td>

                <td>
                    <?php echo $row['investor_name'] ? $row['investor_name'] : 'No Investor'; ?>
                </td>

                <td>
                    ₹<?php echo $row['amount'] ? number_format($row['amount'],2) : 0; ?>
                </td>

                <td>
                    <?php echo $row['equity_given'] ? $row['equity_given'] : 0; ?>%
                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>