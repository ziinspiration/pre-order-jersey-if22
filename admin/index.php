<?php
session_start();

include '../assets/partials/head.php';
require_once '../functions/func.php';

if (!isset($_SESSION['admin'])) {
    header('Location: ../auth/login');
    exit();
}
?>

<style>
    body {
        background-image: url(../assets/images/background2.jpg);
        font-family: Poppins;
    }

    .fa-circle {
        font-size: 100px !important;
    }

    .card {
        width: 250px;
        height: 250px;
        border: 2px solid black;
    }

    .card:hover {
        width: 250px;
        height: 250px;
        box-shadow: 0 0 5px gold;
    }

    .card p {
        font-size: 25px !important;
    }

    a {
        text-decoration: none;
    }

    @media screen and (max-width:600px) {
        .container-content {
            flex-direction: column !important;

        }

        .card {
            margin: auto !important;
            margin-bottom: 20px !important;
        }
    }
</style>
<div class="container">
    <a href="../auth/logout" class="btn btn-danger mt-3">Logout</a>
    <div class="container-content d-flex justify-content-around mt-4">
        <a href="daftar-belum-bayar">
            <div class="card d-flex align-items-center justify-content-center bg-dark text-gold d-flex flex-column"><i class="fa-solid fa-circle text-danger"></i>
                <p>BELUM BAYAR</p>
            </div>
        </a>
        <a href="daftar-dp">
            <div class="card d-flex align-items-center justify-content-center bg-dark text-gold d-flex flex-column"><i class="fa-solid fa-circle text-warning"></i>
                <p>DP</p>
            </div>
        </a>
        <a href="daftar-lunas">
            <div class="card d-flex align-items-center justify-content-center bg-dark text-gold d-flex flex-column"><i class="fa-solid fa-circle text-success"></i>
                <p>LUNAS</p>
            </div>
        </a>
    </div>
</div>
<?php include '../assets/partials/foot.php'; ?>