<?= $this->extend('layouts/adminlte') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Dashboard Admin</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $total_users ?></h3>
                            <p>Total Pengguna</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="<?= base_url('/users') ?>" class="small-box-footer">
                            Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $total_saran ?></h3>
                            <p>Total Saran</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <a href="<?= base_url('/admin/kotak-saran') ?>" class="small-box-footer">
                            Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $saran_belum_terbaca ?></h3>
                            <p>Saran Belum Terbaca</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-eye-slash"></i>
                        </div>
                        <a href="<?= base_url('/admin/kotak-saran?status=belum_terbaca') ?>" class="small-box-footer">
                            Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= $saran_tanpa_tanggapan ?></h3>
                            <p>Saran Tanpa Tanggapan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-comment-slash"></i>
                        </div>
                        <a href="<?= base_url('/admin/kotak-saran?tanggapan=0') ?>" class="small-box-footer">
                            Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Statistik Saran Terbaru</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="saranChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Aktivitas Terbaru</h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <?php foreach ($aktivitas_terbaru as $aktivitas): ?>
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <span><?= $aktivitas['deskripsi'] ?></span>
                                        <small class="text-muted"><?= $aktivitas['waktu'] ?></small>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->section('scripts') ?>
<script>
$(function () {
    var ctx = document.getElementById('saranChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= json_encode($chart_labels) ?>,
            datasets: [{
                label: 'Jumlah Saran',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                data: <?= json_encode($chart_data) ?>
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>
