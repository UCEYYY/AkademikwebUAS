<?php
include "../config/koneksi.php";

if (isset($_GET['nidn'])) {
    $nidn = $_GET['nidn'];

    $queryPerkuliahan = "DELETE FROM perkuliahan WHERE nidn = '$nidn'";
    mysqli_query($conn, $queryPerkuliahan);

    $queryDosen = "DELETE FROM dosen WHERE nidn = '$nidn'";
    if (mysqli_query($conn, $queryDosen)) {
        echo "<script>alert('Data berhasil dihapus'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data');</script>";
    }
}
?>
