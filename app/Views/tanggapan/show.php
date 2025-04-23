<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Detail Saran dan Tanggapan</h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Saran dari <?= esc($saran->username) ?></h3>
                    </div>
                    <div class="box-body">
                        <p><?= nl2br(esc($saran->isi_saran)) ?></p>
                        <small class="text-muted"><?= date('d M Y H:i', strtotime($saran->created_at)) ?></small>
                    </div>
                </div>

                <?php if (session()->get('role') === 'admin'): ?>
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Berikan Tanggapan</h3>
                    </div>
                    <div class="box-body">
                        <form action="/tanggapan/<?= $saran->id ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <textarea name="isi_tanggapan" class="form-control" rows="5" placeholder="Tulis tanggapan Anda..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim Tanggapan</button>
                        </form>
                    </div>
                </div>
                <?php endif; ?>

                <?php if (!empty($tanggapan)): ?>
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tanggapan</h3>
                    </div>
                    <div class="box-body">
                        <?php foreach ($tanggapan as $t): ?>
                        <div class="direct-chat-msg <?= $t->user_id === session()->get('user_id') ? 'right' : '' ?>">
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name pull-<?= $t->user_id === session()->get('user_id') ? 'right' : 'left' ?>">
                                    <?= esc($t->username) ?>
                                </span>
                                <span class="direct-chat-timestamp pull-<?= $t->user_id === session()->get('user_id') ? 'left' : 'right' ?>">
                                    <?= date('d M Y H:i', strtotime($t->created_at)) ?>
                                </span>
                            </div>
                            <div class="direct-chat-text">
                                <?= nl2br(esc($t->isi_tanggapan)) ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
