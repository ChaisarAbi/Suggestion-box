<?= $this->extend('layouts/adminlte') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard Pengguna
            <small>Kotak Saran</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-envelope-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Saran</span>
                        <span class="info-box-number"><?= $total_saran ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="fa fa-check"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Saran Terbaca</span>
                        <span class="info-box-number"><?= $saran_terbaca ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Statistik Saran 7 Hari Terakhir</h3>
                    </div>
                    <div class="box-body">
                        <canvas id="saranChart" style="height: 250px;"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Aktivitas Terbaru</h3>
                    </div>
                    <div class="box-body">
                        <ul class="timeline">
                            <?php foreach ($aktivitas_terbaru as $aktivitas): ?>
                            <li>
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> <?= $aktivitas['waktu'] ?></span>
                                    <h3 class="timeline-header"><?= $aktivitas['deskripsi'] ?></h3>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
