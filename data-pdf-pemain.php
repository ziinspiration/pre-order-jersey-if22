<?php include 'assets/partials/head.php';
require_once 'functions/func.php';

$getdata = query("SELECT * FROM pemain 
                  JOIN nomor_punggung ON pemain.id_no_punggung = nomor_punggung.id 
                  JOIN size ON pemain.id_size = size.id 
                  WHERE status_bayar = 'dp' OR status_bayar = 'lunas'");


$i = 1;
?>
<style>
body {
    background-color: white !important;
    color: black !important;
    font-family: Poppins;
}

@media print {
    .no-print {
        display: none !important;
    }

    .table-responsive {
        margin-top: 30px !important;
    }

}
</style>
<div class="container">
    <button class="btn btn-danger mt-5 ms-5 mb-5 no-print" onclick="window.print()"><i class="fa-solid fa-file-pdf"></i>
        Download</button>
    <div class="table-responsive">
        <table class="table table-secondary table-striped mb-4 table-hover">
            <thead>
                <tr class="text-center">
                    <th class="text-dark" scope="col">No</th>
                    <th class="text-dark" scope="col">Nama</th>
                    <th class="text-dark" scope="col">Nameset</th>
                    <th class="text-dark" scope="col">Nomor Punggung</th>
                    <th class="text-dark" scope="col">Size</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($getdata as $data) : ?>
                <tr class="text-center">
                    <td class="text-dark"><?= $i++; ?></td>
                    <td class="text-dark"><?= $data["nama_lengkap"]; ?></td>
                    <td class="text-dark"><?= $data["name_set"]; ?></td>
                    <td class="text-dark"><?= $data["nomor"]; ?></td>
                    <td class="text-dark"><?= $data["size"]; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include 'assets/partials/foot.php'; ?>