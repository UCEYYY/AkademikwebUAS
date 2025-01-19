<?php
include "../config/koneksi.php";

if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];

    if (empty($nim)) {
        echo "<script>alert('Field NIM belum terisi!'); window.history.back();</script>";
    } else {
        $query = "DELETE FROM perkuliahan WHERE nim = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 's', $nim);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Data berhasil dihapus!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus data!'); window.location.href='index.php';</script>";
        }
    }
} else {
    echo "<script>alert('Parameter NIM tidak ditemukan!'); window.location.href='index.php';</script>";
}
?>
