<?php
session_start();

include '../assets/partials/head.php';
require_once '../functions/func.php';

if (!isset($_SESSION['admin'])) {
    header('Location: ../auth/login');
    exit();
}

$idPembeli = $_GET['id'];

$getdata = query("SELECT pemain.id AS idPemain, pemain.*, nomor_punggung.*, size.* 
                  FROM pemain 
                  JOIN nomor_punggung ON pemain.id_no_punggung = nomor_punggung.id 
                  JOIN size ON pemain.id_size = size.id 
                  WHERE pemain.status_bayar = 'belum_bayar' 
                  AND pemain.id = $idPembeli");

$i = 1;
?>
<?php
if (isset($_POST['submit'])) {
    $status_by_admin = 1;

    $conn = koneksi();

    $id_pemain = $_GET['id'];

    $sql = "UPDATE pemain SET status_by_admin = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Gagal menyiapkan pernyataan SQL: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "ii", $status_by_admin, $id_pemain);

    if (mysqli_stmt_execute($stmt)) {
        echo '<script>alert("Konfirmasi berhasil.");</script>';
    } else {
        echo '<script>alert("Gagal melakukan konfirmasi. Silakan coba lagi.");</script>';
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
<style>
    body {
        background-image: url(../assets/images/background2.jpg);
        font-family: Poppins;
    }

    @media screen and (max-width:600px) {
        img.bukti-tf {
            width: 100% !important;
        }

        .footdetail {
            flex-direction: column !important;
        }
    }
</style>
<div class="container">
    <h3 class="text-gold text-center mt-5 bg-dark p-2 rounded">DETAIL DATA PEMBELI</h3>
    <div class="table-responsive">
        <table class="table table-dark table-striped mb-4 table-hover">
            <thead>
                <tr class="text-center">
                    <th class="text-secondary" scope="col">Nama</th>
                    <th class="text-secondary" scope="col">Nameset</th>
                    <th class="text-secondary" scope="col">Nomor Punggung</th>
                    <th class="text-secondary" scope="col">Size</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($getdata as $data) : ?>
                    <tr class="text-center">
                        <td class="text-gold"><?= $data["nama_lengkap"]; ?></td>
                        <td class="text-gold"><?= $data["name_set"]; ?></td>
                        <td class="text-gold"><?= $data["nomor"]; ?></td>
                        <td class="text-gold"><?= $data["size"]; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <table class="table table-dark table-striped mb-4 table-hover">
            <thead>
                <tr class="text-center">
                    <th class="text-secondary" scope="col">Nama Rekening</th>
                    <th class="text-secondary" scope="col">Nomor Rekening</th>
                    <th class="text-secondary" scope="col">Status Pembayaran</th>
                    <th class="text-secondary" scope="col">Jumlah Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($getdata as $data) : ?>
                    <tr class="text-center">
                        <td class="text-gold"><?= $data["nama_rekening"]; ?></td>
                        <td class="text-gold"><?= $data["nomor_rekening"]; ?></td>
                        <td class="text-gold">
                            <?php
                            if ($data["status_bayar"] === "belum_bayar") {
                                echo "Belum Bayar";
                            } elseif ($data["status_bayar"] === "dp") {
                                echo "DP";
                            } elseif ($data["status_bayar"] === "lunas") {
                                echo "LUNAS";
                            } else {
                                echo "Status Tidak Diketahui";
                            }
                            ?>
                        </td>
                        <td class="text-gold"><?= $data["jumlah_bayar"]; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="footdetail d-flex mb-5">
        <img class="w-25 bukti-tf mb-5 bg-dark p-3 rounded" src="../<?= $data["bukti_transfer"]; ?>" alt="">
    </div>
    <div class="d-flex justify-content-end fixed-bottom me-3 mb-3">
        <?php if ($data["status_by_admin"] != 1) : ?>
            <form method="post" class="bg-dark px-4 py-3 rounded">
                <input type="hidden" name="status_by_admin" value="1">
                <button type="submit" name="submit" class="btn btn-primary">Konfirmasi</button>
            </form>
        <?php endif; ?>
    </div>
</div>
<?php include '../assets/partials/foot.php'; ?>