<?php
$PenjualanID = isset($_GET['PenjualanID']) ? $_GET['PenjualanID'] : null;

if (!empty($PenjualanID)) {
    $delete_detail = "DELETE FROM detailpenjualan WHERE PenjualanID = '$PenjualanID'";
    $result_detail = mysqli_query($conn, $delete_detail);
    
    if (!$result_detail) {
        echo "<script>alert('Gagal menghapus detail penjualan');</script>";
        echo "<script>window.location.href = 'index.php?action=list-penjualan';</script>";
        exit();
    }
    
    $delete_penjualan = "DELETE FROM penjualan WHERE PenjualanID = '$PenjualanID'";
    $result_penjualan = mysqli_query($conn, $delete_penjualan);
    
    if ($result_penjualan) {
        echo "<script>alert('Penjualan #$PenjualanID berhasil dihapus!');</script>";
        echo "<script>window.location.href = 'index.php?action=list-penjualan';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data penjualan');</script>";
        echo "<script>window.location.href = 'index.php?action=list-penjualan';</script>";
    }
    
} else {
    echo "<script>alert('ID penjualan tidak valid.');</script>";
    echo "<script>window.location.href = 'index.php?action=list-penjualan';</script>";
}
?>