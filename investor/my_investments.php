<?php
session_start();
include '../db.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'investor') {
    header("Location: ../login.php");
    exit();
}

$investor_id = $_SESSION['id'];

$sql = "
SELECT 
    inv.investment_id,
    s.name AS startup_name,
    s.industry,
    fr.round_type,
    fr.round_date,
    fr.valuation_after,
    inv.amount,
    inv.equity_given

FROM Investment inv

JOIN Funding_Round fr 
ON inv.round_id = fr.round_id

JOIN Startup s 
ON fr.startup_id = s.startup_id

WHERE inv.investor_id='$investor_id'

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
    <title>My Investments</title>
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

    <h1>Investment History</h1>

    <p class="sub-text">
        Track all your startup investments and funding activities.
    </p>

    <div class="table-box">

        <div class="table-header">

            <input type="text" id="searchInput" placeholder="Search startup or industry..." onkeyup="searchTable()">

        </div>

        <table id="investmentTable">

            <tr>
                <th>ID</th>
                <th>Startup</th>
                <th>Industry</th>
                <th>Round</th>
                <th>Round Date</th>
                <th>Valuation</th>
                <th>Amount</th>
                <th>Equity</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($result)) { ?>

            <tr>

                <td>#<?php echo $row['investment_id']; ?></td>

                <td>
                    <b><?php echo $row['startup_name']; ?></b>
                </td>

                <td>
                    <span class="badge">
                        <?php echo $row['industry']; ?>
                    </span>
                </td>

                <td><?php echo $row['round_type']; ?></td>

                <td><?php echo $row['round_date']; ?></td>

                <td>
                    ₹<?php echo number_format($row['valuation_after'], 2); ?>
                </td>

                <td>
                    <span class="amount">
                        ₹<?php echo number_format($row['amount'], 2); ?>
                    </span>
                </td>

                <td>
                    <?php echo $row['equity_given']; ?>%
                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

<script>
function searchTable() {

    let input = document.getElementById("searchInput").value.toLowerCase();

    let table = document.getElementById("investmentTable");

    let rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length; i++) {

        let text = rows[i].innerText.toLowerCase();

        if (text.includes(input)) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
}
</script>

</body>
</html>