<?php
require 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $birth_date = $_POST['birth_date'];

    $stmt = $conn->prepare("INSERT INTO session (username, email, password, name, gender, phone, address, birth_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$username, $email, $password, $name, $gender, $phone, $address, $birth_date]);
    header('Location: login.php');
}
?>
<!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <form action="register.php" method="POST" class="form">
            <h2>Register</h2>
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="name" placeholder="Full Name">
            <select name="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <input type="text" name="phone" placeholder="Phone Number">
            <input type="text" name="address" placeholder="Address">
            <input type="date" name="birth_date" placeholder="Birth Date">
            <button type="submit">Register</button>
            <br><br>
            <p>Already Have Account? <a href="login.php">Sign in</a></p>
        </form>
    </div>
</body>
</html>
