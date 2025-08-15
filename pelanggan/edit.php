<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $PelangganID = $_POST['PelangganID'];
    $NamaPelanggan = $_POST['NamaPelanggan'];
    $Alamat = $_POST['Alamat'];
    $NomorTelepon = $_POST['NomorTelepon'];

    if (!empty($PelangganID) && !empty($NamaPelanggan)  && !empty($Alamat) && !empty($NomorTelepon)) {
        $sql = "UPDATE pelanggan 
                SET NamaPelanggan='$NamaPelanggan', Alamat='$Alamat', NomorTelepon='$NomorTelepon'
                WHERE PelangganID='$PelangganID'";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "<script>alert('Pelanggan berhasil diperbarui!');</script>";
            echo "<script>window.location.href = 'index.php?action=list-pelanggan';</script>";
            exit();
        } else {
            echo "<script>alert('Woops! Terjadi kesalahan saat memperbarui pelanggan.');</script>";
            echo "<script>window.location.href = 'index.php?action=list-pelanggan';</script>";
        }
    } else {
        echo "<script>alert('Semua field harus diisi.');</script>";
        echo "<script>window.location.href = 'index.php?action=edit-pelanggan&PelangganID=$PelangganID';</script>";
    }
}

$PelangganID = isset($_GET['PelangganID']) ? $_GET['PelangganID'] : null;

if (!empty($PelangganID)) {
    $sql = "SELECT * FROM pelanggan WHERE PelangganID = '$PelangganID'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $pelanggan = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Woops! Pelanggan tidak ditemukan.');</script>";
        echo "<script>window.location.href = 'index.php?action=list-pelanggan';</script>";
    }
} else {
    echo "<script>alert('ID pelanggan tidak ada.');</script>";
    echo "<script>window.location.href = 'index.php?action=list-pelanggan';</script>";
}
?>



<div class="uk-container uk-margin-top">
    <h2 class="uk-text-center uk-margin-bottom">Edit Pelanggan</h2>
    <div class="uk-card uk-card-default uk-box-shadow-small uk-margin-bottom">
        <div class="uk-card-body">
    <form method="POST" action="" class="uk-form-stacked">
        <input type="hidden" name="PelangganID" value="<?php echo $pelanggan['PelangganID']; ?>">
        <div class="uk-margin">
            <label for="name" class="uk-form-label"><strong>Nama Pelanggan:</strong></label>
            <div class="uk-form-controls">
                <input type="text" name="NamaPelanggan" value="<?php echo $pelanggan['NamaPelanggan']; ?>" class="uk-input" required>
            </div>
        </div>
        <div class="uk-margin">
            <label for="description" class="uk-form-label"><strong>Alamat:</strong></label>
            <div class="uk-form-controls">
                <textarea name="Alamat" class="uk-textarea" required><?php echo $pelanggan['Alamat']; ?></textarea>
            </div>
        </div>
        <div class="uk-margin">
            <label for="image_url" class="uk-form-label"><strong>NomorTelepon:</strong></label>
            <div class="uk-form-controls">
                <input type="text" name="NomorTelepon" value="<?php echo $pelanggan['NomorTelepon']; ?>" class="uk-input" required>
            </div>
        </div>
        <br>
        <div class="uk-text-center">
            <button type="submit" class="uk-button uk-button-primary uk-border-rounded uk-box-shadow-small">Update Pelanggan</button>
        </div>
    </form>
    </div>
    </div>
</div>
