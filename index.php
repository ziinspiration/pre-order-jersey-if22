<?php include 'assets/partials/head.php';
require_once 'functions/func.php';

$getsize = query("SELECT * FROM size");
$getnopung = query("SELECT * FROM nomor_punggung WHERE id NOT IN (SELECT DISTINCT id_no_punggung FROM pemain)");

?>
<?php
if (isset($_POST['submit'])) {
    $nama_lengkap = cleaner($_POST['nama_lengkap']);
    $nomor_whatsapp = cleaner($_POST['nomor_whatsapp']);
    $name_set = cleaner($_POST['name_set']);
    $id_size = $_POST['id_size'];
    $id_no_punggung = $_POST['id_no_punggung'];
    $status_bayar = "belum_bayar";
    $status_by_admin = $_POST['status_by_admin'];
    $conn = koneksi();

    $cek_nomor_punggung = query("SELECT * FROM pemain WHERE id_no_punggung = $id_no_punggung");

    if (!empty($cek_nomor_punggung)) {
        echo '<script>alert("Mohon Maaf, Nomor Punggung Yang Anda Pilih Sudah Digunakan, Silahkan Pilih Nomor Punggung Lain");</script>';
    } else {
        $sql = "INSERT INTO pemain (nama_lengkap, nomor_whatsapp, name_set, id_size, id_no_punggung, status_bayar, status_by_admin) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if (!$stmt) {
            die("Gagal menyiapkan pernyataan SQL: " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt, "sssiiss", $nama_lengkap, $nomor_whatsapp, $name_set, $id_size, $id_no_punggung, $status_bayar, $status_by_admin);

        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("Selamat, Pendaftaran PRE-ORDER JERSEY FUTSAL IF22 Anda Berhasil");</script>';
        } else {
            echo '<script>alert("Mohon Maaf, Data Gagal Terkirim, Silahkan Coba Lagi Atau Hubungi Pihak Terkait");</script>';
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn);
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

        .nav-a-bottom {
            flex-direction: column !important;
        }

        .nav-a-top {
            flex-direction: column !important;
        }
    }
</style>
<div class="container">

    <div class="header mb-5 mt-3">
        <div class="navigasi d-flex justify-content-between">
            <div class="flex-start d-flex flex-column navigasi-a bg-dark px-3 py-2 rounded box-shadow">
                <div class="nav-a-top mb-2 d-flex">
                    <a class="me-4 text-gold" href="desain"><i class="fa-solid fa-shirt me-2"></i>Lihat Desain</a>
                    <a class="me-4 text-gold" href="size-chart"><i class="fa-solid fa-table-list me-2"></i></i>Size
                        Chart</a>
                    <a class="me-4 text-gold" href="daftar"><i class="fa-solid fa-table me-2"></i>Daftar Pembeli</a>
                </div>
                <div class="nav-a-bottom d-flex">
                    <a class="me-4 text-gold" href="pembayaran"><i class="fa-solid fa-sack-dollar me-2"></i>Pembayaran</a>
                    <a class="me-4 text-gold" href="konfirmasi-pembayaran"><i class="fa-solid fa-check me-2"></i>Status
                        Pembayaran / Pelunasan</a>
                </div>
            </div>
            <div class="flex-end navigasi-b bg-dark px-3 py-2 rounded box-shadow">
                <a class="text-gold text-decoration-none" href="admin/index"><i class="fa-solid fa-lock me-2"></i>Admind</a>
            </div>
        </div>
    </div>

    <form method="post" class="formulir card p-5 mb-5 bg-dark text-gold box-shadow rounded-3">
        <div class="header-form mb-5 d-flex justify-content-center align-items-center">
            <img width="15%" src="assets/images/LOGO-FUTSAL-TEAM.png" class="me-2">
            <h2 class="ms-2">FORMULIR PRE-ORDER JERSEY FUTSAL <br> TEKNIK INFORMATIKA 2022</h2>
        </div>
        <div class="data-diri">
            <h3 class="text-center">DATA DIRI</h3>
            <div class="mb-3">
                <input type="hidden" name="status_bayar" value="belum_bayar">
                <input type="hidden" name="status_by_admin" value="0">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required placeholder="*Isi sesuai dengan nama lengkap anda">
            </div>
            <div class="mb-5">
                <label for="nomor_whatsapp" class="form-label">Nomor WA</label>
                <input type="text" class="form-control" id="nomor_whatsapp" name="nomor_whatsapp" required placeholder="*Isi dengan nomor whatsapp aktif">
            </div>
        </div>

        <div class="custom-jersey">
            <h3 class="text-center">JERSEY SETTING</h3>
            <div class="mb-3">
                <label for="name_set" class="form-label">Nameset</label>
                <input type="text" class="form-control" id="name_set" name="name_set" required placeholder="*Isi sesuai dengan nama yang ingin anda di jersey ( Perhatikan Penggunaan ''A / a / . /,'' )">
            </div>
            <div class="mb-3 size-nopung d-flex justify-content-around">
                <div class="size w-50 me-2">
                    <label for="id_size" class="form-label">Size</label>
                    <select name="id_size" id="id_size" class="form-select form-control" required>
                        <option selected disabled>Pilih Size Anda</option>
                        <?php foreach ($getsize as $size) : ?>
                            <option value="<?= $size['id']; ?>"><?= $size['size']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="nomor_punggung w-50 ms-2">
                    <label for="id_no_punggung" class="form-label">Nomor Punggung</label>
                    <select name="id_no_punggung" id="id_no_punggung" class="form-select form-control" required>
                        <option selected disabled>Pilih Nomor Punggung</option>
                        <?php foreach ($getnopung as $nopung) : ?>
                            <option value="<?= $nopung['id']; ?>"><?= $nopung['nomor']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" name="submit" class="btn btn-gold w-25">Kirim</button>
        </div>
    </form>
</div>
<?php include 'assets/partials/foot.php'; ?>