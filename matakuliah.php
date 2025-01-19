<?php
include 'config.php';

if (isset($_POST['tambah'])) {
    $kode = $_POST['kode_matakuliah'];
    $nama = $_POST['nama_matakuliah'];
    $sks = $_POST['sks'];

    $query = "INSERT INTO matakuliah (kode_matakuliah, nama_matakuliah, sks) 
              VALUES ('$kode', '$nama', '$sks')";
    mysqli_query($conn, $query);

    header("Location: matakuliah.php");
    exit();
}


if (isset($_GET['hapus'])) {
    $kode = $_GET['hapus'];
    $query = "DELETE FROM matakuliah WHERE kode_matakuliah='$kode'";
    mysqli_query($conn, $query);

    header("Location: matakuliah.php");
    exit();
}


if (isset($_POST['update'])) {
    $kode = $_POST['kode_matakuliah'];
    $nama = $_POST['nama_matakuliah'];
    $sks = $_POST['sks'];

    $query = "UPDATE matakuliah 
              SET nama_matakuliah='$nama', sks='$sks' 
              WHERE kode_matakuliah='$kode'";
    mysqli_query($conn, $query);

    
    header("Location: matakuliah.php");
    exit();
}


$result = mysqli_query($conn, "SELECT * FROM matakuliah");


$editData = null;
if (isset($_GET['edit'])) {
    $kode = $_GET['edit'];
    $editResult = mysqli_query($conn, "SELECT * FROM matakuliah WHERE kode_matakuliah='$kode'");
    $editData = mysqli_fetch_assoc($editResult);
}
include 'header/headermatkul.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mata Kuliah</title>
</head>
<body>
    

    
    <form method="POST">
        <h2>Tambah Data</h2>
        <input type="text" name="kode_matakuliah" placeholder="Kode Mata Kuliah" required>
        <input type="text" name="nama_matakuliah" placeholder="Nama Mata Kuliah" required>
        <input type="number" name="sks" placeholder="SKS" required>
        <button type="submit" name="tambah">Tambah</button>
    </form>

    
    <?php if ($editData): ?>
    <form method="POST">
        <h2>Edit Data</h2>
        <input type="text" name="kode_matakuliah" value="<?= $editData['kode_matakuliah'] ?>" required>
        <input type="text" name="nama_matakuliah" placeholder="Nama Mata Kuliah" value="<?= $editData['nama_matakuliah'] ?>" required>
        <input type="number" name="sks" placeholder="SKS" value="<?= $editData['sks'] ?>" required>
        <button type="submit" name="update">Update</button>
    </form>
    <?php endif; ?>

    
    <table border="1">
        <tr>
            <th>Kode</th>
            <th>Nama Mata Kuliah</th>
            <th>SKS</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['kode_matakuliah'] ?></td>
                <td><?= $row['nama_matakuliah'] ?></td>
                <td><?= $row['sks'] ?></td>
                <td>
                    <a href="matakuliah.php?edit=<?= $row['kode_matakuliah'] ?>">Edit</a> | 
                    <a href="matakuliah.php?hapus=<?= $row['kode_matakuliah'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
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
