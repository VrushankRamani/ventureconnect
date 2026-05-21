<?php
session_start();
include '../db.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'investor') {
    header("Location: ../login.php");
    exit();
}

$investor_id = $_SESSION['id'];
$startup_id = $_GET['startup_id'];

$startup_q = mysqli_query($conn, "SELECT * FROM Startup WHERE startup_id='$startup_id'");
$startup = mysqli_fetch_assoc($startup_q);

$round_q = mysqli_query($conn, "SELECT * FROM Funding_Round WHERE startup_id='$startup_id' LIMIT 1");
$round = mysqli_fetch_assoc($round_q);

$msg = "";

if (!$startup) {
    die("Startup not found.");
}

if (!$round) {
    $msg = "No funding round available for this startup.";
}

if (isset($_POST['invest']) && $round) {
    $amount = $_POST['amount'];
    $equity = $_POST['equity'];
    $round_id = $round['round_id'];

    $sql = "INSERT INTO Investment(amount, equity_given, investor_id, round_id)
            VALUES('$amount', '$equity', '$investor_id', '$round_id')";

    if (mysqli_query($conn, $sql)) {
        $msg = "Investment added successfully!";
    } else {
        $msg = "Investment failed: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Invest - VentureConnect</title>
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

    <h1>Invest in <?php echo $startup['name']; ?></h1>
    <p class="sub-text">Review startup details and enter investment amount.</p>

    <div class="invest-box">

        <div class="startup-info">
            <h2><?php echo $startup['name']; ?></h2>

            <p><b>Industry:</b> <?php echo $startup['industry']; ?></p>
            <p><b>Founded Year:</b> <?php echo $startup['founded_year']; ?></p>
            <p><b>Current Valuation:</b> ₹<?php echo number_format($startup['valuation'], 2); ?></p>

            <?php if ($round) { ?>
                <p><b>Funding Round:</b> <?php echo $round['round_type']; ?></p>
                <p><b>Round Date:</b> <?php echo $round['round_date']; ?></p>
                <p><b>Valuation After Round:</b> ₹<?php echo number_format($round['valuation_after'], 2); ?></p>
            <?php } ?>
        </div>

        <div class="invest-form">
            <h2>Investment Form</h2>

            <p class="msg"><?php echo $msg; ?></p>

            <?php if ($round) { ?>
            <form method="POST">
                <label>Investment Amount</label>
                <input type="number" name="amount" placeholder="Enter amount" required>

                <label>Equity Given (%)</label>
                <input type="number" step="0.01" name="equity" placeholder="Enter equity percentage" required>

                <button type="submit" name="invest">Confirm Investment</button>
            </form>
            <?php } ?>

            <p><a href="startups.php">Back to Startups</a></p>
        </div>

    </div>

</div>

</body>
</html>