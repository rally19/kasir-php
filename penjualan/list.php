<?php
$sql = "
    SELECT p.PenjualanID, pl.NamaPelanggan, p.TanggalPenjualan, p.TotalHarga 
    FROM penjualan p 
    JOIN pelanggan pl ON p.PelangganID = pl.PelangganID 
    GROUP BY p.PenjualanID
";

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "<script>alert('Woops! Terjadi kesalahan saat mengambil data penjualan.');</script>";
    echo "<script>window.location.href = 'index.php';</script>";
    exit();
}
?>

<div class="uk-container uk-margin-top">
    <div class="uk-flex uk-flex-between uk-align-center uk-margin-bottom">
        <h2 class="uk-margin-remove">List Penjualan</h2>
        <a href="index.php?action=create-penjualan" class="uk-button uk-button-primary uk-box-shadow-small">Buat Penjualan Baru</a>
    </div>
    <div class="uk-overflow-auto">
    <table class="uk-table uk-table-striped uk-table-hover uk-box-shadow-small">
        <thead>
            <tr>
                <th class="uk-text-center">No.</th>
                <th class="uk-text-center">ID</th>
                <th>Nama Pelanggan</th>
                <th class="uk-text-center">Tanggal Penjualan</th>
                <th class="uk-text-center">Total Harga</th> <th class="uk-text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $counter = 1; while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td class="uk-text-center"><?php echo $counter++; ?></td>
                    <td class="uk-text-center"><?php echo $row['PenjualanID']; ?></td>
                    <td><?php echo $row['NamaPelanggan']; ?></td>
                    <td class="uk-text-center"><?php echo $row['TanggalPenjualan']; ?></td>
                    <td class="uk-text-center"><?php echo formatUang($row['TotalHarga']); ?></td> <td class="uk-text-center uk-flex uk-flex-middle uk-flex-center">
                        <a href="index.php?action=view-penjualan&PenjualanID=<?php echo $row['PenjualanID']; ?>" class="uk-icon-button uk-button-secondary" uk-icon="eye"></a>
                        <a href="index.php?action=delete-penjualan&PenjualanID=<?php echo $row['PenjualanID']; ?>" class="uk-icon-button uk-button-danger" uk-icon="trash" onclick="return confirm('Apakah Anda yakin untuk menghapus data penjualan ini?')"></a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    </div>
</div>