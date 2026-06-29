<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Status</title>
    <style>
        :root {
            --bg-color: #f3f4f6;
            --card-bg: #ffffff;
            --text-main: #1f2937;
            --text-muted: #4b5563;
            --error-color: #ef4444;
            --success-color: #10b981;
            --primary-color: #3b82f6;
            --primary-hover: #2563eb;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .card {
            background: var(--card-bg);
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            width: 100%;
            max-width: 400px;
            text-align: center;
            box-sizing: border-box;
        }

        .icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .error-icon { color: var(--error-color); }
        .success-icon { color: var(--success-color); }

        h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-top: 0;
            margin-bottom: 0.5rem;
        }

        p {
            color: var(--text-muted);
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }

        .btn {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            transition: background-color 0.2s ease;
            width: 100%;
            box-sizing: border-box;
        }

        .btn:hover {
            background-color: var(--primary-hover);
        }

        /* Spinner for redirecting state */
        .spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border-left-color: var(--primary-color);
            animation: spin 1s linear infinite;
            margin: 0 auto 1rem auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>

<div class="card">
<?php
include 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    try {

        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $user = $_POST['username'];
        $pass = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->bindParam(':username', $user);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {

            if ($pass == $result['password']) {

                $_SESSION['username'] = $result['username'];

                echo '<div class="spinner"></div>';
                echo "<h2>Authenticated successfully.</h2>";
                echo "<p>Redirecting to dashboard...</p>";

                header("Location: admin_menu.php");
                exit();

            } else {

                echo '<div class="icon error-icon">✕</div>';
                echo "<h2>Incorrect password.</h2>";
                echo "<p>Please verify your credentials and try again.</p>";
                echo '<a href="admin_login.html" class="btn">Back to Login</a>';

            }

        } else {

            echo '<div class="icon error-icon">✕</div>';
            echo "<h2>Username not found.</h2>";
            echo "<p>The account username entered does not exist.</p>";
            echo '<a href="admin_login.html" class="btn">Back to Login</a>';

        }

    } catch (PDOException $e) {

        echo '<div class="icon error-icon">⚠️</div>';
        echo "<h2>Database Error</h2>";
        echo "<p>Connection failed: " . htmlspecialchars($e->getMessage()) . "</p>";
        echo '<a href="admin_login.html" class="btn">Back to Login</a>';

    }

} else {

    echo '<div class="icon error-icon">🛑</div>';
    echo "<h2>Access Denied</h2>";
    echo "<p>You arrived here by mistake.</p>";
    echo '<a href="admin_login.html" class="btn">Go to Login</a>';

}
?>
</div>

</body>
</html>