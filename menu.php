<?php
$halaman = $_GET['pages'] ?? 'dashboard';
?>

<div class="brand">
    <i class="bi bi-bag-heart-fill"></i>
    NoveliaMart
</div>

<div class="mb-3 text-uppercase text-secondary small fw-bold">
    Menu
</div>

<a href="index.php?pages=dashboard"
   class="menu-link <?= $halaman == 'dashboard' ? 'active' : '' ?>">
    <i class="bi bi-grid me-2"></i>
    Dashboard
</a>

<a href="index.php?pages=produk"
   class="menu-link <?= $halaman == 'produk' ? 'active' : '' ?>">
    <i class="bi bi-box-seam me-2"></i>
    Products
</a>

<a href="index.php?pages=orders"
   class="menu-link <?= $halaman == 'orders' ? 'active' : '' ?>">
    <i class="bi bi-cart3 me-2"></i>
    Orders
</a>

<a href="index.php?pages=customers"
   class="menu-link <?= $halaman == 'customers' ? 'active' : '' ?>">
    <i class="bi bi-people me-2"></i>
    Customers
</a>

<a href="index.php?pages=reports"
   class="menu-link <?= $halaman == 'reports' ? 'active' : '' ?>">
    <i class="bi bi-bar-chart-line me-2"></i>
    Reports
</a>

<a href="index.php?pages=integrations"
   class="menu-link <?= $halaman == 'integrations' ? 'active' : '' ?>">
    <i class="bi bi-grid-3x3-gap me-2"></i>
    Integrations
</a>

<div class="logout">
    <a href="index.php" class="menu-link text-danger">
        <i class="bi bi-box-arrow-left me-2"></i>
        Sign Out
    </a>
</div>