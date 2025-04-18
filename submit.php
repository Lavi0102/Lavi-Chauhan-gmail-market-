
<?php
include 'db/db.php';

$gmail_id = $_POST['gmail_id'];
$upi_id = trim($_POST['upi_id']);

if (strlen($upi_id) >= 10) {
    $db->exec("UPDATE gmails SET unlocked = 1, upi_id = '$upi_id' WHERE id = $gmail_id");
    echo "<p>✅ Payment verified and password unlocked.</p><a href='index.php'>Go back</a>";
} else {
    echo "<p>❌ Invalid UPI Transaction ID.</p><a href='index.php'>Try again</a>";
}
?>
