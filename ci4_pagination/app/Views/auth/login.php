<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In | Puihaha Electric Company</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --blue: #334cda; --orange: #ed9a24; --ink: #263249; --muted: #65718a; }
        * { box-sizing: border-box; }
        body {
            display: grid;
            min-height: 100vh;
            margin: 0;
            padding: 24px;
            place-items: center;
            color: var(--ink);
            font-family: 'Montserrat', sans-serif;
            background-color: #293247;
            background-image: linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px);
            background-size: 40px 40px;
        }
        .login-panel {
            width: min(100%, 440px);
            padding: clamp(28px, 7vw, 52px);
            border-top: 5px solid var(--orange);
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 20px 60px rgba(0,0,0,.24);
            animation: arrive .45s ease-out both;
        }
        @keyframes arrive { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }
        .brand { margin: 0 0 8px; color: var(--orange); font-size: .78rem; font-weight: 700; text-transform: uppercase; }
        h1 { margin: 0; color: var(--blue); font-size: 2rem; }
        .intro { margin: 8px 0 28px; color: var(--muted); font-size: .92rem; }
        label { display: block; margin: 16px 0 7px; font-size: .84rem; font-weight: 600; }
        input { width: 100%; min-height: 46px; padding: 10px 12px; border: 1px solid #d7deea; border-radius: 5px; font: inherit; }
        input:focus { border-color: var(--blue); outline: 3px solid rgba(51,76,218,.14); }
        button { width: 100%; min-height: 46px; margin-top: 24px; border: 0; border-radius: 5px; color: #fff; background: var(--blue); font: 700 .9rem 'Montserrat', sans-serif; cursor: pointer; }
        button:hover { background: #253bb3; }
        .message { margin: 18px 0 0; padding: 12px; border-radius: 5px; background: #fae9e7; color: #922f2b; font-size: .86rem; }
        .message.success { background: #e5f4eb; color: #17603d; }
        @media (prefers-reduced-motion: reduce) { *, *::before, *::after { animation-duration: .01ms !important; } }
    </style>
</head>
<body>
    <main class="login-panel">
        <p class="brand">Puihaha Electric Company</p>
        <h1>Log In</h1>
        <p class="intro">Sign in to manage customer accounts.</p>

        <?php if (session()->getFlashdata('error')): ?>
            <p class="message" role="alert"><?= esc(session()->getFlashdata('error')) ?></p>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')): ?>
            <p class="message success" role="status"><?= esc(session()->getFlashdata('success')) ?></p>
        <?php endif; ?>

        <form action="<?= base_url('login') ?>" method="POST">
            <?= csrf_field() ?>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?= esc(old('username')) ?>" autocomplete="username" maxlength="100" required autofocus>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" autocomplete="current-password" maxlength="100" required>
            <button type="submit">Log In</button>
        </form>
    </main>
</body>
</html>