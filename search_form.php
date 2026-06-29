<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search Participants or Clubs | Cit-E Cycling</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-gradient: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            --accent-blue: #3b82f6;
            --accent-green: #10b981;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-gradient);
            min-height: 100vh;
            color: #0f172a;
        }

        .search-container {
            max-width: 100%;
        }

        /* Card Upgrades */
        .card {
            border: 1px solid #e2e8f0;
            border-radius: 24px;
            background: #ffffff;
            box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.04);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px -15px rgba(15, 23, 42, 0.08);
        }

        .nav-pills .nav-link {
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 600;
            color: #64748b;
            transition: all 0.2s ease;
        }
        
        .nav-pills .nav-link#participant-tab.active {
            background-color: var(--accent-blue);
            color: white;
        }

        .nav-pills .nav-link#club-tab.active {
            background-color: var(--accent-green);
            color: white;
        }

        .custom-input-group {
            border-radius: 14px;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .custom-input-group:focus-within {
            border-color: var(--accent-blue) !important;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12) !important;
            background-color: #ffffff !important;
        }

        .custom-input-group.green-focus:focus-within {
            border-color: var(--accent-green) !important;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.12) !important;
        }

        .custom-input-group input:focus {
            box-shadow: none;
            background: transparent;
        }

        .btn-action-blue {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            border: none;
            box-shadow: 0 10px 20px -5px rgba(37, 99, 235, 0.25);
        }

        .btn-action-green {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border: none;
            box-shadow: 0 10px 20px -5px rgba(16, 185, 129, 0.25);
        }

        .btn-action:hover {
            filter: brightness(1.05);
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

<div class="container-fluid search-container px-4 px-md-5 py-5">
    
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-5">
        <div>
            <span class="text-primary fw-bold text-uppercase tracking-wider small d-block mb-1">Cit-E Cycling Registry</span>
            <h1 class="fw-800 display-5 mb-0" style="letter-spacing: -1.5px; font-weight: 800;">Find Records</h1>
        </div>
        <a href="." class="btn btn-white border px-4 py-2 rounded-pill d-inline-flex align-items-center gap-2 bg-white fw-medium text-secondary shadow-sm">
            <i class="bi bi-arrow-left-short fs-5"></i>
            Back to Index
        </a>
    </div>

    <ul class="nav nav-pills gap-2 mb-4" id="searchTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="participant-tab" data-bs-toggle="pill" data-bs-target="#participant-pane" type="button" role="tab" aria-controls="participant-pane" aria-selected="true">
                <i class="bi bi-person-bounding-box me-2"></i>Search Participant
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="club-tab" data-bs-toggle="pill" data-bs-target="#club-pane" type="button" role="tab" aria-controls="club-pane" aria-selected="false">
                <i class="bi bi-shield-shaded me-2"></i>Search Club / Team
            </button>
        </li>
    </ul>

    <div class="card p-4 p-xl-5">
        <div class="tab-content" id="searchTabsContent">
            
            <div class="tab-pane fade show active" id="participant-pane" role="tabpanel" aria-labelledby="participant-tab" tabindex="0">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div style="width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; background: rgba(59, 130, 246, 0.1); color: #3b82f6; font-size: 1.6rem;">
                        <i class="bi bi-person-bounding-box"></i>
                    </div>
                    <div>
                        <h3 class="h4 mb-0 fw-bold" style="letter-spacing: -0.5px;">Search Participant</h3>
                        <p class="text-muted small mb-0">Search registered rider profile names</p>
                    </div>
                </div>

                <form action="search_result.php" method="POST">
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-secondary small mb-2">Participant First Name or Surname</label>
                        <div class="input-group custom-input-group">
                            <span class="input-group-text bg-transparent border-0 ps-3 pe-2 text-muted"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control bg-transparent border-0 py-3 ps-1" name="firstname" placeholder="e.g., Jane or Cooper" required>
                        </div>
                        <input type="hidden" name="participant" value="1">
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-action btn-action-blue w-100 py-3 rounded-xl rounded-4 fw-semibold d-inline-flex align-items-center justify-content-center gap-2">
                        <span>Execute Search</span>
                        <i class="bi bi-chevron-right small"></i>
                    </button>
                </form>
            </div>

            <div class="tab-pane fade" id="club-pane" role="tabpanel" aria-labelledby="club-tab" tabindex="0">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div style="width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; background: rgba(16, 185, 129, 0.1); color: #10b981; font-size: 1.6rem;">
                        <i class="bi bi-shield-shaded"></i>
                    </div>
                    <div>
                        <h3 class="h4 mb-0 fw-bold" style="letter-spacing: -0.5px;">Search Club / Team</h3>
                        <p class="text-muted small mb-0">Lookup registered clubs and racing groups</p>
                    </div>
                </div>

                <form action="search_result.php" method="POST">
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-secondary small mb-2">Registered Club Name</label>
                        <div class="input-group custom-input-group green-focus">
                            <span class="input-group-text bg-transparent border-0 ps-3 pe-2 text-muted"><i class="bi bi-building"></i></span>
                            <input type="text" class="form-control bg-transparent border-0 py-3 ps-1" name="club" placeholder="e.g., Summit Racing" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-action btn-action-green w-100 py-3 rounded-xl rounded-4 fw-semibold d-inline-flex align-items-center justify-content-center gap-2">
                        <span>Query Club Database</span>
                        <i class="bi bi-chevron-right small"></i>
                    </button>
                </form>
            </div>
            
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>