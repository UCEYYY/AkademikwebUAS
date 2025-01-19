<?php
include "../layout/header.php";
include "../config/koneksi.php";

// Mengambil data dari tabel matakuliah
$query = "SELECT * FROM matakuliah";
$result = mysqli_query($conn, $query);
?>

<h1 style="text-align: center; margin-top: 30px;">Data Mata Kuliah</h1>

<!-- Tombol Tambah Mata Kuliah -->
<div style="text-align: center; margin-top: 20px;">
    <a href="tambah.php" class="btn btn-primary" style="padding: 10px 20px;">Tambah Mata Kuliah</a>
</div>

<!-- Tabel Data Mata Kuliah -->
<div style="margin: 30px auto; width: 80%;">
    <table class="table table-bordered" style="text-align: center;">
        <thead class="table-dark">
            <tr>
                <th>Kode Mata Kuliah</th>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['kode_matakuliah']); ?></td>
                        <td><?= htmlspecialchars($row['nama_matakuliah']); ?></td>
                        <td><?= htmlspecialchars($row['sks']); ?></td>
                        <td>
                            <a href="edit.php?kode_matakuliah=<?= urlencode($row['kode_matakuliah']); ?>" class="btn btn-warning">Edit</a>
                            <a href="hapus.php?kode_matakuliah=<?= urlencode($row['kode_matakuliah']); ?>" 
                               class="btn btn-danger" 
                               onclick="return confirm('Hapus data?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Tidak ada data mata kuliah.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include "../layout/footer.php"; ?>
