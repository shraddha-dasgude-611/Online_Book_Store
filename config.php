<?php
// Clever Cloud Database Configuration
define("DB_HOST", "butthclsnjn792i9rply-mysql.services.clever-cloud.com");
define("DB_USER", "ukunrxjnyxe60zak");
define("DB_PASS", "SSkFXO5UHJxNehbxOkfg");
define("DB_NAME", "butthclsnjn792i9rply");
define("DB_PORT", 3306);

// Create connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

// Check connection
if (!$conn) {
    die("❌ Connection failed: " . mysqli_connect_error());
} else {
    echo "✅ Connected successfully to Clever Cloud Database!";
}
?>
