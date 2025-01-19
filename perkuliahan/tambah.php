<?php
include "../layout/header.php";
include "../config/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil nilai dari form
    $nim = $_POST['nim'];
    $kode_matakuliah = $_POST['kode_matakuliah'];
    $nidn = $_POST['nidn'];
    $nilai = $_POST['nilai'];

    // Validasi input kosong
    if (empty($nim) || empty($kode_matakuliah) || empty($nidn) || empty($nilai)) {
        echo "<script>alert('Semua field harus diisi!'); window.location.href='tambah.php';</script>";
    } else {
        $query = "INSERT INTO perkuliahan (nim, kode_matakuliah, nidn, nilai) 
                  VALUES ('$nim', '$kode_matakuliah', '$nidn', '$nilai')";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data berhasil ditambahkan'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan data! Periksa apakah NIM, Mata Kuliah, dan NIDN sesuai.'); window.location.href='tambah.php';</script>";
        }
    }
}

// Mengambil data untuk dropdown
$queryMahasiswa = "SELECT * FROM mahasiswa";
$resultMahasiswa = mysqli_query($conn, $queryMahasiswa);

$queryMatakuliah = "SELECT * FROM matakuliah";
$resultMatakuliah = mysqli_query($conn, $queryMatakuliah);

$queryDosen = "SELECT * FROM dosen";
$resultDosen = mysqli_query($conn, $queryDosen);
?>

<h1 style="text-align: center; margin-top: 30px;">Tambah Perkuliahan</h1>

<div style="margin: 30px auto; width: 60%; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    <form method="POST">
        <!-- Pilihan Mahasiswa -->
        <div class="mb-3">
            <label for="nim" class="form-label">Mahasiswa</label>
            <select class="form-select" id="nim" name="nim" required>
                <option value="">Pilih Mahasiswa...</option>
                <?php while ($row = mysqli_fetch_assoc($resultMahasiswa)): ?>
                    <option value="<?= $row['nim']; ?>"><?= $row['nim']; ?> - <?= $row['nama_mhs']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- Pilihan Mata Kuliah -->
        <div class="mb-3">
            <label for="kode_matakuliah" class="form-label">Mata Kuliah</label>
            <select class="form-select" id="kode_matakuliah" name="kode_matakuliah" required>
                <option value="">Pilih Mata Kuliah...</option>
                <?php while ($row = mysqli_fetch_assoc($resultMatakuliah)): ?>
                    <option value="<?= $row['kode_matakuliah']; ?>"><?= $row['kode_matakuliah']; ?> - <?= $row['nama_matakuliah']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- Pilihan Dosen -->
        <div class="mb-3">
            <label for="nidn" class="form-label">Dosen</label>
            <select class="form-select" id="nidn" name="nidn" required>
                <option value="">Pilih Dosen...</option>
                <?php while ($row = mysqli_fetch_assoc($resultDosen)): ?>
                    <option value="<?= $row['nidn']; ?>"><?= $row['nidn']; ?> - <?= $row['nama_dosen']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- Input Nilai -->
        <div class="mb-3">
            <label for="nilai" class="form-label">Nilai</label>
            <input type="text" class="form-control" id="nilai" name="nilai" placeholder="Masukkan Nilai" required>
        </div>

        <!-- Tombol Simpan dan Batal -->
        <div style="text-align: center;">
            <button type="submit" class="btn btn-primary" style="padding: 10px 20px;">Simpan</button>
            <a href="index.php" class="btn btn-secondary" style="padding: 10px 20px; margin-left: 10px;">Batal</a>
        </div>
    </form>
</div>

<?php include "../layout/footer.php"; ?>

<script>
$(document).ready(function() {
    // Menambahkan fitur select2
    $('#nim').select2({
        placeholder: "Pilih Mahasiswa...",
        allowClear: true
    });

    $('#kode_matakuliah').select2({
        placeholder: "Pilih Mata Kuliah...",
        allowClear: true
    });

    $('#nidn').select2({
        placeholder: "Pilih Dosen...",
        allowClear: true
    });
});
</script>
