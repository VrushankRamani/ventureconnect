<?php
include 'db.php';

$msg = "";

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $check = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $check);

    if (mysqli_num_rows($result) > 0) {
        $msg = "Email already registered!";
    } else {
        $sql = "INSERT INTO users(name, email, password, role)
                VALUES('$name', '$email', '$password', '$role')";

        if (mysqli_query($conn, $sql)) {
            $msg = "Registration successful. You can login now.";
        } else {
            $msg = "Registration failed.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - VentureConnect</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="form-box">
    <h2>Create Account</h2>

    <p class="msg"><?php echo $msg; ?></p>

    <form method="POST">
        <input type="text" name="name" placeholder="Enter Name" required>

        <input type="email" name="email" placeholder="Enter Email" required>

        <input type="password" name="password" placeholder="Enter Password" required>

        <select name="role" required>
            <option value="">Select Role</option>
            <option value="founder">Founder</option>
            <option value="investor">Investor</option>
        </select>

        <button type="submit" name="register">Register</button>
    </form>

    <p>Already have account? <a href="login.php">Login</a></p>
</div>

</body>
</html>