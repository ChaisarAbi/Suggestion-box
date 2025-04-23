<?= $this->extend('layouts/adminlte') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Kotak Saran</h3>
                </div>
                
                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <p><?= $error ?></p>
                        <?php endforeach ?>
                    </div>
                <?php endif ?>

                <?php if (session()->getFlashdata('message')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('message') ?>
                    </div>
                <?php endif ?>

                <form action="<?= base_url('/kotak-saran/store') ?>" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="isi_saran">Isi Saran</label>
                            <textarea name="isi_saran" id="isi_saran" class="form-control" rows="5" placeholder="Masukkan saran Anda..."><?= old('isi_saran') ?></textarea>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Kirim Saran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
