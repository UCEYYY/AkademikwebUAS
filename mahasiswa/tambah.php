<?php
include "../layout/header.php";
include "../config/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim = $_POST['nim'];
    $nama_mhs = $_POST['nama_mhs'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];

    $query = "INSERT INTO mahasiswa (nim, nama_mhs, tgl_lahir, alamat, jenis_kelamin) VALUES ('$nim', '$nama_mhs', '$tgl_lahir', '$alamat', '$jenis_kelamin')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil ditambahkan'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data');</script>";
    }
}
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Tambah Mahasiswa</h1>

    <!-- Form Tambah Mahasiswa -->
    <form method="POST" class="mx-auto p-4 shadow-sm rounded" style="max-width: 600px; background-color: #ffffff;">
        <div class="mb-3">
            <label for="nim" class="form-label"><strong>NIM</strong></label>
            <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukkan NIM" required>
        </div>

        <div class="mb-3">
            <label for="nama_mhs" class="form-label"><strong>Nama</strong></label>
            <input type="text" class="form-control" id="nama_mhs" name="nama_mhs" placeholder="Masukkan Nama Mahasiswa" required>
        </div>

        <div class="mb-3">
            <label for="tgl_lahir" class="form-label"><strong>Tanggal Lahir</strong></label>
            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label"><strong>Alamat</strong></label>
            <textarea class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label"><strong>Jenis Kelamin</strong></label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php include "../layout/footer.php"; ?>
