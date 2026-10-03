<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Details - Puihaha Electric Company</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0000FF;
            --secondary-color: #ed9a24;
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
            max-width: 800px;
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
            margin-bottom: 24px;
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

        .header-section p { margin: 0; color: var(--muted-color) !important; }
        .text-primary { color: var(--primary-color) !important; }

        .card {
            overflow: hidden;
            border: 1px solid #e5ece9;
            border-radius: 6px;
        }
        .card-header.bg-primary {
            background-color: var(--primary-color) !important;
            padding: 15px 18px;
        }
        .card-body { padding: clamp(16px, 3vw, 24px); }

        .info-group {
            height: calc(100% - 20px);
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #e5ece9;
            border-radius: 6px;
            background: #f6f9f7;
        }

        .info-label {
            color: var(--muted-color);
            font-size: 0.82rem;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .info-value {
            font-size: 1.1rem;
            color: #26334c;
            overflow-wrap: anywhere;
        }
        .badge-active { background-color: #198754; }
        .badge-inactive { background-color: #dc3545; }
        .badge-suspended { background-color: #ffc107; color: #493900; }
        .badge.bg-info { background-color: #e9ecff !important; color: var(--primary-color) !important; }

        .btn { transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease; }
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .btn-primary:hover {
            background-color: #0000cc;
            border-color: #0000cc;
            animation: pulse 0.45s ease-in-out;
        }
        .btn-secondary { background-color: #596579; border-color: #596579; }
        .btn:focus-visible {
            outline: 2px solid var(--secondary-color);
            outline-offset: 2px;
        }

        @media (max-width: 768px) {
            body { padding: 10px 0; }
            .main-container { padding: 18px; margin: 8px auto; }
            .header-section { margin-bottom: 20px; }
            .info-group { height: auto; }
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
            .btn { display: none !important; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="main-container">
            <!-- Header -->
            <div class="header-section">
                <h1><i class="bi bi-lightning-charge-fill text-warning"></i> Puihaha Electric Company</h1>
                <p class="text-muted">Customer Account Details</p>
            </div>

            <!-- Back Button -->
            <div class="mb-4">
                <a href="<?= base_url() ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Dashboard
                </a>
            </div>

            <!-- Account Information -->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-person-circle"></i> Account Information</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-group">
                                <div class="info-label">Account Number</div>
                                <div class="info-value"><?= esc($account['account_number']) ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-group">
                                <div class="info-label">Status</div>
                                <div class="info-value">
                                    <?php
                                    $badgeClass = 'badge-' . $account['status'];
                                    ?>
                                    <span class="badge <?= $badgeClass ?> fs-6"><?= ucfirst(esc($account['status'])) ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="info-group">
                                <div class="info-label">Customer Name</div>
                                <div class="info-value"><?= esc($account['customer_name']) ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="info-group">
                                <div class="info-label">Address</div>
                                <div class="info-value"><?= esc($account['address']) ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-group">
                                <div class="info-label">Phone</div>
                                <div class="info-value">
                                    <i class="bi bi-telephone-fill text-primary"></i> <?= esc($account['phone']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-group">
                                <div class="info-label">Email</div>
                                <div class="info-value">
                                    <i class="bi bi-envelope-fill text-primary"></i> <?= esc($account['email']) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-group">
                                <div class="info-label">Meter Number</div>
                                <div class="info-value"><?= esc($account['meter_number']) ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-group">
                                <div class="info-label">Connection Type</div>
                                <div class="info-value">
                                    <span class="badge bg-info fs-6"><?= ucfirst(esc($account['connection_type'])) ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-group">
                                <div class="info-label">Created At</div>
                                <div class="info-value"><?= date('F j, Y g:i A', strtotime($account['created_at'])) ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-group">
                                <div class="info-label">Last Updated</div>
                                <div class="info-value"><?= date('F j, Y g:i A', strtotime($account['updated_at'])) ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-4 text-center">
                <a href="<?= base_url() ?>" class="btn btn-primary btn-lg">
                    <i class="bi bi-house-door-fill"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>