<?php
include "../layout/header.php";
include "../config/koneksi.php";

// Proses menambahkan data dosen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nidn = $_POST['nidn'];
    $nama_dosen = $_POST['nama_dosen'];

    $query = "INSERT INTO dosen (nidn, nama_dosen) VALUES ('$nidn', '$nama_dosen')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil ditambahkan'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data');</script>";
    }
}
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Tambah Dosen</h1>

    <!-- Form Tambah Dosen -->
    <form method="POST" class="mx-auto p-4 shadow-sm rounded" style="max-width: 600px; background-color: #f9f9f9;">
        <div class="mb-3">
            <label for="nidn" class="form-label"><strong>NIDN</strong></label>
            <input type="text" class="form-control" id="nidn" name="nidn" placeholder="Masukkan NIDN" required>
        </div>

        <div class="mb-3">
            <label for="nama_dosen" class="form-label"><strong>Nama Dosen</strong></label>
            <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" placeholder="Masukkan Nama Dosen" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php include "../layout/footer.php"; ?>
