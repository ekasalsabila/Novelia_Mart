<?php

$queryProduk = mysqli_query($conn, "SELECT COUNT(*) AS total FROM produk");
$dataProduk = mysqli_fetch_assoc($queryProduk);

$queryStok = mysqli_query($conn, "SELECT SUM(stok) AS total FROM produk");
$dataStok = mysqli_fetch_assoc($queryStok);

$queryKategori = mysqli_query($conn, "SELECT COUNT(DISTINCT kategori) AS total FROM produk");
$dataKategori = mysqli_fetch_assoc($queryKategori);

?>

<h4 class="fw-bold mb-1">Dashboard</h4>
<p class="text-secondary mb-4">Ringkasan data NoveliaMart.</p>

<div class="row g-4">

    <div class="col-md-4">
        <div class="card stat-card">
            <div class="d-flex justify-content-between">
                <div>
                    <p class="text-secondary mb-2">Total Produk</p>
                    <h3 class="fw-bold">
                        <?= $dataProduk['total']; ?>
                    </h3>
                </div>

                <div class="stat-icon">
                    <i class="bi bi-box-seam"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card stat-card">
            <div class="d-flex justify-content-between">
                <div>
                    <p class="text-secondary mb-2">Total Stok</p>
                    <h3 class="fw-bold">
                        <?= $dataStok['total'] ?? 0; ?>
                    </h3>
                </div>

                <div class="stat-icon">
                    <i class="bi bi-boxes"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card stat-card">
            <div class="d-flex justify-content-between">
                <div>
                    <p class="text-secondary mb-2">Total Kategori</p>
                    <h3 class="fw-bold">
                        <?= $dataKategori['total']; ?>
                    </h3>
                </div>

                <div class="stat-icon">
                    <i class="bi bi-tags"></i>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="card mt-4 p-4">
    <h5 class="fw-bold">Selamat Datang!</h5>
    <p class="text-secondary mb-0">
        Kelola produk toko dengan mudah melalui dashboard NoveliaMart.
    </p>
</div>