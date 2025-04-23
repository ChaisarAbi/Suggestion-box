<?= $this->extend('layouts/adminlte') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Kotak Saran</h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Pesan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($kotak_saran as $key => $item): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $item['username'] ?></td>
                                    <td>-</td>
                                    <td><?= $item['isi_saran'] ?></td>
                                    <td><?= $item['status'] ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/kotak-saran/'.$item['id'].'/tanggapan') ?>" class="btn btn-primary btn-sm">Tanggapi</a>
                                        <form action="<?= base_url('admin/kotak-saran/'.$item['id'].'/update-status') ?>" method="POST" style="display: inline;">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="PUT">
                                            <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Yakin ingin mengupdate status?')">Update Status</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
