<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ProdukID = $_POST['ProdukID'];
    $NamaProduk = $_POST['NamaProduk'];
    $Harga = $_POST['Harga'];
    $Stok = $_POST['Stok'];

    if (!empty($ProdukID) && !empty($NamaProduk) && !empty($Harga) && !empty($Stok)) {
        $sql = "UPDATE produk 
               SET NamaProduk='$NamaProduk', Harga='$Harga', Stok='$Stok'
               WHERE ProdukID='$ProdukID'";
               
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
            echo "<script>alert('Produk berhasil diperbarui!');</script>";
            echo "<script>window.location.href = 'index.php?action=list-produk';</script>";
            exit();
        } else {
            echo "<script>alert('Woops! Terjadi kesalahan saat memperbarui produk.');</script>";
            echo "<script>window.location.href = 'index.php?action=list-produk';</script>";
        }
    } else {
        echo "<script>alert('Semua field harus diisi.');</script>";
        echo "<script>window.location.href = 'index.php?action=edit-produk&ProdukID=$ProdukID';</script>";
    }
}

$ProdukID = isset($_GET['ProdukID']) ? $_GET['ProdukID'] : null;

if (!empty($ProdukID)) {
    $sql = "SELECT * FROM produk WHERE ProdukID = '$ProdukID'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $produk = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Woops! Produk tidak ditemukan.');</script>";
        echo "<script>window.location.href = 'index.php?action=list-produk';</script>";
    }
} else {
    echo "<script>alert('Id produk tidak ada.');</script>";
    echo "<script>window.location.href = 'index.php?action=list-produk';</script>";
}
?>

<div class="uk-container uk-margin-top">
    <h2 class="uk-text-center uk-margin-bottom">Edit Produk</h2>
    <div class="uk-card uk-card-default uk-box-shadow-small uk-margin-bottom">
        <div class="uk-card-body">
            <form method="POST" action="" class="uk-form-stacked">
                <input type="hidden" name="ProdukID" value="<?php echo $produk['ProdukID']; ?>">
                <div class="uk-margin">
                    <label for="NamaProduk" class="uk-form-label"><strong>Nama:</strong></label>
                    <div class="uk-form-controls">
                        <input id="NamaProduk" type="text" name="NamaProduk" value="<?php echo $produk['NamaProduk']; ?>" class="uk-input" required>
                    </div>
                </div>
                <div class="uk-margin">
                    <label for="Harga" class="uk-form-label"><strong>Harga:</strong></label>
                    <div class="uk-form-controls">
                        <input id="Harga" type="number" name="Harga" value="<?php echo $produk['Harga']; ?>" class="uk-input" step="0.01" required>
                    </div>
                </div>
                <div class="uk-margin">
                    <label for="Stok" class="uk-form-label"><strong>Stok:</strong></label>
                    <div class="uk-form-controls">
                        <input id="Stok" type="number" name="Stok" value="<?php echo $produk['Stok']; ?>" class="uk-input" required>
                    </div>
                </div>
                <br>
                <div class="uk-text-center">
                    <button type="submit" class="uk-button uk-button-primary uk-border-rounded uk-box-shadow-small">Update Produk</button>
                </div>
            </form>
        </div>
    </div>
</div>