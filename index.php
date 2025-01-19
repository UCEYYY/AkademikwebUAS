<?php
include "layout/header.php";
include "config/koneksi.php";

$queryMahasiswa = "SELECT COUNT(*) as total FROM mahasiswa";
$resultMahasiswa = mysqli_query($conn, $queryMahasiswa);
$dataMahasiswa = mysqli_fetch_assoc($resultMahasiswa);

$queryDosen = "SELECT COUNT(*) as total FROM dosen";
$resultDosen = mysqli_query($conn, $queryDosen);
$dataDosen = mysqli_fetch_assoc($resultDosen);

$queryMatakuliah = "SELECT COUNT(*) as total FROM matakuliah";
$resultMatakuliah = mysqli_query($conn, $queryMatakuliah);
$dataMatakuliah = mysqli_fetch_assoc($resultMatakuliah);

$queryPerkuliahan = "SELECT COUNT(*) as total FROM perkuliahan";
$resultPerkuliahan = mysqli_query($conn, $queryPerkuliahan);
$dataPerkuliahan = mysqli_fetch_assoc($resultPerkuliahan);
?>

<h1 style="text-align: center; margin-top: 20px;">Dashboard</h1>
<div style="display: flex; justify-content: space-around; flex-wrap: wrap; margin-top: 30px;">
    <div style="border: 1px solid #ddd; border-radius: 8px; padding: 20px; text-align: center; width: 200px; margin: 10px;">
        <h3>Mahasiswa</h3>
        <p style="font-size: 24px; font-weight: bold;"><?= $dataMahasiswa['total']; ?></p>
        <a href="mahasiswa/index.php" style="text-decoration: none; color: #007bff;">Lihat Detail</a>
    </div>
    <div style="border: 1px solid #ddd; border-radius: 8px; padding: 20px; text-align: center; width: 200px; margin: 10px;">
        <h3>Dosen</h3>
        <p style="font-size: 24px; font-weight: bold;"><?= $dataDosen['total']; ?></p>
        <a href="dosen/index.php" style="text-decoration: none; color: #007bff;">Lihat Detail</a>
    </div>
    <div style="border: 1px solid #ddd; border-radius: 8px; padding: 20px; text-align: center; width: 200px; margin: 10px;">
        <h3>Mata Kuliah</h3>
        <p style="font-size: 24px; font-weight: bold;"><?= $dataMatakuliah['total']; ?></p>
        <a href="matakuliah/index.php" style="text-decoration: none; color: #007bff;">Lihat Detail</a>
    </div>
    <div style="border: 1px solid #ddd; border-radius: 8px; padding: 20px; text-align: center; width: 200px; margin: 10px;">
        <h3>Perkuliahan</h3>
        <p style="font-size: 24px; font-weight: bold;"><?= $dataPerkuliahan['total']; ?></p>
        <a href="perkuliahan/index.php" style="text-decoration: none; color: #007bff;">Lihat Detail</a>
    </div>
</div>

<?php
include "layout/footer.php";
?>
