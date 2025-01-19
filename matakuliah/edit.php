<?php
include "../layout/header.php";
include "../config/koneksi.php";

// Mengambil data mata kuliah berdasarkan kode_matakuliah dari URL
if (isset($_GET['kode_matakuliah'])) {
    $kode_matakuliah = $_GET['kode_matakuliah'];
    $query = "SELECT * FROM matakuliah WHERE kode_matakuliah = '$kode_matakuliah'";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Data tidak ditemukan!'); window.location.href='index.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Kode Mata Kuliah tidak ditemukan!'); window.location.href='index.php';</script>";
    exit;
}

// Proses update data mata kuliah
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old_kode_matakuliah = $_POST['old_kode_matakuliah'];
    $kode_matakuliah = $_POST['kode_matakuliah'];
    $nama_matakuliah = $_POST['nama_matakuliah'];
    $sks = $_POST['sks'];

    $query = "UPDATE matakuliah 
              SET kode_matakuliah = '$kode_matakuliah', 
                  nama_matakuliah = '$nama_matakuliah', 
                  sks = '$sks' 
              WHERE kode_matakuliah = '$old_kode_matakuliah'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil diubah'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal mengubah data');</script>";
    }
}
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Edit Mata Kuliah</h1>

    <form method="POST" class="mx-auto p-4 shadow-sm rounded" style="max-width: 600px; background-color: #ffffff;">
        <input type="hidden" name="old_kode_matakuliah" value="<?= htmlspecialchars($data['kode_matakuliah']); ?>">

        <div class="mb-3">
            <label for="kode_matakuliah" class="form-label">Kode Mata Kuliah</label>
            <input type="text" class="form-control" id="kode_matakuliah" name="kode_matakuliah" 
                   value="<?= htmlspecialchars($data['kode_matakuliah']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="nama_matakuliah" class="form-label">Nama Mata Kuliah</label>
            <input type="text" class="form-control" id="nama_matakuliah" name="nama_matakuliah" 
                   value="<?= htmlspecialchars($data['nama_matakuliah']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="sks" class="form-label">SKS</label>
            <input type="number" class="form-control" id="sks" name="sks" 
                   value="<?= htmlspecialchars($data['sks']); ?>" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php include "../layout/footer.php"; ?>
