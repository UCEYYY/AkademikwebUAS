<?php
include "../layout/header.php";
include "../config/koneksi.php";

if (isset($_GET['nidn'])) {
    $nidn = $_GET['nidn'];
    $query = "SELECT * FROM dosen WHERE nidn = '$nidn'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nidn_lama = $_POST['nidn_lama']; 
    $nidn_baru = $_POST['nidn']; 
    $nama_dosen = $_POST['nama_dosen'];

    $query = "UPDATE dosen SET nidn = '$nidn_baru', nama_dosen = '$nama_dosen' WHERE nidn = '$nidn_lama'";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil diubah'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal mengubah data');</script>";
    }
}
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Edit Data Dosen</h1>

    <form method="POST" class="mx-auto" style="max-width: 500px;">
        <input type="hidden" name="nidn_lama" value="<?= htmlspecialchars($data['nidn']); ?>">

        <div class="mb-3">
            <label for="nidn" class="form-label">NIDN</label>
            <input type="text" class="form-control" id="nidn" name="nidn" value="<?= htmlspecialchars($data['nidn']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="nama_dosen" class="form-label">Nama Dosen</label>
            <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" value="<?= htmlspecialchars($data['nama_dosen']); ?>" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php include "../layout/footer.php"; ?>
