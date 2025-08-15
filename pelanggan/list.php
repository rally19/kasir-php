<?php
$sql = "SELECT * FROM pelanggan";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "<script>alert('Woops! Terjadi kesalahan saat mengambil data produk.');</script>";
    echo "<script>window.location.href = 'index.php?action=home';</script>";
    exit();
}
?>

<div class="uk-container uk-margin-top">
    <div class="uk-flex uk-flex-between uk-align-center uk-margin-bottom">
        <h2 class="uk-margin-remove">List Pelanggan</h2>
        <a href="index.php?action=create-pelanggan" class="uk-button uk-button-primary uk-box-shadow-small">Buat Pelanggan Baru</a>
    </div>
    <div class="uk-overflow-auto">
    <table class="uk-table uk-table-striped uk-table-hover uk-box-shadow-small">
        <thead>
            <tr>
                <th class="uk-text-center">No.</th>
                <th class="uk-text-center">Id</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No.Telp</th>
                <th class="uk-text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
    <?php $counter = 1; while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td class="uk-text-center"><?php echo $counter++; ?></td>
            <td class="uk-text-center"><?php echo $row['PelangganID']; ?></td>
            <td><?php echo $row['NamaPelanggan']; ?></td>
            <td><?php echo $row['Alamat']; ?></td>
            <td><?php echo $row['NomorTelepon']; ?></td>
            <td class="uk-text-center uk-flex uk-flex-middle uk-flex-center">
                <a href="index.php?action=edit-pelanggan&PelangganID=<?php echo $row['PelangganID']; ?>" class="uk-icon-button uk-button-secondary" uk-icon="pencil"></a>
                <a href="index.php?action=delete-pelanggan&PelangganID=<?php echo $row['PelangganID']; ?>" class="uk-icon-button uk-button-danger" uk-icon="trash" onclick="return confirm('Kamu yakin untuk menghapus data ini?')"></a>
            </td>
        </tr>
    <?php endwhile; ?>
</tbody>

    </table>
    </div>
</div>
