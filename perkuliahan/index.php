<?php
include "../layout/header.php";
include "../config/koneksi.php";

$query = "SELECT perkuliahan.nim, mahasiswa.nama_mhs, perkuliahan.kode_matakuliah, matakuliah.nama_matakuliah, perkuliahan.nidn, dosen.nama_dosen, perkuliahan.nilai FROM perkuliahan 
          INNER JOIN mahasiswa ON perkuliahan.nim = mahasiswa.nim 
          INNER JOIN matakuliah ON perkuliahan.kode_matakuliah = matakuliah.kode_matakuliah 
          INNER JOIN dosen ON perkuliahan.nidn = dosen.nidn";
$result = mysqli_query($conn, $query);
?>
<div class="container mt-5">
    <h1 class="mb-4 text-center">Data Perkuliahan</h1>
    <div style="text-align: center; margin-top: 20px; margin-bottom: 20px;">
    <a href="tambah.php" class="btn btn-primary" style="padding: 10px 20px;">Tambah Perkuliahan</a>
</div>

    <table class="table table-striped table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Kode Mata Kuliah</th>
                <th>Nama Mata Kuliah</th>
                <th>NIDN</th>
                <th>Nama Dosen</th>
                <th>Nilai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row['nim']; ?></td>
                    <td><?= $row['nama_mhs']; ?></td>
                    <td><?= $row['kode_matakuliah']; ?></td>
                    <td><?= $row['nama_matakuliah']; ?></td>
                    <td><?= $row['nidn']; ?></td>
                    <td><?= $row['nama_dosen']; ?></td>
                    <td><?= $row['nilai']; ?></td>
                    <td>
                        <a href="edit.php?nim=<?= $row['nim']; ?>&kode_matakuliah=<?= $row['kode_matakuliah']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="hapus.php?nim=<?= $row['nim']; ?>&kode_matakuliah=<?= $row['kode_matakuliah']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php include "../layout/footer.php"; ?>
