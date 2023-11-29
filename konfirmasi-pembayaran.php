<?php include 'assets/partials/head.php';
require_once 'functions/func.php';

$getdata = query("SELECT * FROM pemain JOIN nomor_punggung ON pemain.id_no_punggung = nomor_punggung.id JOIN size ON pemain.id_size = size.id");
$i = 1;
?>
<style>
    body {
        background-image: url(assets/images/background2.jpg);
        font-family: Poppins;
    }

    @media screen and (max-width:600px) {}
</style>
<div class="container">
    <h3 class="text-gold text-center mt-5 bg-dark p-2 rounded">DAFTAR PRE-ORDER JERSEY</h3>
    <div class="table-responsive">
        <table class="table table-dark table-striped mb-4 table-hover">
            <thead>
                <tr class="text-center">
                    <th class="text-secondary" scope="col">No</th>
                    <th class="text-secondary" scope="col">Nama</th>
                    <th class="text-secondary" scope="col">Status Pembayaran</th>
                    <th class="text-secondary" scope="col">Terkonfirmasi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($getdata as $data) : ?>
                    <tr class="text-center">
                        <td class="text-gold"><?= $i++; ?></td>
                        <td class="text-gold"><?= $data["nama_lengkap"]; ?></td>
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
                        <td class="text-gold">
                            <?php
                            if ($data["status_by_admin"] == 1) {
                                echo '<i class="fa-solid fa-check text-success"></i>';
                            } else {
                                echo '<i class="fa-solid fa-hourglass-start text-warning"></i>';
                            }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p class="text-gold bg-dark p-2 rounded">Jika status anda DP, dan ingin melakukan pelunasan <a href="pelunasan">klik disini</a>
        </p>
    </div>
</div>
<?php include 'assets/partials/foot.php'; ?>