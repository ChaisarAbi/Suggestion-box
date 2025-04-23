<?= $this->extend('layouts/adminlte') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Saran</h3>
                    <div class="card-tools">
                        <a href="<?= base_url('/saran') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="post">
                        <div class="user-block">
                            <span class="username">
                                <a href="#">Saran Anda</a>
                            </span>
                            <span class="description">
                                Dikirim pada: <?= date('d M Y H:i', strtotime($saran['created_at'])) ?>
                            </span>
                        </div>
                        
                        <p><?= nl2br($saran['isi_saran']) ?></p>
                        <p>
                            Status: 
                            <span class="badge <?= $saran['status'] === 'terbaca' ? 'bg-success' : 'bg-warning' ?>">
                                <?= ucfirst($saran['status']) ?>
                            </span>
                        </p>
                    </div>

                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Tanggapan</h3>
                        </div>
                        
                        <div class="card-body">
                            <?php if (!empty($tanggapan)): ?>
                                <?php foreach ($tanggapan as $item): ?>
                                    <div class="post">
                                        <div class="user-block">
                                            <span class="username">
                                                <a href="#">Admin</a>
                                            </span>
                                            <span class="description">
                                                Dikirim pada: <?= date('d M Y H:i', strtotime($item->created_at)) ?>
                                            </span>
                                        </div>
                                        
                                        <p><?= nl2br($item->isi_tanggapan) ?></p>
                                    </div>
                                    <hr>
                                <?php endforeach ?>
                            <?php else: ?>
                                <p class="text-muted">Belum ada tanggapan</p>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
