<?php
include 'config.php';

// Handle the addition of a new perkuliahan
if (isset($_POST['tambah'])) {
    $nim = $_POST['nim'];
    $kode_matakuliah = $_POST['kode_matakuliah'];
    $nidn = $_POST['nidn'];
    $nilai = $_POST['nilai'];

    $query = "INSERT INTO perkuliahan (nim, kode_matakuliah, nidn, nilai) 
              VALUES ('$nim', '$kode_matakuliah', '$nidn', '$nilai')";
    mysqli_query($conn, $query);
}

// Handle the deletion of a perkuliahan record
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $query = "DELETE FROM perkuliahan WHERE id='$id'";
    mysqli_query($conn, $query);
}

// Handle the updating of a perkuliahan record
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nim = $_POST['nim'];
    $kode_matakuliah = $_POST['kode_matakuliah'];
    $nidn = $_POST['nidn'];
    $nilai = $_POST['nilai'];

    $query = "UPDATE perkuliahan 
              SET nim='$nim', kode_matakuliah='$kode_matakuliah', nidn='$nidn', nilai='$nilai' 
              WHERE id='$id'";
    mysqli_query($conn, $query);
}

// Fetch all perkuliahan records
$result = mysqli_query($conn, "SELECT * FROM perkuliahan");

// Fetch data for editing
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $editResult = mysqli_query($conn, "SELECT * FROM perkuliahan WHERE id='$id'");
    $editData = mysqli_fetch_assoc($editResult);
}

include 'header/headerp.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Perkuliahan</title>
</head>
<body>
    <!-- Form to Add a New Perkuliahan -->
    <form method="POST">
        <h2>Tambah Data</h2>
        <input type="text" name="nim" placeholder="NIM Mahasiswa" required>
        <input type="text" name="kode_matakuliah" placeholder="Kode Mata Kuliah" required>
        <input type="text" name="nidn" placeholder="NIDN Dosen" required>
        <input type="text" name="nilai" placeholder="Nilai" required>
        <button type="submit" name="tambah">Tambah</button>
    </form>

    <!-- Form to Edit an Existing Perkuliahan -->
    <?php if ($editData): ?>
    <form method="POST">
        <h2>Edit Data</h2>
        <input type="hidden" name="id" value="<?= $editData['id'] ?>">
        <input type="text" name="nim" value="<?= $editData['nim'] ?>" required>
        <input type="text" name="kode_matakuliah" value="<?= $editData['kode_matakuliah'] ?>" required>
        <input type="text" name="nidn" value="<?= $editData['nidn'] ?>" required>
        <input type="text" name="nilai" value="<?= $editData['nilai'] ?>" required>
        <button type="submit" name="update">Update</button>
    </form>
    <?php endif; ?>

    <!-- Table Displaying All Perkuliahan -->
    <table border="1">
        <tr>
            <th>ID</th>
            <th>NIM</th>
            <th>Kode Mata Kuliah</th>
            <th>NIDN</th>
            <th>Nilai</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nim'] ?></td>
                <td><?= $row['kode_matakuliah'] ?></td>
                <td><?= $row['nidn'] ?></td>
                <td><?= $row['nilai'] ?></td>
                <td>
                    <a href="perkuliahan.php?edit=<?= $row['id'] ?>">Edit</a> | 
                    <a href="perkuliahan.php?hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <br><br>
    <a href="index.php">
        <button>Kembali ke Dashboard</button>
    </a>
</body>
</html>
