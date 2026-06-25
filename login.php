<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
</head>
<body>
<?php
include 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    try {

        // Create connection
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Get form data
        $user = $_POST['username'];
        $pass = $_POST['password'];

        // Find user
        $stmt = $conn->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->bindParam(':username', $user);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {

            // Check password
            if ($pass == $result['password']) {

                // Save username in session
                $_SESSION['username'] = $result['username'];

                // Redirect to admin menu
                header("Location: admin_menu.php");
                exit();

            } else {

                echo "<h2>Incorrect password.</h2>";
                echo '<a href="admin_login.html">Back to Login</a>';

            }

        } else {

            echo "<h2>Username not found.</h2>";
            echo '<a href="admin_login.html">Back to Login</a>';

        }

    } catch (PDOException $e) {

        echo "Connection failed: " . $e->getMessage();

    }

} else {

    echo "You're here by mistake.";

}
?>


</body>
</html>