<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: admin_login.html");
    exit();
}

$page = $_GET['page'] ?? 'dashboard';
?>


<?php

// Logout
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: admin_login.html");
    exit();
}

// Protect page
if (!isset($_SESSION['username'])) {
    header("Location: admin_login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard | Cit-E Cycling</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

<style>
body{
    background:#f4f7fa;
}

.sidebar{
    position:fixed;
    top:0;
    left:0;
    width:280px;
    height:100vh;
    background:#111827;
    color:white;
    padding:30px 20px;
}

.logo{
    font-size:1.8rem;
    font-weight:bold;
    margin-bottom:40px;
}

.sidebar .nav-link{
    color:#d1d5db;
    padding:15px;
    border-radius:15px;
    margin-bottom:10px;
    transition:.3s;
}

.sidebar .nav-link:hover,
.sidebar .nav-link.active{
    background:#0d6efd;
    color:white;
}

.main-content{
    margin-left:280px;
    padding:40px;
}

.card{
    border:none;
    border-radius:20px;
    box-shadow:0 .5rem 1rem rgba(0,0,0,.1);
}

.stat-card{
    color:white;
}

.logout-btn{
    position:absolute;
    bottom:30px;
    width:85%;
}
</style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">

    <div class="logo">
        <i class="bi bi-bicycle"></i>
        Cit-E Cycling
    </div>

    <ul class="nav flex-column">

        <li class="nav-item">
            <a class="nav-link <?=($page=='dashboard')?'active':''?>"
               href="admin_menu.php?page=dashboard">
                <i class="bi bi-speedometer2 me-2"></i>
                Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?=($page=='search')?'active':''?>"
               href="admin_menu.php?page=search">
                <i class="bi bi-search me-2"></i>
                Search Participants
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?=($page=='manage')?'active':''?>"
               href="admin_menu.php?page=manage">
                <i class="bi bi-people-fill me-2"></i>
                Manage Participants
            </a>
        </li>

    </ul>
<a href="?logout=1" class="btn btn-danger logout-btn">
    <i class="bi bi-box-arrow-right"></i>
    Logout
</a>

</div>

<!-- Main Content -->
<div class="main-content">

<?php

switch($page){

    case 'search':
        include 'search_form.php';
        break;

    case 'manage':
        include 'view_participants_edit_delete.php';
        break;

    default:
?>

<h1 class="mb-4">
    Welcome, <?php echo $_SESSION['username']; ?>
</h1>

<div class="row g-4">

    <div class="col-md-4">
        <div class="card stat-card bg-primary p-4">
            <h5><i class="bi bi-search"></i> Search</h5>
            <p>Search clubs and participants.</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card stat-card bg-success p-4">
            <h5><i class="bi bi-people-fill"></i> Participants</h5>
            <p>Edit or delete participant records.</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card stat-card bg-dark p-4">
            <h5><i class="bi bi-person-circle"></i> Admin</h5>
            <p><?php echo $_SESSION['username']; ?></p>
        </div>
    </div>

</div>

<div class="card mt-5 p-5">
    <h3>Admin Dashboard</h3>
    <p class="text-muted">
        Manage participants and search records through the Cit-E Cycling administration portal.
    </p>
</div>

<?php
}
?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>