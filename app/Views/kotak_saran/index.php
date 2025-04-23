<?= $this->extend('layouts/adminlte') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?= $isAdmin ? 'Daftar Semua Saran' : 'Daftar Saran Anda' ?></h3>
                    <?php if (!$isAdmin): ?>
                    <div class="card-tools">
                        <a href="<?= base_url('/kotak-saran/create') ?>" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Kirim Saran Baru
                        </a>
                    </div>
                    <?php endif ?>
                </div>
                
                <div class="card-body">
                    <?php if (session()->getFlashdata('message')): ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('message') ?>
                        </div>
                    <?php endif ?>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <?php if ($isAdmin): ?>
                                <th>Pengirim</th>
                                <?php endif ?>
                                <th>Isi Saran</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th style="width: <?= $isAdmin ? '120px' : '40px' ?>">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($saran as $index => $item): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <?php if ($isAdmin): ?>
                                <td><?= $item->nama ?? 'Anonim' ?></td>
                                <?php endif ?>
                                <td><?= substr($item->isi_saran, 0, 100) ?>...</td>
                                <td>
                                    <span class="badge <?= $item->status === 'terbaca' ? 'bg-success' : 'bg-warning' ?>">
                                        <?= ucfirst($item->status) ?>
                                    </span>
                                </td>
                                <td><?= date('d M Y H:i', strtotime($item->created_at)) ?></td>
                                <td>
                                    <?php if ($isAdmin): ?>
                                    <a href="<?= base_url('/admin/kotak-saran/' . $item->id . '/update-status') ?>" class="btn btn-sm btn-success" title="Update Status">
                                        <i class="fas fa-check"></i>
                                    </a>
                                    <a href="<?= base_url('/admin/kotak-saran/' . $item->id . '/tanggapi') ?>" class="btn btn-sm btn-warning" title="Beri Tanggapan">
                                        <i class="fas fa-comment"></i>
                                    </a>
                                    <?php endif ?>
                                    <a href="<?= base_url('/kotak-saran/' . $item->id) ?>" class="btn btn-sm btn-info" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
