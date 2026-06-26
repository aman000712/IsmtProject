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

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

<!-- Google Fonts for Modern Typography -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --sidebar-bg: #0f172a;
        --body-bg: #f8fafc;
        --accent-blue: #3b82f6;
        --accent-green: #10b981;
        --accent-dark: #334155;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    body{
        background: var(--body-bg);
        color: #0f172a;
    }

    /* Fixed Modern Sidebar */
    .sidebar{
        position: fixed;
        top: 0;
        left: 0;
        width: 280px;
        height: 100vh;
        background: var(--sidebar-bg);
        color: white;
        padding: 35px 24px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        border-right: 1px solid rgba(255, 255, 255, 0.05);
        z-index: 100;
    }

    .logo{
        font-size: 1.5rem;
        font-weight: 800;
        letter-spacing: -0.5px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .logo i {
        color: var(--accent-blue);
    }

    .sidebar .nav-link{
        color: #94a3b8;
        padding: 14px 18px;
        border-radius: 14px;
        font-weight: 500;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
    }

    .sidebar .nav-link i {
        font-size: 1.2rem;
    }

    .sidebar .nav-link:hover {
        color: #ffffff;
        background: rgba(255, 255, 255, 0.05);
    }

    .sidebar .nav-link.active{
        background: var(--accent-blue);
        color: white;
        box-shadow: 0 10px 20px -5px rgba(59, 130, 246, 0.35);
    }

    /* Responsive Spacing Container */
    .main-content{
        margin-left: 280px;
        padding: 50px;
    }

    /* Typography Upgrades */
    h1 {
        font-weight: 800;
        letter-spacing: -1.5px;
        color: #0f172a;
    }

    h3 {
        font-weight: 700;
        letter-spacing: -0.5px;
    }

    /* Unified Dashboard Cards */
    .card{
        border: 1px solid #e2e8f0;
        border-radius: 24px;
        background: #ffffff;
        box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.04);
    }

    /* Stat Cards Accent Variations */
    .stat-card{
        border: none;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .stat-card h5 {
        font-weight: 700;
        font-size: 1.15rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .stat-card p {
        margin-bottom: 0;
        font-size: 0.9rem;
        opacity: 0.85;
    }

    .bg-card-blue {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.3);
    }

    .bg-card-green {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.3);
    }

    .bg-card-dark {
        background: linear-gradient(135deg, #334155 0%, #1e293b 100%);
        box-shadow: 0 10px 25px -5px rgba(51, 65, 85, 0.3);
    }

    /* Seamless Logout Actions */
    .logout-btn{
        width: 100%;
        padding: 14px;
        border-radius: 14px;
        font-weight: 600;
        font-size: 0.95rem;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.2s ease;
    }

    @media (max-width: 992px) {
        .sidebar {
            width: 70px;
            padding: 30px 12px;
            align-items: center;
        }
        .logo span, .nav-link span, .logout-btn span {
            display: none;
        }
        .sidebar .nav-link {
            padding: 14px;
            justify-content: center;
        }
        .main-content {
            margin-left: 70px;
            padding: 30px;
        }
    }
</style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div>
        <div class="logo mb-5">
            <i class="bi bi-bicycle"></i>
            <span>Cit-E Cycling</span>
        </div>

        <ul class="nav flex-column gap-2">
            <li class="nav-item">
                <a class="nav-link <?=($page=='dashboard')?'active':''?>" href="admin_menu.php?page=dashboard">
                    <i class="bi bi-speedometer2 me-lg-3"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?=($page=='search')?'active':''?>" href="admin_menu.php?page=search">
                    <i class="bi bi-search me-lg-3"></i>
                    <span>Search Participants</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?=($page=='manage')?'active':''?>" href="admin_menu.php?page=manage">
                    <i class="bi bi-people-fill me-lg-3"></i>
                    <span>Manage Participants</span>
                </a>
            </li>
        </ul>
    </div>

    <a href="?logout=1" class="btn btn-danger logout-btn">
        <i class="bi bi-box-arrow-right"></i>
        <span>Logout</span>
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

<div class="d-flex align-items-center justify-content-between mb-4 pb-2">
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card stat-card bg-card-blue p-4">
            <h5><i class="bi bi-search"></i> Search</h5>
            <p>Search clubs and participants dynamically.</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card stat-card bg-card-green p-4">
            <h5><i class="bi bi-people-fill"></i> Participants</h5>
            <p>Edit or delete system participant records.</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card stat-card bg-card-dark p-4">
            <h5><i class="bi bi-person-circle"></i> Admin Profile</h5>
            <p>Active User: <?php echo htmlspecialchars($_SESSION['username']); ?></p>
        </div>
    </div>
</div>

<div class="card mt-5 p-5 border-0 shadow-sm">
    <h3 class="mb-2">Admin Dashboard</h3>
    <p class="text-muted mb-0">
        Manage participants and filter historical database logs securely through the Cit-E Cycling administration system portal.
    </p>
</div>

<?php
}
?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>