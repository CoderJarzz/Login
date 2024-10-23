<?php
session_start();
require 'config.php';
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $birth_date = $_POST['birth_date'];

    $stmt = $conn->prepare("UPDATE session SET name = ?, gender = ?, phone = ?, address = ?, birth_date = ? WHERE id = ?");
    $stmt->execute([$name, $gender, $phone, $address, $birth_date, $user['id']]);

    $_SESSION['user'] = array_merge($user, [
        'name' => $name,
        'gender' => $gender,
        'phone' => $phone,
        'address' => $address,
        'birth_date' => $birth_date,
    ]);
    header('Location: profile.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <form action="edit_profile.php" method="POST" class="form">
            <h2>Edit Profile</h2>
            <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" placeholder="Full Name">
            <select name="gender">
                <option value="Male" <?php if($user['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if($user['gender'] == 'Female') echo 'selected'; ?>>Female</option>
            </select>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" placeholder="Phone Number">
            <input type="text" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" placeholder="Address">
            <input type="date" name="birth_date" value="<?php echo htmlspecialchars($user['birth_date']); ?>">
            <button type="submit">Save Changes</button>
        </form>
    </div>
</body>
</html>
