<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delete participant</title>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .loader {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
            margin: 50px auto;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .message {
            text-align: center;
            font-size: 20px;
            color: green;
        }
    </style>
</head>

<body>
    <?php

    include 'dbconnect.php';

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password); //building a new connection object
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //TODO DELETE - complete the functionality
        if (isset($_GET['id'])) {

            $id = $_GET['id'];

            $stmt = $conn->prepare("DELETE FROM participant WHERE id = :id");

            $stmt->bindParam(':id', $id);

            $stmt->execute();

            echo '


<script>

Swal.fire({
    icon: "success",
    title: "Deleted!",
    text: "Participant deleted successfully.",
    timer: 2000,
    showConfirmButton: false
}).then(() => {

    window.location = "view_participants_edit_delete.php";

});

</script>

';
            // header("refresh:2;url=view_participants_edit_delete.php");


        } else {

            echo "No participant ID specified.";
        }
    } catch (PDOException $e) {
        // put the error stuff here
        echo "Error: " . $e->getMessage();
    }



    ?>
    <!-- <script>
        setTimeout(function() {
            window.location.href = "view_participants_edit_delete.php";
        }, 2000);
    </script> -->

</body>

</html>