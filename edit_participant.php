<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Participant Score</title>
    
    <!-- Bootstrap & Icons for clean feedback UI states -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-gradient: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            --accent-blue: #3b82f6;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-gradient);
            min-height: 100vh;
            color: #0f172a;
        }

        .card-status {
            border: 1px solid #e2e8f0;
            border-radius: 24px;
            background: #ffffff;
            box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.04);
            max-width: 500px;
            width: 100%;
        }

        .icon-circle {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
        }
    </style>
</head>

<body>

    <?php
    //including connection variables   
    include 'dbconnect.php';

    try {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') //has the user submitted the form and edited the participant
        {
            //TODO - UPDATE section

            $conn = new PDO("mysql:host=$servername;port=$port;dbname=$database", $username, $password); //building a new connection object
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $id = $_POST['id'];
            $power_output = $_POST['power_output'];
            $distance = $_POST['distance'];

            $sql = "UPDATE participant
                SET power_output = :power_output,
                    distance = :distance
                WHERE id = :id";

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':power_output', $power_output);
            $stmt->bindParam(':distance', $distance);
            $stmt->bindParam(':id', $id);

            $stmt->execute();

            // Modern Styled Success Feedback UI Container
            echo '<div class="container d-flex justify-content-center align-items-center min-vh-100">';
            echo '  <div class="card-status p-5 text-center">';
            echo '      <div class="icon-circle bg-success-subtle text-success"><i class="bi bi-check-circle-fill"></i></div>';
            echo '      <h3 class="fw-bold mb-2">Rider Updated!</h3>';
            echo '      <p class="text-muted small mb-4">The scores and performance details have been securely modified.</p>';
            echo '      <a href="admin_menu.php?page=manage" class="btn btn-primary rounded-pill px-4 py-2 w-100">View Participants</a>';
            echo '  </div>';
            echo '</div>';

        } else {
            //TODO - SELECT section

            $conn = new PDO("mysql:host=$servername;port=$port;dbname=$database", $username, $password); //building a new connection object
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $id = $_GET['id'];

            $sql = "SELECT * FROM participant WHERE id = :id";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();


            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $firstname = $row['firstname'];
                $surname = $row['surname'];
                $power_output = $row['power_output'];
                $distance = $row['distance'];
                $id = $row['id'];

                include "edit_participant_form.php";
            } else {
                // Modern Styled Missing Data Feedback UI Container
                echo '<div class="container d-flex justify-content-center align-items-center min-vh-100">';
                echo '  <div class="card-status p-5 text-center">';
                echo '      <div class="icon-circle bg-warning-subtle text-warning"><i class="bi bi-exclamation-triangle-fill"></i></div>';
                echo '      <h3 class="fw-bold mb-2">Rider Not Found</h3>';
                echo '      <p class="text-muted small mb-4">The participant ID specified does not exist in the active records database.</p>';
                echo '      <a href="javascript:history.back()" class="btn btn-outline-secondary rounded-pill px-4 py-2 w-100">Go Back</a>';
                echo '  </div>';
                echo '</div>';
            }
        }
    } catch (PDOException $e) {
        // Modern Styled Database Error UI Container
        echo '<div class="container d-flex justify-content-center align-items-center min-vh-100">';
        echo '  <div class="card-status p-5 text-center">';
        echo '      <div class="icon-circle bg-danger-subtle text-danger"><i class="bi bi-x-circle-fill"></i></div>';
        echo '      <h3 class="fw-bold mb-2">System Error</h3>';
        echo '      <p class="text-danger small mb-4">' . htmlspecialchars($e->getMessage()) . '</p>';
        echo '      <a href="javascript:history.back()" class="btn btn-outline-secondary rounded-pill px-4 py-2 w-100">Go Back</a>';
        echo '  </div>';
        echo '</div>';
    }

    /**
     * For the brave souls who get this far: You are the chosen ones,
     * the valiant knights of programming who toil away, without rest,
     * fixing our most awful code. To you, true saviors, kings of men,
     * I say this: never gonna give you up, never gonna let you down,
     * never gonna run around and desert you. Never gonna make you cry,
     * never gonna say goodbye. Never gonna tell a lie and hurt you.
     */
    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>