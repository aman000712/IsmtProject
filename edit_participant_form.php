<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Participant Scores</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #eef2ff, #f8fafc);
            min-height: 100vh;
        }

        .card {
            border: none;
            border-radius: 25px;
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(45deg, #0d6efd, #4f8cff);
            color: white;
        }

        .form-control {
            border-radius: 15px;
            padding: 12px;
        }

        .btn {
            border-radius: 50px;
        }
    </style>

</head>

<body>

    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-md-7">

                <div class="card shadow-lg">

                    <div class="card-header p-4">
                        <h3 class="mb-0">
                            <i class="bi bi-pencil-square"></i>
                            Update Participant Scores
                        </h3>
                    </div>

                    <div class="card-body p-4">

                        <a href="view_participants_edit_delete.php" class="btn btn-secondary mb-4">
                            <i class="bi bi-arrow-left"></i>
                            Back
                        </a>

                        <form action="edit_participant.php" method="POST">

                            <div class="mb-3">
                                <label class="form-label fw-bold">
                                    <i class="bi bi-person-fill"></i>
                                    Participant Firstname
                                </label>

                                <input
                                    type="text"
                                    name="firstname"
                                    class="form-control bg-light"
                                    value="<?php echo isset($firstname) ? $firstname : ''; ?>"
                                    disabled>

                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">
                                    <i class="bi bi-person-badge-fill"></i>
                                    Participant Surname
                                </label>

                                <input
                                    type="text"
                                    name="surname"
                                    class="form-control bg-light"
                                    value="<?php echo isset($surname) ? $surname : ''; ?>"
                                    disabled>

                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">
                                    <i class="bi bi-lightning-charge-fill text-warning"></i>
                                    Power Output (Watts)
                                </label>

                                <input
                                    type="number"
                                    name="power_output"
                                    class="form-control"
                                    value="<?php echo isset($power_output) ? $power_output : ''; ?>"
                                    required>

                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">
                                    <i class="bi bi-signpost-2-fill text-success"></i>
                                    Distance Travelled (KM)
                                </label>

                                <input
                                    type="number"
                                    step="0.01"
                                    name="distance"
                                    class="form-control"
                                    value="<?php echo isset($distance) ? $distance : ''; ?>"
                                    required>

                            </div>

                            <input
                                type="hidden"
                                name="id"
                                value="<?php echo isset($id) ? $id : ''; ?>">

                            <div class="d-flex gap-2">

                                <button type="submit" class="btn btn-primary flex-fill">
                                    <i class="bi bi-check-circle-fill"></i>
                                    Update Rider
                                </button>

                                <a href="view_participants.php" class="btn btn-outline-secondary flex-fill">
                                    <i class="bi bi-x-circle"></i>
                                    Cancel
                                </a>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>