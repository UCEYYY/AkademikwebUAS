<?php
include 'config.php';

// Tambah Data Mahasiswa
if (isset($_POST['tambah'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];

    $query = "INSERT INTO mahasiswa (nim, nama_mhs, tgl_lahir, alamat, jenis_kelamin) 
              VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssss", $nim, $nama, $tgl_lahir, $alamat, $jenis_kelamin);
    mysqli_stmt_execute($stmt);

    header("Location: mahasiswa.php");
    exit();
}

// Hapus Data Mahasiswa dan Tabel Terkait
if (isset($_GET['hapus'])) {
    $nim = $_GET['hapus'];

    // Hapus data dari tabel perkuliahan terlebih dahulu
    $query_perkuliahan = "DELETE FROM perkuliahan WHERE nim = ?";
    $stmt_perkuliahan = mysqli_prepare($conn, $query_perkuliahan);
    mysqli_stmt_bind_param($stmt_perkuliahan, "s", $nim);
    mysqli_stmt_execute($stmt_perkuliahan);

    // Hapus data dari tabel mahasiswa
    $query_mahasiswa = "DELETE FROM mahasiswa WHERE nim = ?";
    $stmt_mahasiswa = mysqli_prepare($conn, $query_mahasiswa);
    mysqli_stmt_bind_param($stmt_mahasiswa, "s", $nim);
    mysqli_stmt_execute($stmt_mahasiswa);

    header("Location: mahasiswa.php");
    exit();
}

// Update Data Mahasiswa dan Tabel Terkait
if (isset($_POST['update'])) {
    $nim = $_POST['nim'];
    $nim_lama = $_POST['nim_lama'];
    $nama = $_POST['nama'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];

    // Update tabel mahasiswa
    $query_mahasiswa = "UPDATE mahasiswa 
                        SET nim = ?, nama_mhs = ?, tgl_lahir = ?, alamat = ?, jenis_kelamin = ? 
                        WHERE nim = ?";
    $stmt_mahasiswa = mysqli_prepare($conn, $query_mahasiswa);
    mysqli_stmt_bind_param($stmt_mahasiswa, "ssssss", $nim, $nama, $tgl_lahir, $alamat, $jenis_kelamin, $nim_lama);
    mysqli_stmt_execute($stmt_mahasiswa);

    // Update tabel perkuliahan (jika NIM terkait diubah)
    $query_perkuliahan = "UPDATE perkuliahan 
                          SET nim = ? 
                          WHERE nim = ?";
    $stmt_perkuliahan = mysqli_prepare($conn, $query_perkuliahan);
    mysqli_stmt_bind_param($stmt_perkuliahan, "ss", $nim, $nim_lama);
    mysqli_stmt_execute($stmt_perkuliahan);

    header("Location: mahasiswa.php");
    exit();
}

// Mendapatkan data mahasiswa untuk diedit
$editData = null;
if (isset($_GET['edit'])) {
    $nim = $_GET['edit'];
    $query = "SELECT * FROM mahasiswa WHERE nim = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $nim);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $editData = mysqli_fetch_assoc($result);
}

// Ambil semua data mahasiswa
$query = "SELECT * FROM mahasiswa";
$result = mysqli_query($conn, $query);

include 'header/headermhs.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
</head>
<body>
    <!-- Form Tambah Data -->
    <form method="POST">
        <h2>Tambah Data</h2>
        <input type="text" name="nim" placeholder="NIM" required>
        <input type="text" name="nama" placeholder="Nama" required>
        <input type="date" name="tgl_lahir" required>
        <input type="text" name="alamat" placeholder="Alamat" required>
        <input type="text" name="jenis_kelamin" placeholder="Jenis Kelamin" required>
        <button type="submit" name="tambah">Tambah</button>
    </form>

    <!-- Form Edit Data -->
    <?php if ($editData): ?>
    <form method="POST">
        <h2>Edit Data</h2>
        <input type="hidden" name="nim_lama" value="<?= htmlspecialchars($editData['nim']) ?>">
        <input type="text" name="nim" value="<?= htmlspecialchars($editData['nim']) ?>" required>
        <input type="text" name="nama" value="<?= htmlspecialchars($editData['nama_mhs']) ?>" required>
        <input type="date" name="tgl_lahir" value="<?= htmlspecialchars($editData['tgl_lahir']) ?>" required>
        <input type="text" name="alamat" value="<?= htmlspecialchars($editData['alamat']) ?>" required>
        <input type="text" name="jenis_kelamin" value="<?= htmlspecialchars($editData['jenis_kelamin']) ?>" required>
        <button type="submit" name="update">Update</button>
    </form>
    <?php endif; ?>

    <!-- Tabel Data Mahasiswa -->
    <table border="1">
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Tgl Lahir</th>
            <th>Alamat</th>
            <th>Jenis Kelamin</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= htmlspecialchars($row['nim']) ?></td>
            <td><?= htmlspecialchars($row['nama_mhs']) ?></td>
            <td><?= htmlspecialchars($row['tgl_lahir']) ?></td>
            <td><?= htmlspecialchars($row['alamat']) ?></td>
            <td><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
            <td>
                <a href="mahasiswa.php?edit=<?= htmlspecialchars($row['nim']) ?>">Edit</a> |
                <a href="mahasiswa.php?hapus=<?= htmlspecialchars($row['nim']) ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <br><br>
    <a href="index.php">
        <button>Kembali ke Dashboard</button>
    </a>
</body>
</html>
