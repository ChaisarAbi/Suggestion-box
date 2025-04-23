<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Saran</h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Form Edit Saran</h3>
                    </div>

                    <form action="<?= base_url('/admin/kotak-saran/' . $saran->id . '/update') ?>" method="post">
                        <?= csrf_field() ?>
                        
                        <div class="box-body">
                            <div class="form-group">
                                <label>Isi Saran</label>
                                <?= form_textarea('isi_saran', old('isi_saran', $saran->isi_saran), [
                                    'class' => 'form-control',
                                    'rows' => 5,
                                    'placeholder' => 'Masukkan isi saran'
                                ]) ?>
                                <?php if ($validation->hasError('isi_saran')) : ?>
                                    <span class="help-block text-danger"><?= $validation->getError('isi_saran') ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <?= form_dropdown('status', [
                                    'terbaca' => 'Terbaca',
                                    'belum terbaca' => 'Belum Terbaca'
                                ], old('status', $saran->status), [
                                    'class' => 'form-control select2',
                                    'style' => 'width: 100%;'
                                ]) ?>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="<?= base_url('/admin/kotak-saran') ?>" class="btn btn-default">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
