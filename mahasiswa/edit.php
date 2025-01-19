<?php
include "../layout/header.php";
include "../config/koneksi.php";

if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];
    $query = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $data = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Data tidak ditemukan!'); window.location.href='index.php';</script>";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim_lama = $_POST['nim_lama']; 
    $nim_baru = $_POST['nim'];     
    $nama_mhs = $_POST['nama_mhs'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];

    $queryMahasiswa = "UPDATE mahasiswa SET 
                        nim = '$nim_baru',
                        nama_mhs = '$nama_mhs', 
                        tgl_lahir = '$tgl_lahir', 
                        alamat = '$alamat', 
                        jenis_kelamin = '$jenis_kelamin' 
                      WHERE nim = '$nim_lama'";

    mysqli_query($conn, $queryMahasiswa);

    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>alert('Data berhasil diubah'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal mengubah data!');</script>";
    }
}
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Edit Data Mahasiswa</h1>
    
    <form method="POST" class="mx-auto p-4 shadow-sm rounded" style="max-width: 600px; background-color: #ffffff;">
        <input type="hidden" name="nim_lama" value="<?= htmlspecialchars($data['nim']); ?>">

        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" id="nim" name="nim" value="<?= htmlspecialchars($data['nim']); ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="nama_mhs" class="form-label">Nama Mahasiswa</label>
            <input type="text" id="nama_mhs" name="nama_mhs" value="<?= htmlspecialchars($data['nama_mhs']); ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" id="tgl_lahir" name="tgl_lahir" value="<?= htmlspecialchars($data['tgl_lahir']); ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea id="alamat" name="alamat" class="form-control" required><?= htmlspecialchars($data['alamat']); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select id="jenis_kelamin" name="jenis_kelamin" class="form-select" required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki" <?= ($data['jenis_kelamin'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                <option value="Perempuan" <?= ($data['jenis_kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
            </select>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php
include "../layout/footer.php";
?>
