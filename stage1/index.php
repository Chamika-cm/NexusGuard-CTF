<?php
if (isset($_GET['file'])) {
    $file = $_GET['file'];
    include($file);
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NexusGuard Financial Services - Online Portal</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #0d1117; color: #c9d1d9; min-height: 100vh; display: flex; flex-direction: column; }
        header { background: linear-gradient(135deg, #0d253f, #1b4965); color: #fff; padding: 1.5rem 2rem; display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #00b4d8; }
        .logo { font-size: 1.5rem; font-weight: bold; letter-spacing: 1px; color: #90e0ef; }
        .container { max-width: 900px; margin: 40px auto; padding: 2rem; background: #161b22; border-radius: 12px; border: 1px solid #30363d; box-shadow: 0 8px 24px rgba(0,0,0,0.5); }
        h1 { color: #58a6ff; font-size: 1.8rem; margin-bottom: 1rem; }
        p { color: #8b949e; margin-bottom: 1.5rem; line-height: 1.6; }
        .alert-box { background: #1f2937; border-left: 4px solid #00b4d8; padding: 1rem; border-radius: 4px; margin-bottom: 2rem; }
        .menu-title { font-weight: bold; color: #f0f6fc; margin-bottom: 0.5rem; }
        .nav-links { display: flex; gap: 12px; margin-top: 1rem; }
        .nav-links a { text-decoration: none; color: #58a6ff; background: #21262d; padding: 8px 16px; border-radius: 6px; border: 1px solid #30363d; transition: 0.3s; }
        .nav-links a:hover { background: #30363d; color: #79c0ff; }
        footer { margin-top: auto; text-align: center; padding: 1.5rem; background: #161b22; color: #8b949e; font-size: 0.85rem; border-top: 1px solid #30363d; }
    </style>
</head>
<body>
    <header>
        <div class="logo">🏛️ NexusGuard Financial Services</div>
        <div style="font-size: 0.9rem; color: #90e0ef;">Secure Banking Portal</div>
    </header>

    <div class="container">
        <h1>Welcome to Internal Document Portal</h1>
        <p>Manage your enterprise accounts, transactions, and internal financial records securely.</p>
        
        <div class="alert-box">
            <div class="menu-title">📢 System Notification</div>
            <p style="margin:0; font-size: 0.9rem;">To view public policies or help docs, load document files via the document viewer system.</p>
        </div>

        <div class="menu-title">Quick Actions:</div>
        <div class="nav-links">
            <a href="index.php?file=welcome.txt">View Notice</a>
            <a href="index.php?file=help.txt">Help Desk</a>
        </div>
    </div>

    <footer>
        &copy; 2026 NexusGuard Financial Services. All rights reserved. Strictly for authorized personnel.
    </footer>
</body>
</html>
<?php
}
?>