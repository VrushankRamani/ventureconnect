<?php
session_start();
include '../db.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'investor') {
    header("Location: ../login.php");
    exit();
}

$sql = "SELECT s.*, f.name AS founder_name
        FROM Startup s
        JOIN Founder f ON s.startup_id = f.startup_id";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Browse Startups</title>
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

    <h1>Available Startups</h1>
    <p class="sub-text">Explore startup opportunities and invest in innovative ideas.</p>

    <div class="table-box">

        <div class="table-header">
            <input type="text" id="searchInput" placeholder="Search startup, founder or industry..." onkeyup="searchTable()">

            <select id="industryFilter" onchange="filterIndustry()">
                <option value="">All Industries</option>
                <option value="Technology">Technology</option>
                <option value="Healthcare">Healthcare</option>
                <option value="Education">Education</option>
                <option value="Energy">Energy</option>
                <option value="Finance">Finance</option>
                <option value="E-commerce">E-commerce</option>
                <option value="Agriculture">Agriculture</option>
                <option value="Logistics">Logistics</option>
            </select>
        </div>

        <table id="startupTable">
            <tr>
                <th>Startup</th>
                <th>Founder</th>
                <th>Industry</th>
                <th>Founded Year</th>
                <th>Valuation</th>
                <th>Action</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td>
                    <b><?php echo $row['name']; ?></b>
                </td>

                <td><?php echo $row['founder_name']; ?></td>

                <td>
                    <span class="badge"><?php echo $row['industry']; ?></span>
                </td>

                <td><?php echo $row['founded_year']; ?></td>

                <td>₹<?php echo number_format($row['valuation'], 2); ?></td>

                <td>
                    <a class="btn-invest" href="invest.php?startup_id=<?php echo $row['startup_id']; ?>">
                        Invest
                    </a>
                </td>
            </tr>
            <?php } ?>
        </table>

    </div>

</div>

<script>
function searchTable() {
    let input = document.getElementById("searchInput").value.toLowerCase();
    let table = document.getElementById("startupTable");
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

function filterIndustry() {
    let filter = document.getElementById("industryFilter").value.toLowerCase();
    let table = document.getElementById("startupTable");
    let rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length; i++) {
        let industry = rows[i].getElementsByTagName("td")[2].innerText.toLowerCase();

        if (filter == "" || industry == filter) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
}
</script>

</body>
</html>