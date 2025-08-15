<?php
$ProdukID = isset($_GET['ProdukID']) ? $_GET['ProdukID'] : null;

if (!empty($ProdukID)) {
    $delete_produk = "DELETE FROM produk WHERE ProdukID = '$ProdukID'";
    $result_produk = mysqli_query($conn, $delete_produk);

    if ($result_produk) {
        echo "<script>alert('Produk berhasil dihapus!');</script>";
        echo "<script>window.location.href = 'index.php?action=list-produk';</script>";
        exit();
    } else {
        echo "<script>alert('Gagal menghapus produk');</script>";
        echo "<script>window.location.href = 'index.php?action=list-produk';</script>";
    }
} else {
    echo "<script>alert('ID produk tidak valid.');</script>";
    echo "<script>window.location.href = 'index.php?action=list-produk';</script>";
}
?>