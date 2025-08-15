<?php
$sql = "SELECT * FROM produk";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "<script>alert('Woops! Terjadi kesalahan saat mengambil data produk.');</script>";
    echo "<script>window.location.href = 'index.php?action=home';</script>";
    exit();
}
?>

<div class="uk-container uk-margin-top">
    <div class="uk-flex uk-flex-between uk-align-center uk-margin-bottom">
        <h2 class="uk-margin-remove">List Produk</h2>
        <a href="index.php?action=create-produk" class="uk-button uk-button-primary uk-box-shadow-small">Buat Produk Baru</a>
    </div>
    <div class="uk-overflow-auto">
    <table class="uk-table uk-table-striped uk-table-hover uk-box-shadow-small">
        <thead>
            <tr>
                <th class="uk-text-center">No.</th>
                <th class="uk-text-center">Id</th>
                <th>Name</th>
                <th class="uk-text-center">Harga</th>
                <th class="uk-text-center">Stok</th>
                <th class="uk-text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
    <?php $counter = 1; while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td class="uk-text-center"><?php echo $counter++; ?></td>
            <td class="uk-text-center"><?php echo $row['ProdukID']; ?></td>
            <td><?php echo $row['NamaProduk']; ?></td>
            <td class="uk-text-center"><?php echo formatUang($row['Harga']); ?></td>
            <td class="uk-text-center"><?php echo $row['Stok']; ?></td>
            <td class="uk-text-center uk-flex uk-flex-middle uk-flex-center">
                <a href="index.php?action=edit-produk&ProdukID=<?php echo $row['ProdukID']; ?>" class="uk-icon-button uk-button-secondary" uk-icon="pencil"></a>
                <a href="index.php?action=delete-produk&ProdukID=<?php echo $row['ProdukID']; ?>" class="uk-icon-button uk-button-danger" uk-icon="trash" onclick="return confirm('Kamu yakin untuk menghapus data ini?')"></a>
            </td>
        </tr>
    <?php endwhile; ?>
</tbody>

    </table>
    </div>
</div>
