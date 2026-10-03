  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electric Company - Customer Accounts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0000FF;
            --secondary-color: #ed9a24;
            --accent-color: #0000FF;
            --dark-color: #334cda;
            --surface-color: #ffffff;
            --page-color: #2b3449;
            --muted-color: #606f9b;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(18px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.04); }
        }

        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-18px); }
            to { opacity: 1; transform: translateX(0); }
        }

        body {
            background: var(--page-color);
            color: var(--dark-color);
            min-height: 100vh;
            padding: 24px 0;
        }

        .main-container {
            background: var(--surface-color);
            border: 1px solid #e2ebe7;
            border-radius: 8px;
            box-shadow: 0 14px 40px rgba(24, 59, 54, 0.08);
            padding: clamp(20px, 3vw, 36px);
            margin: 12px auto;
            animation: fadeInUp 0.55s ease both;
        }

        .header-section {
            text-align: center;
            margin-bottom: 28px;
            padding-bottom: 22px;
            border-bottom: 1px solid #e8efec;
            animation: slideInLeft 0.55s ease both;
        }

        .header-section h1 {
            color: var(--primary-color);
            font-size: clamp(1.65rem, 4vw, 2.25rem);
            font-weight: 750;
            letter-spacing: 0;
            margin-bottom: 6px;
        }

        .header-section h1 .text-warning { color: var(--secondary-color) !important; }
        .header-section p { margin: 0; color: var(--muted-color) !important; }

        .stats-card {
            position: relative;
            overflow: hidden;
            min-height: 122px;
            border: 1px solid #e5ece9;
            border-left: 4px solid var(--primary-color);
            border-radius: 6px;
            padding: 19px 20px;
            margin-bottom: 20px;
            color: var(--dark-color);
            background: #fbfdfc;
            transition: transform 0.22s ease, box-shadow 0.22s ease;
        }

        .stats-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 24px rgba(24, 59, 54, 0.1);
        }

        .stats-card h3 {
            color: var(--primary-color);
            font-size: 2rem;
            font-weight: 750;
            margin: 0;
        }

        .stats-card p {
            margin: 6px 0 0;
            color: var(--muted-color);
            font-size: 0.9rem;
        }

        .card-total { border-left-color: var(--primary-color); }
        .card-active { border-left-color: #198754; background: #edf7f1; }
        .card-active h3 { color: #198754; }
        .card-inactive { border-left-color: #dc3545; background: #fbefef; }
        .card-inactive h3 { color: #dc3545; }
        .card-suspended { border-left-color: #ffc107; background: #fff8df; }
        .card-suspended h3 { color: #856404; }

        .search-filter-section {
            background: #f6f9f7;
            border: 1px solid #e5ece9;
            border-radius: 6px;
            padding: 20px;
            margin-bottom: 22px;
        }

        .search-filter-section h4 { color: var(--dark-color); font-weight: 700; }
        .form-control, .form-select { border-color: #d5e0db; min-height: 42px; }
        .form-control:focus, .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(237, 154, 36, 0.2);
        }
        .btn { transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease; }
        .btn-primary, .btn-success {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .btn-primary:hover, .btn-success:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            animation: pulse 0.45s ease-in-out;
        }
        .btn-outline-primary:hover, .btn-outline-light:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(24, 59, 54, 0.16);
        }
        .btn:focus-visible, .form-control:focus-visible, .form-select:focus-visible {
            outline: 2px solid var(--secondary-color);
            outline-offset: 2px;
        }

        .table-container {
            overflow-x: auto;
            border: 1px solid #e5ece9;
            border-radius: 6px;
        }
        .table { min-width: 760px; margin-bottom: 0; }
        .table thead th {
            background: var(--dark-color);
            border: 0;
            color: #fff;
            font-size: 0.78rem;
            font-weight: 650;
            letter-spacing: 0.04em;
            padding: 13px 14px;
            text-transform: uppercase;
            white-space: nowrap;
        }
        .table tbody td { border-color: #edf1ef; padding: 13px 14px; }
        .table tbody tr { transition: background-color 0.18s ease; }
        .table tbody tr:hover { background-color: #f4f9f6; }
        .badge-active { background-color: #238b61; }
        .badge-inactive { background-color: #c4544e; }
        .badge-suspended { background-color: #f2bd4b; color: #3e3219; }
        .pagination { gap: 6px; margin-top: 20px; }
        .pagination a {
            display: inline-flex;
            min-width: 38px;
            min-height: 38px;
            align-items: center;
            justify-content: center;
            padding: 6px 11px;
            border: 1px solid #d8dfeb;
            border-radius: 5px;
            background: #fff;
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.18s ease, background-color 0.18s ease, border-color 0.18s ease, transform 0.18s ease;
        }
        .pagination a:hover {
            border-color: var(--primary-color);
            background: #eef1ff;
            transform: translateY(-1px);
        }
        .pagination li.active a {
            border-color: var(--primary-color);
            background: var(--primary-color);
            color: #fff;
            cursor: default;
        }
        .pagination a:focus-visible {
            outline: 2px solid var(--secondary-color);
            outline-offset: 2px;
        }
        .alert { border: 0; border-radius: 6px; box-shadow: 0 4px 14px rgba(24, 59, 54, 0.08); }
        .alert-success { background: #e5f4eb; color: #17603d; }
        .alert-danger { background: #fae9e7; color: #922f2b; }

        @media (max-width: 768px) {
            body { padding: 10px 0; }
            .main-container { padding: 18px; margin: 8px auto; }
            .header-section { margin-bottom: 20px; }
            .stats-card { min-height: 108px; padding: 16px; }
            .search-filter-section { padding: 16px; }
        }

        @media (prefers-contrast: high) {
            :root { --primary-color: #005344; --secondary-color: #9a4d00; --dark-color: #102a25; }
            .stats-card, .table-container, .search-filter-section { border-color: currentColor; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                scroll-behavior: auto !important;
                transition-duration: 0.01ms !important;
            }
        }

        @media print {
            body { background: #fff; padding: 0; }
            .main-container { border: 0; box-shadow: none; padding: 0; }
            .search-filter-section, .btn, .pagination { display: none !important; }
            .stats-card { background: #fff; box-shadow: none; }
            .table-container { overflow: visible; }
            .table { min-width: 0; }
        }
    </style>
</head>
  
<body>
    <div class="container">
        <div class="main-container">
            <!-- Header -->
            <div class="header-section">
                <h1><i class="bi bi-lightning-charge-fill text-warning"></i> Puihaha Electric Company</h1>
                <p class="text-muted">Customer Account Management System</p>
                <p class="text-muted mb-0">Logged in as <strong><?= esc($username) ?></strong></p>
            </div>

              <!-- this is for logout demonstration -->
    
            <form action="<?= base_url('logout') ?>" method="post">
                <?= csrf_field() ?>
                <button type="submit" class="btn btn-primary">Logout</button>
            </form>


            <div class="alert alert-success mb-0">
                You are signed in successfully. Add your customer-account model and query here when you are ready to display customer records.
            </div>

            
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
