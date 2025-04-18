
<?php
$db = new SQLite3('db/data.db');
$db->exec("CREATE TABLE IF NOT EXISTS gmails (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    gmail TEXT,
    password TEXT,
    price INTEGER,
    unlocked INTEGER DEFAULT 0,
    upi_id TEXT
)");
?>
