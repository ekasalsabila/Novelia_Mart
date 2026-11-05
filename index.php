<?php
require_once __DIR__ . '/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>NoveliaMart</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            background: #fff7fa;
            font-family: Arial, sans-serif;
            color: #59434d;
            margin: 0;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: #ffffff;
            padding: 25px 18px;
            border-right: 1px solid #f5dce6;
            display: flex;
            flex-direction: column;
        }

        .brand {
            color: #d96b96;
            font-size: 23px;
            font-weight: bold;
            margin-bottom: 40px;
        }

        .menu-link {
            display: block;
            text-decoration: none;
            color: #806875;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 8px;
            transition: 0.2s;
        }

        .menu-link:hover,
        .menu-link.active {
            background: #fce4ec;
            color: #cf5f8b;
        }

        .logout {
            margin-top: auto;
        }

        .main {
            flex: 1;
            min-width: 0;
        }

        .topbar {
            background: white;
            padding: 20px 30px;
            border-bottom: 1px solid #f5dce6;
        }

        .content {
            padding: 30px;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 3px 15px rgba(210, 120, 155, 0.08);
        }

        .stat-card {
            padding: 22px;
        }

        .stat-icon {
            width: 45px;
            height: 45px;
            background: #fce4ec;
            color: #d96b96;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 22px;
        }

        .btn-pink {
            background: #df83a5;
            color: white;
            border: none;
        }

        .btn-pink:hover {
            background: #cf6d93;
            color: white;
        }

        .table thead th {
            background: #fce4ec;
            color: #805568;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 175px;
                padding: 18px 10px;
            }

            .content {
                padding: 15px;
            }

            .topbar {
                padding: 15px;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    <aside class="sidebar">
        <?php include 'menu.php'; ?>
    </aside>

    <main class="main">

        <div class="topbar d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1 fw-bold">Dashboard</h5>
                <small class="text-secondary">Selamat datang di NoveliaMart!</small>
            </div>

            <div class="text-secondary">
                <i class="bi bi-person-circle fs-4"></i>
            </div>
        </div>

        <div class="content">
            <?php include 'content.php'; ?>
        </div>

    </main>

</div>

</body>
</html>