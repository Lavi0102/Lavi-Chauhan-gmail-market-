
<?php
session_start();
include 'db/db.php';

if ($_POST['admin_pass'] ?? '' === 'Lavi@2022') {
    $_SESSION['admin'] = true;
}

if ($_POST['add_gmail'] && isset($_SESSION['admin'])) {
    $gmail = $_POST['gmail'];
    $password = $_POST['password'];
    $price = $_POST['price'];
    $db->exec("INSERT INTO gmails (gmail, password, price, unlocked) VALUES ('$gmail', '$password', $price, 0)");
    echo "<p>✅ Gmail Added!</p>";
}

$result = $db->query("SELECT * FROM gmails");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Gmail Marketplace</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<h1>📧 Gmail Marketplace</h1>

<?php if (!isset($_SESSION['admin'])): ?>
<form method="POST">
    <input type="password" name="admin_pass" placeholder="Admin Password">
    <button type="submit">Login as Admin</button>
</form>
<?php else: ?>
<h3>➕ Add Gmail</h3>
<form method="POST">
    <input type="hidden" name="add_gmail" value="1">
    Gmail: <input name="gmail" required><br>
    Password: <input name="password" required><br>
    Price (₹): <input name="price" type="number" required><br>
    <button type="submit">Add Gmail</button>
</form>
<?php endif; ?>

<hr>

<?php while($row = $result->fetchArray()): ?>
<div class="gmail-box">
    <p><strong>Gmail:</strong> <?= $row['gmail'] ?></p>
    <p><strong>Price:</strong> ₹<?= $row['price'] ?></p>
    <?php if ($row['unlocked']): ?>
        <p><strong>Password:</strong> <?= $row['password'] ?></p>
    <?php else: ?>
        <p><strong>Password:</strong> 🔒 Hidden</p>
        <img src="qr.jpg" alt="QR Code" width="150"><br>
        <form method="POST" action="submit.php">
            <input type="hidden" name="gmail_id" value="<?= $row['id'] ?>">
            <input type="text" name="upi_id" placeholder="Enter UPI Transaction ID" required>
            <button type="submit">Submit Payment Info</button>
        </form>
    <?php endif; ?>
</div>
<?php endwhile; ?>

</body>
</html>
