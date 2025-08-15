<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $NamaPelanggan = $_POST['NamaPelanggan'];
    $Alamat = $_POST['Alamat'];
    $NomorTelepon = $_POST['NomorTelepon'];

    if (!empty($NamaPelanggan) && !empty($Alamat) && !empty($NomorTelepon)) {
        $sql = "INSERT INTO pelanggan (NamaPelanggan, Alamat, NomorTelepon) 
                VALUES ('$NamaPelanggan', '$Alamat', '$NomorTelepon')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "<script>alert('Pelanggan berhasil ditambahkan!');</script>";
            echo "<script>window.location.href = 'index.php?action=list-pelanggan';</script>";
            exit();
        } else {
            echo "<script>alert('Woops! Terjadi kesalahan saat menambahkan pelanggan.');</script>";
            echo "<script>window.location.href = 'index.php?action=list-pelanggan';</script>";
        }
    } else {
        echo "<script>alert('Semua field harus diisi.');</script>";
        echo "<script>window.location.href = 'index.php?action=create-pelanggan';</script>";
    }
}
?>




<div class="uk-container uk-margin-top">
    <h2 class="uk-text-center uk-margin-bottom">Buat Pelanggan Baru</h2>
    <div class="uk-card uk-card-default uk-box-shadow-small uk-margin-bottom">
        <div class="uk-card-body">
    <form method="POST" action="" class="uk-form-stacked">
        <div class="uk-margin">
            <label for="name" class="uk-form-label"><strong>Nama Pelanggan:</strong></label>
            <div class="uk-form-controls">
                <input type="text" name="NamaPelanggan" class="uk-input" required>
            </div>
        </div>
        <div class="uk-margin">
            <label for="description" class="uk-form-label"><strong>Alamat:</strong></label>
            <div class="uk-form-controls">
                <textarea name="Alamat" class="uk-textarea" required></textarea>
            </div>
        </div>
        <div class="uk-margin">
            <label for="image_url" class="uk-form-label"><strong>NomorTelepon:</strong></label>
            <div class="uk-form-controls">
                <input type="text" name="NomorTelepon" class="uk-input" required>
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
