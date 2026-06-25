<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update participants score</title>
</head>

<body>
    <!-- <a href=".">Back to index</a> -->
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

            echo "<h3>Participant updated successfully!</h3>";
            echo "<a href='view_participants_edit_delete.php'>View Participants</a>";
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
                echo "Participant not found.";
            }
        }
    } catch (PDOException $e) {
        //error stuff here
        echo "Error: " . $e->getMessage();
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


</body>

</html>