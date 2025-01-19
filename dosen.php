<?php
include 'config.php';

// Handle the addition of a new dosen
if (isset($_POST['tambah'])) {
    $nidn = mysqli_real_escape_string($conn, $_POST['nidn']);
    $nama_dosen = mysqli_real_escape_string($conn, $_POST['nama_dosen']);

    $query = "INSERT INTO dosen (nidn, nama_dosen) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $nidn, $nama_dosen);
    mysqli_stmt_execute($stmt);

    header("Location: dosen.php");
    exit();
}

// Handle deletion of dosen
if (isset($_GET['hapus'])) {
    $nidn = mysqli_real_escape_string($conn, $_GET['hapus']);
    
    // First, delete the perkuliahan record that references the dosen's nidn
    $query2 = "DELETE FROM perkuliahan WHERE nidn=?";
    $stmt2 = mysqli_prepare($conn, $query2);
    mysqli_stmt_bind_param($stmt2, "s", $nidn);
    mysqli_stmt_execute($stmt2);
    
    // Then delete the dosen record itself
    $query = "DELETE FROM dosen WHERE nidn=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $nidn);
    mysqli_stmt_execute($stmt);

    header("Location: dosen.php");
    exit();
}

// Handle updating dosen and related perkuliahan records
if (isset($_POST['update'])) {
    $nidn_lama = mysqli_real_escape_string($conn, $_POST['nidn_lama']);
    $nidn_baru = mysqli_real_escape_string($conn, $_POST['nidn']);
    $nama_dosen = mysqli_real_escape_string($conn, $_POST['nama_dosen']);

    // Update the 'dosen' table with the new NIDN and name
    $query = "UPDATE dosen SET nidn=?, nama_dosen=? WHERE nidn=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sss", $nidn_baru, $nama_dosen, $nidn_lama);
    mysqli_stmt_execute($stmt);

    // If the NIDN has been updated, update the 'perkuliahan' table
    if ($nidn_lama !== $nidn_baru) {
        $query2 = "UPDATE perkuliahan SET nidn=? WHERE nidn=?";
        $stmt2 = mysqli_prepare($conn, $query2);
        mysqli_stmt_bind_param($stmt2, "ss", $nidn_baru, $nidn_lama);
        mysqli_stmt_execute($stmt2);
    }

    header("Location: dosen.php");
    exit();
}

// Fetch all dosen records
$result = mysqli_query($conn, "SELECT * FROM dosen");

$editData = null;
if (isset($_GET['edit'])) {
    $nidn = mysqli_real_escape_string($conn, $_GET['edit']);
    $query = "SELECT * FROM dosen WHERE nidn=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $nidn);
    mysqli_stmt_execute($stmt);
    $resultEdit = mysqli_stmt_get_result($stmt);
    $editData = mysqli_fetch_assoc($resultEdit);
}

include 'header/headerp.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Dosen</title>
</head>
<body>
    
    <!-- Form to Add New Dosen -->
    <form method="POST">
        <h2>Tambah Data</h2>
        <input type="text" name="nidn" placeholder="NIDN" required>
        <input type="text" name="nama_dosen" placeholder="Nama Dosen" required>
        <button type="submit" name="tambah">Tambah</button>
    </form>

    <!-- Form to Edit Existing Dosen -->
    <?php if ($editData) { ?>
        <form method="POST">
            <h2>Edit Data</h2>
            
            <input type="hidden" name="nidn_lama" value="<?php echo htmlspecialchars($editData['nidn']); ?>">
            <label for="nidn"></label>
            <input type="text" id="nidn" name="nidn" value="<?php echo htmlspecialchars($editData['nidn']); ?>" required>
            <label for="nama_dosen"></label>
            <input type="text" id="nama_dosen" name="nama_dosen" value="<?php echo htmlspecialchars($editData['nama_dosen']); ?>" required>
            <button type="submit" name="update">Update</button>
        </form>
    <?php } ?>

    <!-- Table Displaying All Dosen -->
    <table border="1">
        <tr>
            <th>NIDN</th>
            <th>Nama Dosen</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= htmlspecialchars($row['nidn']) ?></td>
                <td><?= htmlspecialchars($row['nama_dosen']) ?></td>
                <td>
                    <a href="dosen.php?edit=<?= htmlspecialchars($row['nidn']) ?>">Edit</a> | 
                    <a href="dosen.php?hapus=<?= htmlspecialchars($row['nidn']) ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
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
