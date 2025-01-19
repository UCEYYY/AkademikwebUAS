<?php
include "../layout/header.php";
include "../config/koneksi.php";

// Mengambil data dosen
$query = "SELECT * FROM dosen";
$result = mysqli_query($conn, $query);
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Data Dosen</h1>

    <!-- Tombol Tambah Dosen -->
    <div class="text-center mb-4">
        <a href="tambah.php" class="btn btn-primary">Tambah Dosen</a>
    </div>

    <!-- Tabel Data Dosen -->
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th style="width: 20%;">NIDN</th>
                    <th style="width: 50%;">Nama Dosen</th>
                    <th style="width: 30%; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['nidn']); ?></td>
                            <td><?= htmlspecialchars($row['nama_dosen']); ?></td>
                            <td class="text-center">
                                <a href="edit.php?nidn=<?= urlencode($row['nidn']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="hapus.php?nidn=<?= urlencode($row['nidn']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">Tidak ada data dosen.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include "../layout/footer.php"; ?>
