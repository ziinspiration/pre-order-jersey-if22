<?php
session_start(); // Pastikan sesi dimulai

include '../assets/partials/head.php';
require_once '../functions/func.php';

$loginError = ''; // Inisialisasi pesan kesalahan

if (isset($_POST['submit'])) {
    $nrp = cleaner($_POST['nrp']);
    $password = cleaner($_POST['password']);

    $admin = query("SELECT * FROM admin WHERE nrp = '$nrp' LIMIT 1");

    if ($admin && $password === $admin[0]['password']) {
        $_SESSION['admin'] = $admin[0]; // Simpan informasi admin dalam sesi
        header('Location: ../admin/index'); // Alihkan ke halaman index
        exit();
    } else {
        $loginError = 'NRP atau Password salah. Silakan coba lagi.';
    }
}
?>
<style>
    .formulir {
        text-shadow: 2px 2px 2px black !important;
    }

    body {
        background-image: url(../assets/images/background2.jpg);
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
    <form method="post" class="formulir card p-5 mt-2 mb-2 bg-dark text-gold box-shadow rounded-3">
        <div class="header-form mb-5 d-flex justify-content-center align-items-center">
            <img width="15%" src="../assets/images/LOGO-FUTSAL-TEAM.png" class="me-2">
            <h2 class="ms-2">SELAMAT DATANG :) <br> SILAHKAN LOGIN TERLEBIH DAHULU</h2>
        </div>
        <div class="mb-3">
            <label for="nrp" class="form-label">NRP</label>
            <input type="text" class="form-control" id="nrp" name="nrp" required placeholder="Masukkan NRP anda">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required placeholder="Masukkan Password anda">
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" name="submit" class="btn btn-gold w-25">Kirim</button>
        </div>
        <p class="text-danger text-center mt-3"><?= $loginError; ?></p>
    </form>
</div>
<?php include '../assets/partials/foot.php'; ?>