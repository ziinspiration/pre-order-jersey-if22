<?php include 'assets/partials/head.php'; ?>
<style>
body {
    background-image: url(assets/images/background2.jpg);
    font-family: Poppins;
}

.card {
    width: 45%;
}

@media screen and (max-width:600px) {
    .card {
        width: 95%;
    }

    .ca {
        margin-bottom: 10px !important;
    }

    .atasan {
        flex-direction: column !important;
    }
}
</style>
<div class="container">
    <h1 class="text-gold text-center mt-5 bg-dark p-2 rounded">DESAIN JERSEY</h1>
    <h3 class="text-gold text-center mt-4 bg-dark p-2 rounded">Harga : <b>IDR 180K</b></h3>
    <div class="card-content">
        <div class="atasan d-flex justify-content-around mb-2">
            <div class="card ca p-3 bg-dark">
                <img src="assets/images/1.jpg" alt="">
            </div>
            <div class="card p-3 bg-dark">
                <img src="assets/images/2.jpg" alt="">
            </div>
        </div>
        <div class="card p-3 bg-dark m-auto mb-4">
            <img src="assets/images/3.jpg" alt="">
        </div>
    </div>
</div>
<?php include 'assets/partials/foot.php'; ?>