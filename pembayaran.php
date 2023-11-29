<?php
include 'assets/partials/head.php';
require_once 'functions/func.php';

$getpemain = query("SELECT * FROM pemain WHERE status_bayar = 'belum_bayar'");

if (isset($_POST['submit'])) {
    $id_pemain = $_POST['nama'];
    $nama_rekening = cleaner($_POST['nama_rekening']);
    $nomor_rekening = cleaner($_POST['nomor_rekening']);
    $status_bayar = $_POST['status_bayar'];
    $jumlah_bayar = cleaner($_POST['jumlah_bayar']);

    $upload_directory = "assets/bukti-transfer/";

    if (isset($_FILES["bukti_transfer"])) {
        $file = $_FILES["bukti_transfer"];

        if ($file["error"] == UPLOAD_ERR_OK) {
            $file_type = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
            if ($file_type === "jpg" || $file_type === "jpeg" || $file_type === "png" || $file_type === "gif") {
                $uploaded_file = $upload_directory . basename($file["name"]);

                if (move_uploaded_file($file["tmp_name"], $uploaded_file)) {
                    $conn = koneksi();

                    $sql = "UPDATE pemain SET nama_rekening = ?, nomor_rekening = ?, status_bayar = ?, jumlah_bayar = ?, bukti_transfer = ? WHERE id = ?";
                    $stmt = mysqli_prepare($conn, $sql);

                    if (!$stmt) {
                        die("Gagal menyiapkan pernyataan SQL: " . mysqli_error($conn));
                    }

                    mysqli_stmt_bind_param($stmt, "sssssi", $nama_rekening, $nomor_rekening, $status_bayar, $jumlah_bayar, $uploaded_file, $id_pemain);

                    if (mysqli_stmt_execute($stmt)) {
                        echo '<script>alert("Selamat pembayaran anda berhasil, harap tunggu konfirmasi dari admin dan lihat status anda pada halaman konfirmasi");</script>';
                    } else {
                        echo '<script>alert("Maaf pembayaran anda gagal silahkan coba lagi atau hubungi pihak terkait");</script>';
                    }

                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                } else {
                    echo '<script>alert("Gagal mengunggah file");</script>';
                }
            } else {
                echo '<script>alert("Hanya file gambar JPG, JPEG, PNG, dan GIF yang diperbolehkan");</script>';
            }
        } else {
            echo '<script>alert("Terjadi kesalahan saat mengunggah file");</script>';
        }
    } else {
        echo '<script>alert("File bukti transfer tidak ditemukan");</script>';
    }
}
?>
<style>
.formulir {
    text-shadow: 2px 2px 2px black !important;
}

body {
    background-image: url(assets/images/background2.jpg);
    font-family: Poppins;
}

.box-shadow {
    box-shadow: inset 0 0 8px black !important;
}

a.text-gold:hover {
    color: white !important;
}

@media screen and (max-width:600px) {
    .navigasi-a {
        flex-direction: column !important;
    }

    .navigasi-b {
        margin-bottom: 15px !important;
    }

    .navigasi {
        flex-direction: column-reverse !important;
        width: 50%;
    }

    .navigasi-a a {
        margin-bottom: 15px !important;
        margin-right: 0 !important;
    }

    .size-nopung {
        flex-direction: column !important;
    }

    .size {
        width: 100% !important;
        margin: 0 !important;
        margin-bottom: 10px !important;
    }

    .nomor_punggung {
        width: 100% !important;
        margin: 0 !important;
        margin-bottom: 15px !important;
    }

    .header-form {
        flex-direction: column !important;
        text-align: center !important;
    }

    .header-form img {
        width: 30% !important;
        margin-bottom: 20px !important;
    }

    .header-form h2 {
        font-size: 20px !important;
    }

    .data-diri h3 {
        margin-bottom: 20px !important;

    }

    .custom-jersey h3 {
        margin-bottom: 20px !important;

    }
}
</style>
<div class="container">

    <form method="post" class="formulir card p-5 mb-5 mt-5 bg-dark text-gold box-shadow rounded-3"
        enctype="multipart/form-data">
        <div class="header-form mb-5 d-flex justify-content-center align-items-center">
            <img width="15%" src="assets/images/LOGO-FUTSAL-TEAM.png" class="me-2">
            <h2 class="ms-2">FORMULIR PEMBAYARAN JERSEY FUTSAL <br> TEKNIK INFORMATIKA 2022</h2>
        </div>
        <div class="data-diri">
            <div class="mb-3">
                <div class="size w-50 me-2">
                    <label for="nama" class="form-label">Pilih Daftar Nama</label>
                    <select name="nama" id="nama" class="form-select form-control" required>
                        <option selected disabled>Pilih Daftar Nama Yang Ingin Membayar</option>
                        <?php foreach ($getpemain as $pemain) : ?>
                        <option value="<?= $pemain['id']; ?>"><?= $pemain['nama_lengkap']; ?> /
                            <?= $pemain['id_no_punggung']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="nama_rekening" class="form-label">Nama Rekening</label>
                <input type="text" class="form-control" id="nama_rekening" name="nama_rekening" required
                    placeholder="*Isi sesuai dengan nama rekening">
            </div>
            <div class="mb-3">
                <label for="nomor_rekening" class="form-label">Nomor Rekening</label>
                <input type="text" class="form-control" id="nomor_rekening" name="nomor_rekening" required
                    placeholder="*Isi sesuai dengan nomor rekening">
            </div>
            <div class="mb-3">
                <label for="status_bayar" class="form-label">Status Bayar</label>
                <select name="status_bayar" id="status_bayar" class="form-select form-control" required>
                    <option selected disabled>Pilih Status Pembayaran</option>
                    <option value="lunas">Lunas</option>
                    <option value="dp">DP</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="jumlah_bayar" class="form-label">Jumlah Pembayaran</label>
                <input type="text" class="form-control" id="jumlah_bayar" name="jumlah_bayar" required
                    placeholder="*Isi sesuai nominal pembayaran ( Misalnya Rp.100.000 )">
            </div>
            <div class="mb-5">
                <label for="bukti_transfer" class="form-label">Bukti transfer</label>
                <input type="file" class="form-control" id="bukti_transfer" name="bukti_transfer" required>
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" name="submit" class="btn btn-gold w-25">Kirim</button>
        </div>
    </form>
</div>
<?php include 'assets/partials/foot.php'; ?>