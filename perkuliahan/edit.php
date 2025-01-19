<?php
include "../layout/header.php";
include "../config/koneksi.php";

// Cek jika parameter NIM ada
if (isset($_GET['nim'])) {
    $nim_lama = $_GET['nim'];

    // Query untuk mendapatkan data perkuliahan berdasarkan NIM
    $query = "SELECT * FROM perkuliahan WHERE nim = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $nim_lama);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Data tidak ditemukan'); window.location.href='index.php';</script>";
        exit;
    }
}

// Ambil data untuk dropdown mahasiswa, mata kuliah, dan dosen
$query_mahasiswa = "SELECT nim, nama_mhs FROM mahasiswa";
$result_mahasiswa = mysqli_query($conn, $query_mahasiswa);

$query_matakuliah = "SELECT kode_matakuliah, nama_matakuliah FROM matakuliah";
$result_matakuliah = mysqli_query($conn, $query_matakuliah);

$query_dosen = "SELECT nidn, nama_dosen FROM dosen";
$result_dosen = mysqli_query($conn, $query_dosen);

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim_baru = $_POST['nim'];
    $kode_matakuliah = $_POST['kode_matakuliah'];
    $nidn = $_POST['nidn'];
    $nilai = $_POST['nilai'];

    $query = "UPDATE perkuliahan SET nim = ?, kode_matakuliah = ?, nidn = ?, nilai = ? WHERE nim = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sssss', $nim_baru, $kode_matakuliah, $nidn, $nilai, $nim_lama);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Data berhasil diubah'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal mengubah data: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<h1 style="text-align: center; margin-top: 30px;">Edit Data Perkuliahan</h1>

<div style="margin: 30px auto; width: 60%;">
    <form method="POST">
        <!-- Dropdown NIM -->
        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <select class="form-control" id="nim" name="nim" required>
                <?php while ($row = mysqli_fetch_assoc($result_mahasiswa)): ?>
                    <option value="<?= htmlspecialchars($row['nim']); ?>" <?= ($data['nim'] === $row['nim']) ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($row['nim'] . ' - ' . $row['nama_mhs']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- Dropdown Mata Kuliah -->
        <div class="mb-3">
            <label for="kode_matakuliah" class="form-label">Kode Mata Kuliah</label>
            <select class="form-control" id="kode_matakuliah" name="kode_matakuliah" required>
                <?php while ($row = mysqli_fetch_assoc($result_matakuliah)): ?>
                    <option value="<?= htmlspecialchars($row['kode_matakuliah']); ?>" <?= ($data['kode_matakuliah'] === $row['kode_matakuliah']) ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($row['kode_matakuliah'] . ' - ' . $row['nama_matakuliah']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- Dropdown Dosen -->
        <div class="mb-3">
            <label for="nidn" class="form-label">Nama Dosen</label>
            <select class="form-control" id="nidn" name="nidn" required>
                <?php while ($row = mysqli_fetch_assoc($result_dosen)): ?>
                    <option value="<?= htmlspecialchars($row['nidn']); ?>" <?= ($data['nidn'] === $row['nidn']) ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($row['nidn'] . ' - ' . $row['nama_dosen']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- Input Nilai -->
        <div class="mb-3">
            <label for="nilai" class="form-label">Nilai</label>
            <input type="text" class="form-control" id="nilai" name="nilai" value="<?= htmlspecialchars($data['nilai']); ?>" required>
        </div>

        <!-- Tombol Simpan -->
        <div style="text-align: center;">
            <button type="submit" class="btn btn-primary" style="padding: 10px 20px;">Simpan</button>
        </div>
    </form>
</div>

<?php include "../layout/footer.php"; ?>
