<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $PelangganID = $_POST['PelangganID'];
    $TanggalPenjualan = date("Y-m-d"); 
    $TotalHarga = 0; 

    if (!empty($PelangganID) && !empty($_POST['produk'])) {
        // Ambil data pelanggan
        $pelanggan_query = "SELECT NamaPelanggan, Alamat, NomorTelepon FROM pelanggan WHERE PelangganID = '$PelangganID'";
        $pelanggan_result = mysqli_query($conn, $pelanggan_query);
        $pelanggan_data = mysqli_fetch_assoc($pelanggan_result);
        
        // Insert ke tabel penjualan dengan data pelanggan
        $sql = "INSERT INTO penjualan (PelangganID, TanggalPenjualan, TotalHarga, NamaPelanggan, Alamat, NomorTelepon) 
                VALUES ('$PelangganID', '$TanggalPenjualan', '$TotalHarga', 
                '{$pelanggan_data['NamaPelanggan']}', '{$pelanggan_data['Alamat']}', '{$pelanggan_data['NomorTelepon']}')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            $PenjualanID = mysqli_insert_id($conn);
            
            // Proses detail penjualan
            foreach ($_POST['produk'] as $produk) {
                $ProdukID = $produk['ProdukID'];
                $JumlahProduk = $produk['JumlahProduk'];
                
                // Ambil data produk
                $produk_query = "SELECT NamaProduk, Harga, Stok FROM produk WHERE ProdukID = '$ProdukID'";
                $produk_result = mysqli_query($conn, $produk_query);
                $produk_data = mysqli_fetch_assoc($produk_result);
                
                $Subtotal = $produk_data['Harga'] * $JumlahProduk;
                $TotalHarga += $Subtotal;
                
                // Insert ke detail penjualan
                $detail_sql = "INSERT INTO detailpenjualan (PenjualanID, ProdukID, NamaProduk, Harga, JumlahProduk, Subtotal)
                              VALUES ('$PenjualanID', '$ProdukID', '{$produk_data['NamaProduk']}', '{$produk_data['Harga']}', '$JumlahProduk', '$Subtotal')";
                mysqli_query($conn, $detail_sql);
                
                // Update stok produk
                $update_stok = "UPDATE produk SET Stok = Stok - $JumlahProduk WHERE ProdukID = '$ProdukID'";
                mysqli_query($conn, $update_stok);
            }
            
            // Update total harga di penjualan
            $update_total = "UPDATE penjualan SET TotalHarga = '$TotalHarga' WHERE PenjualanID = '$PenjualanID'";
            mysqli_query($conn, $update_total);
            
            echo "<script>alert('Penjualan berhasil ditambahkan!');</script>";
            echo "<script>window.location.href = 'index.php?action=view-penjualan&PenjualanID=" . $PenjualanID . "';</script>";
            exit();
        } else {
            echo "<script>alert('Woops! Terjadi kesalahan saat menambahkan penjualan.');</script>";
            echo "<script>window.location.href = 'index.php?action=list-penjualan';</script>";
        }
    } else {
        echo "<script>alert('Silakan pilih pelanggan dan tambahkan minimal 1 produk.');</script>";
        echo "<script>window.location.href = 'index.php?action=create-penjualan';</script>";
    }
}

// Ambil data produk untuk select
$produk_query = "SELECT * FROM produk ORDER BY NamaProduk";
$produk_result = mysqli_query($conn, $produk_query);
$produk_options = [];
while ($row = mysqli_fetch_assoc($produk_result)) {
    $produk_options[] = $row;
}
?>

<div class="uk-container uk-margin-top">
    <h2 class="uk-text-center uk-margin-bottom">Buat Penjualan Baru</h2>
    <div class="uk-card uk-card-default uk-box-shadow-small uk-margin-bottom">
        <div class="uk-card-body">
            <form method="POST" action="" class="uk-form-stacked" id="penjualanForm">
                <div class="uk-margin">
                    <label class="uk-form-label"><strong>Pelanggan:</strong></label>
                    <div class="uk-form-controls">
                        <select id="PelangganID" name="PelangganID" class="uk-select uk-width-1-1" required>
                            <option value="" selected disabled>Pilih Pelanggan</option>
                            <?php 
                            $result = mysqli_query($conn, "SELECT * FROM pelanggan");
                            while($d = mysqli_fetch_array($result)) {
                                ?>
                                <option value="<?php echo $d['PelangganID'] ?>"><?php echo $d['PelangganID'] ?> - <?php echo $d['NamaPelanggan'] ?></option>
                                <?php
                            }
                            ?>
                        </select>                
                    </div>
                </div>
                
                <div class="uk-margin">
                    <label class="uk-form-label"><strong>Produk:</strong></label>
                    <div class="uk-grid-small" uk-grid>
                        <div class="uk-width-1-2@s">
                            <select id="ProdukID" class="uk-select">
                                <option value="" selected disabled>Pilih Produk</option>
                                <?php foreach ($produk_options as $produk): ?>
                                    <option value="<?php echo $produk['ProdukID'] ?>" 
                                            data-harga="<?php echo $produk['Harga'] ?>" 
                                            data-nama="<?php echo $produk['NamaProduk'] ?>"
                                            data-stok="<?php echo $produk['Stok'] ?>">
                                        <?php echo $produk['NamaProduk'] ?> 
                                        (Rp <?php echo number_format($produk['Harga'], 0, ',', '.') ?>) 
                                        - Stok: <?php echo $produk['Stok'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="uk-width-1-4@s">
                            <input type="number" id="JumlahProduk" class="uk-input" min="1" value="1" required>
                        </div>
                        <div class="uk-width-1-4@s">
                            <button type="button" id="tambahProduk" class="uk-button uk-button-primary uk-width-1-1">Tambah</button>
                        </div>
                    </div>
                </div>
                
                <div class="uk-margin">
                    <table class="uk-table uk-table-divider uk-table-small" id="produkTable">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Stok Tersedia</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Produk akan ditambahkan di sini melalui JavaScript -->
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">Total</th>
                                <th id="totalHarga">Rp 0</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <div class="uk-text-center">
                    <button type="submit" class="uk-button uk-button-primary uk-box-shadow-small">Simpan Penjualan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    // Inisialisasi Select2
    $('#PelangganID, #ProdukID').select2();
    
    let produkList = [];
    let totalHarga = 0;
    let produkOptions = <?php echo json_encode($produk_options); ?>;
    
    // Fungsi untuk update dropdown produk
    function updateProdukDropdown() {
        const select = $('#ProdukID');
        select.empty();
        select.append('<option value="" selected disabled>Pilih Produk</option>');
        
        produkOptions.forEach(produk => {
            // Cek apakah produk sudah ada di list atau stok habis
            const inList = produkList.some(p => p.id === produk.ProdukID);
            if (!inList && produk.Stok > 0) {
                select.append(
                    `<option value="${produk.ProdukID}" 
                     data-harga="${produk.Harga}" 
                     data-nama="${produk.NamaProduk}"
                     data-stok="${produk.Stok}">
                        ${produk.NamaProduk} 
                        (Rp ${produk.Harga.toLocaleString('id-ID')}) 
                        - Stok: ${produk.Stok}
                    </option>`
                );
            }
        });
        
        select.trigger('change');
    }
    
    // Fungsi untuk menghitung ulang total dan update tampilan
    function hitungTotal() {
        totalHarga = 0;
        
        produkList.forEach((produk, index) => {
            // Hitung subtotal untuk setiap produk
            const subtotal = produk.harga * produk.jumlah;
            totalHarga += subtotal;
            
            // Update tampilan subtotal di tabel
            $(`#produkTable tbody tr:eq(${index}) td:nth-child(5)`).text('Rp ' + subtotal.toLocaleString('id-ID'));
            
            // Update hidden input untuk form submit
            $(`input[name="produk[${index}][JumlahProduk]"]`).val(produk.jumlah);
        });
        
        // Update total harga
        $('#totalHarga').text('Rp ' + totalHarga.toLocaleString('id-ID'));
    }
    
    // Tambah produk ke tabel
    $('#tambahProduk').click(function() {
        const ProdukID = $('#ProdukID').val();
        const NamaProduk = $('#ProdukID option:selected').data('nama');
        const Harga = parseInt($('#ProdukID option:selected').data('harga'));
        const Stok = parseInt($('#ProdukID option:selected').data('stok'));
        const JumlahProduk = parseInt($('#JumlahProduk').val());
        
        if (!ProdukID || JumlahProduk < 1) {
            alert('Silakan pilih produk dan masukkan jumlah yang valid');
            return;
        }
        
        if (JumlahProduk > Stok) {
            alert('Jumlah melebihi stok tersedia! Stok: ' + Stok);
            return;
        }
        
        // Cek apakah produk sudah ada di list
        const existingIndex = produkList.findIndex(p => p.id === ProdukID);
        if (existingIndex >= 0) {
            const newJumlah = produkList[existingIndex].jumlah + JumlahProduk;
            if (newJumlah > Stok) {
                alert('Total jumlah melebihi stok tersedia! Stok: ' + Stok);
                return;
            }
            produkList[existingIndex].jumlah = newJumlah;
        } else {
            produkList.push({
                id: ProdukID,
                nama: NamaProduk,
                harga: Harga,
                stok: Stok,
                jumlah: JumlahProduk
            });
        }
        
        // Update tabel dan dropdown
        updateProdukTable();
        updateProdukDropdown();
        
        // Reset form
        $('#JumlahProduk').val(1);
    });
    
    // Update tabel produk
    function updateProdukTable() {
        const tbody = $('#produkTable tbody');
        tbody.empty();
        
        produkList.forEach((produk, index) => {
            const subtotal = produk.harga * produk.jumlah;
            tbody.append(`
                <tr>
                    <td>${produk.nama}</td>
                    <td>Rp ${produk.harga.toLocaleString('id-ID')}</td>
                    <td>${produk.stok}</td>
                    <td>
                        <input type="number" class="uk-input uk-form-width-small jumlah-produk" 
                               min="1" max="${produk.stok}" value="${produk.jumlah}" 
                               data-index="${index}">
                    </td>
                    <td class="subtotal">Rp ${subtotal.toLocaleString('id-ID')}</td>
                    <td><button type="button" class="uk-button uk-button-danger uk-button-small hapusProduk" data-index="${index}">Hapus</button></td>
                    <input type="hidden" name="produk[${index}][ProdukID]" value="${produk.id}">
                    <input type="hidden" name="produk[${index}][JumlahProduk]" value="${produk.jumlah}">
                </tr>
            `);
        });
        
        hitungTotal();
    }
    
    // Hapus produk dari list
    $(document).on('click', '.hapusProduk', function() {
        const index = $(this).data('index');
        produkList.splice(index, 1);
        updateProdukTable();
        updateProdukDropdown();
    });
    
    // Update jumlah produk
    $(document).on('change', '.jumlah-produk', function() {
        const index = $(this).data('index');
        let newJumlah = parseInt($(this).val());
        const maxStok = parseInt($(this).attr('max'));
        
        // Validasi input
        if (isNaN(newJumlah) || newJumlah < 1) {
            newJumlah = 1;
            $(this).val(1);
        }
        
        if (newJumlah > maxStok) {
            alert('Jumlah melebihi stok tersedia! Stok: ' + maxStok);
            newJumlah = maxStok;
            $(this).val(maxStok);
        }
        
        // Update data produk
        produkList[index].jumlah = newJumlah;
        
        // Hitung ulang total
        hitungTotal();
    });
    
    // Validasi form sebelum submit
    $('#penjualanForm').submit(function() {
        if (produkList.length === 0) {
            alert('Silakan tambahkan minimal 1 produk');
            return false;
        }
        return true;
    });
    
    // Inisialisasi dropdown pertama kali
    updateProdukDropdown();
});
</script>