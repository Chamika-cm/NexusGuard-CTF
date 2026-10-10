<?php
session_start();

// Stage 4: Authenticated Admin RCE
$flag = "NEXUS{r3m0t3_c0mm4nd_3x3cut10n_succ3ss}";

if (isset($_POST['login'])) {
    if ($_POST['username'] === 'admin_nexus' && $_POST['password'] === 'NexusAdmin#2026!Secured') {
        $_SESSION['admin'] = true;
    } else {
        $error = "Invalid admin credentials!";
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>NexusGuard Admin Portal - Stage 4</title></head>
<body style="font-family:Arial; background:#1a1a1a; color:#eee; text-align:center; padding-top:40px;">
    <h2>NexusGuard Admin Control Panel</h2>

    <?php if (!isset($_SESSION['admin'])): ?>
        <form method="POST" style="background:#2b2b2b; display:inline-block; padding:25px; border-radius:8px;">
            <h3>Admin Login</h3>
            <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
            <input type="text" name="username" placeholder="Username" required style="padding:8px; margin:5px;"><br>
            <input type="password" name="password" placeholder="Password" required style="padding:8px; margin:5px;"><br>
            <button type="submit" name="login" style="padding:8px 15px; margin-top:10px;">Login</button>
        </form>
    <?php else: ?>
        <div style="background:#2b2b2b; display:inline-block; padding:25px; border-radius:8px;">
            <h3>Command Execution Console</h3>
            <p style="color:#00ff00;">Authenticated as Admin</p>
            <form method="POST">
                <input type="text" name="cmd" placeholder="Enter system command (e.g. id, ls)" style="padding:8px; width:300px;">
                <button type="submit" style="padding:8px 15px;">Execute</button>
            </form>
            <br>
            <?php
            if (isset($_POST['cmd'])) {
                echo "<pre style='background:#000; color:#00ff00; text-align:left; padding:10px;'>";
                system($_POST['cmd']);
                echo "</pre>";
            }
            ?>
            <br><a href="?logout=1" style="color:#ff5555;">Logout</a>
        </div>
    <?php endif; ?>
</body>
</html>