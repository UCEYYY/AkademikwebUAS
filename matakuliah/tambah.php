<?php
include "../layout/header.php";
include "../config/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari form
    $kode_matakuliah = mysqli_real_escape_string($conn, $_POST['kode_matakuliah']);
    $nama_matakuliah = mysqli_real_escape_string($conn, $_POST['nama_matakuliah']);
    $sks = mysqli_real_escape_string($conn, $_POST['sks']);

    // Query untuk menambahkan data ke database
    $query = "INSERT INTO matakuliah (kode_matakuliah, nama_matakuliah, sks) VALUES ('$kode_matakuliah', '$nama_matakuliah', '$sks')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil ditambahkan'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<h1 style="text-align: center; margin-top: 30px;">Tambah Mata Kuliah</h1>

<div style="margin: 30px auto; width: 60%; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    <form method="POST">
        <!-- Kode Mata Kuliah -->
        <div class="mb-3">
            <label for="kode_matakuliah" class="form-label">Kode Mata Kuliah</label>
            <input type="text" class="form-control" id="kode_matakuliah" name="kode_matakuliah" placeholder="Masukkan Kode Mata Kuliah" required>
        </div>

        <!-- Nama Mata Kuliah -->
        <div class="mb-3">
            <label for="nama_matakuliah" class="form-label">Nama Mata Kuliah</label>
            <input type="text" class="form-control" id="nama_matakuliah" name="nama_matakuliah" placeholder="Masukkan Nama Mata Kuliah" required>
        </div>

        <!-- SKS -->
        <div class="mb-3">
            <label for="sks" class="form-label">SKS</label>
            <input type="number" class="form-control" id="sks" name="sks" placeholder="Masukkan SKS" required>
        </div>

        <!-- Tombol Simpan dan Batal -->
        <div style="text-align: center;">
            <button type="submit" class="btn btn-primary" style="padding: 10px 20px;">Simpan</button>
            <a href="index.php" class="btn btn-secondary" style="padding: 10px 20px; margin-left: 10px;">Batal</a>
        </div>
    </form>
</div>

<?php include "../layout/footer.php"; ?>
