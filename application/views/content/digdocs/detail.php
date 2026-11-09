<?php defined("BASEPATH") or exit("No direct script access allowed"); ?>

<?php
$status = $calendar->status($document, $today);
?>
<a class="archive-back" href="<?= html_escape(site_url('digdocs')) ?>">← Kembali ke arsip</a>
<div class="d-flex flex-wrap align-items-start justify-content-between mb-3">
    <div class="mr-3">
        <p class="archive-eyebrow"><?= html_escape($document->category) ?></p>
        <h1 class="h2 archive-wrap"><?= html_escape($document->title) ?></h1>
        <span class="archive-status archive-status-<?= html_escape($status) ?>"><?= html_escape($calendar::STATUSES[$status]) ?></span>
    </div>
    <a class="btn btn-outline-secondary mt-2" href="<?= html_escape(site_url('digdocs/edit/' . $document->id)) ?>">Edit dokumen</a>
</div>

<div class="row">
    <div class="col-lg-8">
        <section class="card archive-card">
            <div class="card-body">
                <h2 class="h5">Informasi dokumen</h2>
                <dl class="row mb-0">
                    <dt class="col-sm-5">Nomor dokumen</dt>
                    <dd class="col-sm-7 archive-wrap"><?= html_escape($document->document_number ?? '—') ?></dd>
                    <dt class="col-sm-5">Terbit atau mulai berlaku</dt>
                    <dd class="col-sm-7"><?= html_escape($document->issued_on ?? '—') ?></dd>
                    <dt class="col-sm-5">Kedaluwarsa</dt>
                    <dd class="col-sm-7"><?= html_escape($document->expires_on ?? '—') ?></dd>
                    <dt class="col-sm-5">Periode berulang</dt>
                    <dd class="col-sm-7"><?= html_escape($calendar::RECURRENCES[$document->recurrence]) ?></dd>
                    <?php if ($document->expires_on): ?>
                        <dt class="col-sm-5">Pengingat</dt>
                        <dd class="col-sm-7"><?= html_escape($calendar::FREQUENCIES[$document->reminder_frequency]) ?>, mulai <?= (int) $document->reminder_days ?> hari sebelum kedaluwarsa</dd>
                    <?php endif; ?>
                    <dt class="col-sm-5">Deskripsi</dt>
                    <dd class="col-sm-7 archive-description"><?= $document->description === null || $document->description === '' ? '—' : html_escape($document->description) ?></dd>
                </dl>
            </div>
        </section>

        <section class="card archive-card">
            <div class="card-body">
                <h2 class="h5">Lampiran</h2>
                <p class="archive-wrap"><?= html_escape($document->original_name) ?></p>
                <div class="d-flex flex-wrap archive-actions">
                    <?php if ($preview_kind): ?>
                        <button type="button" class="btn btn-primary" id="archive-preview" hidden
                            data-src="<?= html_escape(site_url('digdocs/preview/' . $document->id)) ?>"
                            data-kind="<?= html_escape($preview_kind) ?>" aria-haspopup="dialog"
                            aria-controls="archive-preview-dialog">Pratinjau</button>
                    <?php endif; ?>
                    <a class="btn btn-outline-primary" href="<?= html_escape(site_url('digdocs/download/' . $document->id)) ?>">Unduh lampiran</a>
                </div>
            </div>
        </section>
    </div>

    <div class="col-lg-4">
        <?php if ($next_expiry): ?>
            <section class="card archive-card">
                <div class="card-body">
                    <h2 class="h5">Konfirmasi perpanjangan</h2>
                    <p class="small text-muted">Tanggal yang disarankan mengikuti periode dokumen. Sesuaikan dengan perpanjangan yang telah disetujui.</p>
                    <form method="post" action="<?= html_escape(site_url('digdocs/renew/' . $document->id)) ?>"
                        data-confirm-title="Catat perpanjangan?" data-confirm-text="Tanggal kedaluwarsa baru akan disimpan ke riwayat." data-confirm-button="Catat">
                        <input type="hidden" name="digdocs_csrf" value="<?= html_escape($csrf) ?>">
                        <input type="hidden" name="version" value="<?= (int) $document->version ?>">
                        <div class="form-group">
                            <label for="next_expiry">Tanggal kedaluwarsa baru</label>
                            <input class="form-control" type="date" id="next_expiry" name="next_expiry" required
                                min="<?= html_escape($calendar->date($document->expires_on)->modify('+1 day')->format('Y-m-d')) ?>"
                                value="<?= html_escape($next_expiry->format('Y-m-d')) ?>">
                        </div>
                        <button class="btn btn-primary" type="submit">Catat perpanjangan</button>
                    </form>
                </div>
            </section>
        <?php endif; ?>

        <?php if ($history): ?>
            <section class="card archive-card">
                <div class="card-body">
                    <h2 class="h5">Riwayat perpanjangan</h2>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($history as $event): ?>
                            <li class="list-group-item px-0">
                                <strong><?= html_escape($event->previous_expiry) ?> → <?= html_escape($event->new_expiry) ?></strong>
                                <small class="d-block text-muted"><?= html_escape($event->created_at) ?> · Akun #<?= (int) $event->actor_id ?></small>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </section>
        <?php endif; ?>

        <section class="card archive-card">
            <div class="card-body">
                <h2 class="h5">Hapus dokumen</h2>
                <p class="small text-muted">Dokumen dan lampirannya akan dihapus dari arsip.</p>
                <form method="post" action="<?= html_escape(site_url('digdocs/delete/' . $document->id)) ?>"
                    data-confirm-title="Hapus dokumen?" data-confirm-text="Dokumen dan lampiran akan dihapus secara permanen." data-confirm-button="Hapus" data-danger="true">
                    <input type="hidden" name="digdocs_csrf" value="<?= html_escape($csrf) ?>">
                    <input type="hidden" name="version" value="<?= (int) $document->version ?>">
                    <button class="btn btn-outline-danger" type="submit">Hapus dokumen</button>
                </form>
            </div>
        </section>
    </div>
</div>

<?php if ($preview_kind): ?>
    <dialog id="archive-preview-dialog" class="archive-dialog" aria-labelledby="archive-preview-title">
        <div class="archive-dialog-header d-flex align-items-center justify-content-between archive-actions">
            <div class="archive-wrap">
                <h2 id="archive-preview-title" class="h5 mb-1">Pratinjau lampiran</h2>
                <div class="text-muted small"><?= html_escape($document->original_name) ?></div>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary" id="archive-preview-close" autofocus>Tutup</button>
        </div>
        <div class="archive-preview" id="archive-preview-content"></div>
    </dialog>
    <template id="archive-preview-template">
        <p class="archive-preview-status mb-2" role="status">Memuat pratinjau…</p>
        <?php if ($preview_kind === 'pdf'): ?>
            <div class="archive-pdf-pages d-flex flex-wrap align-items-center justify-content-center archive-actions mb-2" hidden>
                <button type="button" class="btn btn-sm btn-outline-secondary" data-page-step="-1" disabled>Sebelumnya</button>
                <span class="archive-pdf-page small" aria-live="polite"></span>
                <button type="button" class="btn btn-sm btn-outline-secondary" data-page-step="1" disabled>Selanjutnya</button>
            </div>
            <canvas role="img" aria-label="Halaman PDF" hidden></canvas>
        <?php else: ?>
            <div class="archive-preview-data"></div>
        <?php endif; ?>
    </template>
<?php endif; ?>
