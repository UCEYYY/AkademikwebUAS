<?php
include "../layout/header.php";
include "../config/koneksi.php";

// Mengambil data dari tabel mahasiswa
$query = "SELECT * FROM mahasiswa";
$result = mysqli_query($conn, $query);
?>

<h1 style="text-align: center; margin-top: 30px;">Data Mahasiswa</h1>

<!-- Tombol Tambah Mahasiswa -->
<div style="text-align: center; margin-top: 20px;">
    <a href="tambah.php" class="btn btn-primary" style="padding: 10px 20px;">Tambah Mahasiswa</a>
</div>

<!-- Tabel Data Mahasiswa -->
<div style="margin: 30px auto; width: 80%;">
    <table class="table table-bordered" style="text-align: center;">
        <thead class="table-dark">
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Jenis Kelamin</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nim']); ?></td>
                        <td><?= htmlspecialchars($row['nama_mhs']); ?></td>
                        <td><?= htmlspecialchars($row['tgl_lahir']); ?></td>
                        <td><?= htmlspecialchars($row['alamat']); ?></td>
                        <td><?= htmlspecialchars($row['jenis_kelamin']); ?></td>
                        <td>
                            <a href="edit.php?nim=<?= urlencode($row['nim']); ?>" class="btn btn-warning">Edit</a>
                            <a href="hapus.php?nim=<?= urlencode($row['nim']); ?>" 
                               class="btn btn-danger" 
                               onclick="return confirm('Hapus data?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Tidak ada data mahasiswa.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include "../layout/footer.php"; ?>
