<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $NamaProduk = $_POST['NamaProduk'];
    $Harga = $_POST['Harga'];
    $Stok = $_POST['Stok'];

    if (!empty($NamaProduk) && !empty($Harga) && !empty($Stok)) {
        $sql = "INSERT INTO produk (NamaProduk, Harga, Stok) 
                VALUES ('$NamaProduk', '$Harga', '$Stok')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "<script>alert('Produk berhasil ditambahkan!');</script>";
            echo "<script>window.location.href = 'index.php?action=list-produk';</script>";
            exit();
        } else {
            echo "<script>alert('Woops! Terjadi kesalahan saat menambahkan produk.');</script>";
            echo "<script>window.location.href = 'index.php?action=list-produk';</script>";
        }
    } else {
        echo "<script>alert('Semua field harus diisi.');</script>";
        echo "<script>window.location.href = 'index.php?action=create-produk';</script>";
    }
}
?>




<div class="uk-container uk-margin-top">
    <h2 class="uk-text-center uk-margin-bottom">Buat Produk Baru</h2>
    <div class="uk-card uk-card-default uk-box-shadow-small uk-margin-bottom">
        <div class="uk-card-body">
    <form method="POST" action="" class="uk-form-stacked">
        <div class="uk-margin">
            <label for="name" class="uk-form-label"><strong>Nama Produk:</strong></label>
            <div class="uk-form-controls">
                <input id="name" type="text" name="NamaProduk" class="uk-input" required>
            </div>
        </div>
        <div class="uk-margin">
            <label for="price" class="uk-form-label"><strong>Harga:</strong></label>
            <div class="uk-form-controls">
                <input id="price" type="number" name="Harga" class="uk-input" step="0.01" required>
            </div>
        </div>
        <div class="uk-margin">
            <label for="stock" class="uk-form-label"><strong>Stok:</strong></label>
            <div class="uk-form-controls">
                <input id="stock" type="number" name="Stok" class="uk-input" required>
            </div>
        </div>
        <br>
        <div class="uk-text-center">
            <button type="submit" class="uk-button uk-button-primary uk-box-shadow-small">Create Product</button>
        </div>
    </form>
    </div>
    </div>
</div>
