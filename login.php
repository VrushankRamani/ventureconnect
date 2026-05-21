<?php
session_start();
include 'db.php';

$msg = "";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if ($role == "founder") {
        $sql = "SELECT * FROM Founder WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['id'] = $row['founder_id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['role'] = "founder";
            header("Location: founder/dashboard.php");
            exit();
        }
    }

    if ($role == "investor") {
        $sql = "SELECT * FROM Investor WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['id'] = $row['investor_id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['role'] = "investor";
            header("Location: investor/dashboard.php");
            exit();
        }
    }

    if ($role == "admin") {
        $sql = "SELECT * FROM Admin WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['id'] = $row['admin_id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['role'] = "admin";
            header("Location: admin/dashboard.php");
            exit();
        }
    }

    $msg = "Invalid login details!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - VentureConnect</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="form-box">
    <h2>VentureConnect Login</h2>

    <p class="msg"><?php echo $msg; ?></p>

    <form method="POST">
        <input type="email" name="email" placeholder="Enter Email" required>

        <input type="password" name="password" placeholder="Enter Password" required>

        <select name="role" required>
            <option value="">Select Role</option>
            <option value="founder">Founder</option>
            <option value="investor">Investor</option>
            <option value="admin">Admin</option>
        </select>

        <button type="submit" name="login">Login</button>
    </form>

    <p><a href="index.php">Back to Home</a></p>
</div>

</body>
</html>