<?php
if (isset($_GET['file'])) {
    $file = $_GET['file'];
    include($file);
} else {
    echo "<h1>Stage 1: Web Security</h1><p>Welcome! Try to find the flag file.</p>";
}
?>