<?= $this->extend('layouts/adminlte') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1><?= $title ?></h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Informasi User</h3>
                    </div>
                    <div class="card-body">
                        <dl>
                            <dt>Username</dt>
                            <dd><?= esc($user['username']) ?></dd>
                            <dt>Email</dt>
                            <dd><?= esc($user['email']) ?></dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Saran</h3>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($user['saran'])): ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Isi Saran</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($user['saran'] as $i => $saran): ?>
                                    <tr>
                                        <td><?= $i + 1 ?></td>
                                        <td><?= esc($saran['isi_saran']) ?></td>
                                        <td>
                                            <span class="badge <?= $saran['status'] === 'terbaca' ? 'bg-success' : 'bg-warning' ?>">
                                                <?= ucfirst($saran['status']) ?>
                                            </span>
                                        </td>
                                        <td><?= date('d M Y H:i', strtotime($saran['created_at'])) ?></td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p>User ini belum membuat saran.</p>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
