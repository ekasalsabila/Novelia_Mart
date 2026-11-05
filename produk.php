    <?php
    $query = mysqli_query($conn, "SELECT * FROM produk ORDER BY id DESC");

    if (!$query) {
        die("Query gagal: " . mysqli_error($conn));
    }
    ?>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Products</h4>
            <p class="text-secondary mb-0">Kelola semua produk toko.</p>
        </div>

        <a href="index.php?pages=tambah" class="btn btn-pink">
            <i class="bi bi-plus-lg me-1"></i>
            Tambah Produk
        </a>
    </div>

    <div class="card p-3">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Kategori</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if (mysqli_num_rows($query) > 0): ?>

                        <?php while ($produk = mysqli_fetch_assoc($query)): ?>

                            <tr>
                                <td><?= $produk['id']; ?></td>

                                <td class="fw-semibold">
                                    <?= htmlspecialchars($produk['nama_barang']); ?>
                                </td>

                                <td>
                                    Rp<?= number_format($produk['harga'], 0, ',', '.'); ?>
                                </td>

                                <td><?= $produk['stok']; ?></td>

                                <td>
                                    <span class="badge rounded-pill text-bg-light">
                                        <?= htmlspecialchars($produk['kategori']); ?>
                                    </span>
                                </td>

                                <td>
                                    <?php if (!empty($produk['gambar'])): ?>
                                        <img
                                            src="assets/<?= htmlspecialchars(basename($produk['gambar'])); ?>"
                                            width="50"
                                            height="50"
                                            style="object-fit: cover; border-radius: 8px;"
                                            alt="Gambar produk">
                                    <?php else: ?>
                                        <span class="text-secondary">Tidak ada</span>
                                    <?php endif; ?>
                                </td>
                                <td>
        <a href="index.php?pages=edit&id=<?= $produk['id']; ?>"
        class="btn btn-sm btn-warning">
            <i class="bi bi-pencil-square me-1"></i>
            Edit
        </a>

        <form action="proses_hapus.php" method="POST"
            class="d-inline"
            onsubmit="return confirm('Yakin ingin menghapus produk ini?')">

            <input type="hidden" name="id" value="<?= $produk['id']; ?>">

            <button type="submit" class="btn btn-sm btn-danger">
                <i class="bi bi-trash me-1"></i>
                Hapus
            </button>

        </form>
    </td>
                            </tr>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="7" class="text-center text-secondary py-4">
                                Belum ada produk.
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>
    </div>