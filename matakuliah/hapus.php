<?php
include "../config/koneksi.php";

if (isset($_GET['kode_matakuliah'])) {
    $kode_matakuliah = $_GET['kode_matakuliah'];
    
    $query_perkuliahan = "DELETE FROM perkuliahan WHERE kode_matakuliah = '$kode_matakuliah'";
    mysqli_query($conn, $query_perkuliahan);
    
    $query_matakuliah = "DELETE FROM matakuliah WHERE kode_matakuliah = '$kode_matakuliah'";
    if (mysqli_query($conn, $query_matakuliah)) {
        echo "<script>alert('Data berhasil dihapus'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data');</script>";
    }
}
?>