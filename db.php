<?php
$conn = mysqli_connect("localhost", "root", "Patel#45", "StartupInvestmentDB");

if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>