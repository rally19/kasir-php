<?php
$PelangganID = isset($_GET['PelangganID']) ? $_GET['PelangganID'] : null;

if (!empty($PelangganID)) {
    $delete_pelanggan = "DELETE FROM pelanggan WHERE PelangganID = '$PelangganID'";
    $result_pelanggan = mysqli_query($conn, $delete_pelanggan);

    if ($result_pelanggan) {
        echo "<script>alert('Pelanggan berhasil dihapus!');</script>";
        echo "<script>window.location.href = 'index.php?action=list-pelanggan';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data pelanggan');</script>";
        echo "<script>window.location.href = 'index.php?action=list-pelanggan';</script>";
    }
} else {
    echo "<script>alert('ID pelanggan tidak valid.');</script>";
    echo "<script>window.location.href = 'index.php?action=list-pelanggan';</script>";
}
?>