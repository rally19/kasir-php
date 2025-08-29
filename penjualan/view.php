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

$diskon_nominal = $penjualan['HargaKotor'] * ($penjualan['Diskon'] / 100);
$harga_setelah_diskon = $penjualan['HargaKotor'] - $diskon_nominal;
$pajak_nominal = $harga_setelah_diskon * ($penjualan['Pajak'] / 100);
?>

<div class="uk-container uk-margin-top">
    <div id="transaction" class="uk-card uk-card-default uk-box-shadow-large">
        <div class="uk-card-header uk-background-muted">
            <div class="uk-grid-small uk-flex-middle" uk-grid>
                <div class="uk-width-auto">
                    <span uk-icon="icon: receipt; ratio: 2"></span>
                </div>
                <div class="uk-width-expand">
                    <h3 class="uk-card-title uk-margin-remove-bottom">INVOICE PENJUALAN</h3>
                    <p class="uk-text-meta uk-margin-remove-top">
                        <span>Tanggal: <?php echo date('d F Y', strtotime($penjualan['TanggalPenjualan'])); ?></span>
                    </p>
                </div>
                <div class="uk-width-auto">
                    <span class="uk-label uk-label-success">#<?php echo $PenjualanID; ?></span>
                </div>
            </div>
        </div>
        
        <div class="uk-card-body">
            <div class="uk-grid-medium" uk-grid>
                <div class="uk-width-1-3@m">
                    <div class="uk-card uk-card-default uk-card-small uk-card-body">
                        <h4 class="uk-card-title">INFORMASI PELANGGAN</h4>
                        <table class="uk-table uk-table-divider uk-table-small">
                            <tbody>
                                <tr>
                                    <td class="uk-width-1-3"><strong>Nama</strong></td>
                                    <td><?php echo $penjualan['NamaPelanggan']; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Alamat</strong></td>
                                    <td><?php echo $penjualan['Alamat']; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Telepon</strong></td>
                                    <td><?php echo $penjualan['NomorTelepon']; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>ID Pelanggan</strong></td>
                                    <td><?php echo $penjualan['PelangganID']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="uk-width-2-3@m">
                    <div class="uk-card uk-card-default uk-card-small uk-card-body">
                        <h4 class="uk-card-title">DETAIL PRODUK</h4>
                        <div class="uk-overflow-auto">
                            <table class="uk-table uk-table-divider uk-table-small uk-table-middle">
                                <thead>
                                    <tr class="uk-background-muted">
                                        <th class="uk-table-shrink">No</th>
                                        <th>Produk</th>
                                        <th class="uk-text-right">Harga Satuan</th>
                                        <th class="uk-text-center">Jumlah</th>
                                        <th class="uk-text-center">Diskon</th>
                                        <th class="uk-text-right">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (mysqli_num_rows($detail_result) > 0): ?>
                                        <?php $no = 1; ?>
                                        <?php while ($detail = mysqli_fetch_assoc($detail_result)): ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $detail['NamaProduk']; ?></td>
                                                <td class="uk-text-right"><?php echo formatUang($detail['Harga']); ?></td>
                                                <td class="uk-text-center"><?php echo $detail['JumlahProduk']; ?></td>
                                                <td class="uk-text-center"><?php echo $detail['Diskon']; ?>%</td>
                                                <td class="uk-text-right"><?php echo formatUang($detail['Subtotal']); ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="uk-text-center">Tidak ada produk</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="uk-margin-top">
                <div class="uk-grid-medium" uk-grid>
                    <div class="uk-width-2-3@m">
                        <div class="uk-card uk-card-default uk-card-small uk-card-body">
                            <h4 class="uk-card-title">RINCIAN PEMBAYARAN</h4>
                            <table class="uk-table uk-table-divider uk-table-small">
                                <tbody>
                                    <tr>
                                        <td class="uk-width-1-2 uk-text-bold">Total Harga Kotor</td>
                                        <td class="uk-text-right"><?php echo formatUang($penjualan['HargaKotor']); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="uk-text-bold">Diskon Total (<?php echo $penjualan['Diskon']; ?>%)</td>
                                        <td class="uk-text-right">- <?php echo formatUang($diskon_nominal); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="uk-text-bold">Subtotal Setelah Diskon</td>
                                        <td class="uk-text-right"><?php echo formatUang($harga_setelah_diskon); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="uk-text-bold">Pajak (<?php echo $penjualan['Pajak']; ?>%)</td>
                                        <td class="uk-text-right">+ <?php echo formatUang($pajak_nominal); ?></td>
                                    </tr>
                                    <tr class="uk-background-muted">
                                        <td class="uk-text-bold uk-text-large">TOTAL AKHIR</td>
                                        <td class="uk-text-right uk-text-bold uk-text-large"><?php echo formatUang($penjualan['TotalHarga']); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="uk-width-1-3@m">
                        <div class="uk-card uk-card-default uk-card-small uk-card-body">
                            <h4 class="uk-card-title">INFORMASI TRANSAKSI</h4>
                            <table class="uk-table uk-table-divider uk-table-small">
                                <tbody>
                                    <tr>
                                        <td class="uk-width-1-2"><strong>ID Penjualan</strong></td>
                                        <td><?php echo $PenjualanID; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tanggal Transaksi</strong></td>
                                        <td><?php echo date('d/m/Y', strtotime($penjualan['TanggalPenjualan'])); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status</strong></td>
                                        <td><span class="uk-label uk-label-success">LUNAS</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="uk-card-footer uk-text-center uk-background-muted">
            <p class="uk-text-small">Terima kasih telah berbelanja di toko kami. </p> 
        </div>
    </div>
    
    <div class="uk-margin-top uk-text-center">
        <a href="index.php?action=list-penjualan" class="uk-button uk-button-default">
            <span uk-icon="icon: arrow-left"></span> Kembali ke Daftar Penjualan
        </a>
        <button onclick="printInvoice()" class="uk-button uk-button-primary">
            <span uk-icon="icon: print"></span> Cetak Invoice
        </button>
    </div>
    <br>
</div>

<script>
function printInvoice() {
    var printContents = document.getElementById('transaction').innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    window.location.reload();
}
</script>