<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $mode === 'edit' ? 'Edit Account' : 'Create Account' ?> - Puihaha Electric Company</title>
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
            max-width: 900px;
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

        .form-card {
            background: #f6f9f7;
            border: 1px solid #e5ece9;
            border-radius: 6px;
            padding: clamp(18px, 3vw, 25px);
        }

        .form-label { color: #26334c; font-weight: 600; }
        .form-control, .form-select {
            min-height: 42px;
            border-color: #d5e0db;
            border-radius: 5px;
        }
        textarea.form-control { min-height: auto; }
        .form-control:focus, .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(237, 154, 36, 0.2);
        }
        .btn {
            transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
        }
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .btn-primary:hover {
            background-color: #0000cc;
            border-color: #0000cc;
            animation: pulse 0.45s ease-in-out;
        }
        .btn-secondary {
            background-color: #596579;
            border-color: #596579;
        }
        .btn-outline-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(24, 59, 54, 0.16);
        }
        .btn:focus-visible, .form-control:focus-visible, .form-select:focus-visible {
            outline: 2px solid var(--secondary-color);
            outline-offset: 2px;
        }
        .alert {
            border: 0;
            border-radius: 6px;
            background: #fae9e7;
            color: #922f2b;
            box-shadow: 0 4px 14px rgba(24, 59, 54, 0.08);
        }

        @media (max-width: 768px) {
            body { padding: 10px 0; }
            .main-container { padding: 18px; margin: 8px auto; }
            .header-section { margin-bottom: 20px; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                scroll-behavior: auto !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="main-container">
            <div class="header-section">
                <h1><i class="bi bi-lightning-charge-fill text-warning"></i> Puihaha Electric Company</h1>
                <p class="text-muted"><?= $mode === 'edit' ? 'Update Customer Account' : 'Create New Customer Account' ?></p>
            </div>

            <div class="mb-4 d-flex justify-content-between align-items-center">
                <a href="<?= base_url() ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Dashboard
                </a>
            </div>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="form-card">
                <form action="<?= $mode === 'edit' ? base_url('accounts/update/' . ($account['id'] ?? '')) : base_url('accounts/store') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Account Number</label>
                            <input type="text" name="account_number" class="form-control" value="<?= esc($account['account_number'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Customer Name</label>
                            <input type="text" name="customer_name" class="form-control" value="<?= esc($account['customer_name'] ?? '') ?>" required>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control" rows="3" required><?= esc($account['address'] ?? '') ?></textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="tel" name="phone" class="form-control" value="<?= esc($account['phone'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= esc($account['email'] ?? '') ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Meter Number</label>
                            <input type="text" name="meter_number" class="form-control" value="<?= esc($account['meter_number'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Connection Type</label>
                            <select name="connection_type" class="form-select" required>
                                <option value="">Select type</option>
                                <option value="residential" <?= (($account['connection_type'] ?? '') === 'residential') ? 'selected' : '' ?>>Residential</option>
                                <option value="commercial" <?= (($account['connection_type'] ?? '') === 'commercial') ? 'selected' : '' ?>>Commercial</option>
                                <option value="industrial" <?= (($account['connection_type'] ?? '') === 'industrial') ? 'selected' : '' ?>>Industrial</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="">Select status</option>
                                <option value="active" <?= (($account['status'] ?? '') === 'active') ? 'selected' : '' ?>>Active</option>
                                <option value="inactive" <?= (($account['status'] ?? '') === 'inactive') ? 'selected' : '' ?>>Inactive</option>
                                <option value="suspended" <?= (($account['status'] ?? '') === 'suspended') ? 'selected' : '' ?>>Suspended</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-end gap-2">
                        <a href="<?= base_url() ?>" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> <?= $mode === 'edit' ? 'Update Account' : 'Save Account' ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
