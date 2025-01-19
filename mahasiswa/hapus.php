<?php
include "../config/koneksi.php";

if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];
 
    $queryPerkuliahan = "DELETE FROM perkuliahan WHERE nim = '$nim'";
    mysqli_query($conn, $queryPerkuliahan);
    $query = "DELETE FROM mahasiswa WHERE nim = '$nim'";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil dihapus'); window.location.href='../mahasiswa/index.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data'); window.location.href='../mahasiswa/index.php';</script>";
    }
}
?>
