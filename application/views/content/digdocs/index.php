<?php defined("BASEPATH") or exit("No direct script access allowed"); ?>

<div class="d-flex flex-wrap justify-content-between align-items-start mb-3">
    <div class="mr-3">
        <p class="archive-eyebrow">Akses terbatas</p>
        <h1 class="h2">Arsip Dokumen Digital</h1>
        <p class="text-muted mb-2">Kelola dokumen dan pantau masa berlakunya.</p>
    </div>
    <div class="d-flex flex-wrap archive-actions">
        <a class="btn btn-outline-secondary" href="<?= html_escape(site_url('digdocs/import')) ?>">Impor file</a>
        <a class="btn btn-primary" href="<?= html_escape(site_url('digdocs/add')) ?>">Tambah dokumen</a>
    </div>
</div>

<?php if ($reminder_count > 0): ?>
    <div class="alert alert-warning d-flex flex-wrap align-items-center justify-content-between">
        <strong><?= (int) $reminder_count ?> pengingat belum dibaca</strong>
        <a class="alert-link" href="<?= html_escape(site_url('digdocs/notifications')) ?>">Buka pengingat</a>
    </div>
<?php endif; ?>

<form action="<?= html_escape(site_url('digdocs')) ?>" method="get" class="card archive-card mb-3">
    <div class="card-body pb-2">
        <div class="form-row align-items-end">
            <div class="form-group col-lg-4 col-md-6">
                <label for="q">Cari dokumen</label>
                <input id="q" name="q" class="form-control" maxlength="200" value="<?= html_escape($filters['q']) ?>" placeholder="Judul, nomor, atau deskripsi">
            </div>
            <div class="form-group col-lg-2 col-md-6">
                <label for="category">Kategori</label>
                <select id="category" name="category" class="form-control">
                    <option value="">Semua kategori</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= html_escape($category->category) ?>" <?= $filters['category'] === $category->category ? 'selected' : '' ?>>
                            <?= html_escape($category->category) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-lg-2 col-md-4">
                <label for="status">Status</label>
                <select id="status" name="status" class="form-control">
                    <option value="">Semua status</option>
                    <?php foreach ($calendar::STATUSES as $value => $label): ?>
                        <option value="<?= html_escape($value) ?>" <?= $filters['status'] === $value ? 'selected' : '' ?>><?= html_escape($label) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-lg-2 col-md-4 col-6">
                <label for="from">Kedaluwarsa dari</label>
                <input id="from" name="from" type="date" class="form-control" value="<?= html_escape($filters['from']) ?>">
            </div>
            <div class="form-group col-lg-2 col-md-4 col-6">
                <label for="to">Sampai</label>
                <input id="to" name="to" type="date" class="form-control" value="<?= html_escape($filters['to']) ?>">
            </div>
        </div>
        <div class="d-flex archive-actions pb-2">
            <button class="btn btn-primary btn-sm" type="submit">Terapkan filter</button>
            <a class="btn btn-outline-secondary btn-sm" href="<?= html_escape(site_url('digdocs')) ?>">Reset</a>
        </div>
    </div>
</form>

<div class="card archive-card">
    <?php if ($documents): ?>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th scope="col">Dokumen</th><th scope="col">Kategori</th><th scope="col">Kedaluwarsa</th><th scope="col">Status</th></tr></thead>
                <tbody>
                    <?php foreach ($documents as $document): ?>
                        <?php $status = $calendar->status($document, $today); ?>
                        <tr>
                            <td>
                                <a class="font-weight-bold" href="<?= html_escape(site_url('digdocs/detail/' . $document->id)) ?>"><?= html_escape($document->title) ?></a>
                                <?php if ($document->document_number !== null): ?>
                                    <small class="d-block text-muted"><?= html_escape($document->document_number) ?></small>
                                <?php endif; ?>
                            </td>
                            <td><?= html_escape($document->category) ?></td>
                            <td class="text-nowrap"><?= html_escape($document->expires_on ?? '—') ?></td>
                            <td><span class="archive-status archive-status-<?= html_escape($status) ?>"><?= html_escape($calendar::STATUSES[$status]) ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="p-4 mb-0 text-muted">Tidak ada dokumen yang cocok.</p>
    <?php endif; ?>
</div>

<?php if ($page > 1 || $more): ?>
    <nav class="d-flex flex-wrap align-items-center archive-actions" aria-label="Halaman daftar dokumen">
        <span class="small text-muted mr-2">Halaman <?= (int) $page ?></span>
        <?php if ($page > 1): ?>
            <a class="btn btn-sm btn-outline-secondary" href="<?= html_escape(site_url('digdocs') . '?' . http_build_query($filters + ['page' => $page - 1])) ?>">Sebelumnya</a>
        <?php endif; ?>
        <?php if ($more): ?>
            <a class="btn btn-sm btn-outline-secondary" href="<?= html_escape(site_url('digdocs') . '?' . http_build_query($filters + ['page' => $page + 1])) ?>">Selanjutnya</a>
        <?php endif; ?>
    </nav>
<?php endif; ?>
