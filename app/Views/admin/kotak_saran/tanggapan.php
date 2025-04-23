<?= $this->extend('layouts/adminlte') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Beri Tanggapan</h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Form Tanggapan</h3>
                    </div>
                    
                    <form action="<?= base_url('admin/kotak-saran/'.$saran['id'].'/tanggapi') ?>" method="POST">
                        <?= csrf_field() ?>
                        
                        <div class="box-body">
                            <div class="form-group">
                                <label for="isi_tanggapan">Isi Tanggapan</label>
                                <textarea name="isi_tanggapan" id="isi_tanggapan" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Kirim Tanggapan</button>
                            <a href="<?= base_url('admin/kotak-saran') ?>" class="btn btn-default">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Detail Saran</h3>
                    </div>
                    <div class="box-body">
                        <p><strong>Pengirim:</strong> <?= $saran['username'] ?></p>
                        <p><strong>Isi Saran:</strong></p>
                        <p><?= $saran['isi_saran'] ?></p>
                        <p><strong>Status:</strong> <?= $saran['status'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
