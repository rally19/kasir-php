<?php
$PenjualanID = isset($_GET['PenjualanID']) ? $_GET['PenjualanID'] : null;

if (empty($PenjualanID)) {
    echo "<script>alert('ID Penjualan tidak valid.');</script>";
    echo "<script>window.location.href = 'index.php?action=list-penjualan';</script>";
    exit();
}

$penjualan_sql = "SELECT * FROM penjualan WHERE PenjualanID = '$PenjualanID'";
$penjualan_result = mysqli_query($conn, $penjualan_sql);
$penjualan = mysqli_fetch_assoc($penjualan_result);

$detail_sql = "SELECT * FROM detailpenjualan WHERE PenjualanID = '$PenjualanID'";
$detail_result = mysqli_query($conn, $detail_sql);
?>

<div class="uk-container uk-margin-top">
    <div class="uk-card uk-card-default uk-box-shadow-small">
        <div class="uk-card-header">
            <div class="uk-grid-small uk-flex-middle" uk-grid>
                <div class="uk-width-auto">
                    <span uk-icon="icon: file-text; ratio: 2"></span>
                </div>
                <div class="uk-width-expand">
                    <h3 class="uk-card-title uk-margin-remove-bottom">Detail Penjualan #<?php echo $PenjualanID; ?></h3>
                    <p class="uk-text-meta uk-margin-remove-top">
                        <span>Tanggal: <?php echo date('d F Y', strtotime($penjualan['TanggalPenjualan'])); ?></span>
                    </p>
                </div>
                <div class="uk-width-auto">
                    <a href="index.php?action=list-penjualan" class="uk-button uk-button-default uk-button-small">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
        
        <div class="uk-card-body">
            <div class="uk-grid-medium" uk-grid>
                <div class="uk-width-1-3@m">
                    <div class="uk-card uk-card-default uk-card-small uk-card-body">
                        <h4 class="uk-card-title">Informasi Pelanggan</h4>
                        <table class="uk-table uk-table-divider uk-table-small">
                            <tbody>
                                <tr>
                                    <td class="uk-width-1-3">Nama</td>
                                    <td><?php echo $penjualan['NamaPelanggan']; ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td><?php echo $penjualan['Alamat']; ?></td>
                                </tr>
                                <tr>
                                    <td>Telepon</td>
                                    <td><?php echo $penjualan['NomorTelepon']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="uk-width-2-3@m">
                    <div class="uk-card uk-card-default uk-card-small uk-card-body">
                        <h4 class="uk-card-title">Ringkasan Penjualan</h4>
                        <div class="uk-overflow-auto">
                            <table class="uk-table uk-table-divider uk-table-small">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th class="uk-text-right">Harga</th>
                                        <th class="uk-text-center">Jumlah</th>
                                        <th class="uk-text-right">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (mysqli_num_rows($detail_result) > 0): ?>
                                        <?php mysqli_data_seek($detail_result, 0); // Reset pointer ?>
                                        <?php while ($detail = mysqli_fetch_assoc($detail_result)): ?>
                                            <tr>
                                                <td><?php echo $detail['NamaProduk']; ?></td>
                                                <td class="uk-text-right">Rp <?php echo number_format($detail['Harga'], 0, ',', '.'); ?></td>
                                                <td class="uk-text-center"><?php echo $detail['JumlahProduk']; ?></td>
                                                <td class="uk-text-right">Rp <?php echo number_format($detail['Subtotal'], 0, ',', '.'); ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="uk-text-center">Tidak ada produk</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="uk-text-right">Total</th>
                                        <th class="uk-text-right">Rp <?php echo number_format($penjualan['TotalHarga'], 0, ',', '.'); ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="uk-margin-top">
                <div class="uk-card uk-card-default uk-card-small uk-card-body">
                    <h4 class="uk-card-title">Informasi Tambahan</h4>
                    <dl class="uk-description-list">
                        <dt>ID Penjualan</dt>
                        <dd><?php echo $PenjualanID; ?></dd>
                        
                        <dt>Tanggal Penjualan</dt>
                        <dd><?php echo date('d F Y H:i:s', strtotime($penjualan['TanggalPenjualan'])); ?></dd>
                    </dl>
                </div>
            </div>
        </div>
        <br>
    </div>
</div>