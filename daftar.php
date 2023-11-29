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
    <a class="mb-3 mt-3 btn btn-danger" href="data-pdf-pemain"><i class="fa-solid fa-file-pdf me-2"></i>Download PDF</a>
    <div class="table-responsive">
        <table class="table table-dark table-striped mb-4 table-hover">
            <thead>
                <tr class="text-center">
                    <th class="text-secondary" scope="col">No</th>
                    <th class="text-secondary" scope="col">Nama</th>
                    <th class="text-secondary" scope="col">Nameset</th>
                    <th class="text-secondary" scope="col">Nomor Punggung</th>
                    <th class="text-secondary" scope="col">Size</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($getdata as $data) : ?>
                    <tr class="text-center">
                        <td class="text-gold"><?= $i++; ?></td>
                        <td class="text-gold"><?= $data["nama_lengkap"]; ?></td>
                        <td class="text-gold"><?= $data["name_set"]; ?></td>
                        <td class="text-gold"><?= $data["nomor"]; ?></td>
                        <td class="text-gold"><?= $data["size"]; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include 'assets/partials/foot.php'; ?>