<?php defined("BASEPATH") or exit("No direct script access allowed"); ?>

<a class="archive-back" href="<?= html_escape(site_url($document ? 'digdocs/detail/' . $document->id : 'digdocs')) ?>">← Kembali</a>
<h1 class="h2 mb-3"><?= $document ? 'Edit dokumen' : 'Tambah dokumen' ?></h1>
<form method="post" action="<?= html_escape(site_url($document ? 'digdocs/save/' . $document->id : 'digdocs/save')) ?>" enctype="multipart/form-data" class="card archive-card">
    <div class="card-body">
        <input type="hidden" name="digdocs_csrf" value="<?= html_escape($csrf) ?>">
        <?php if ($document): ?>
            <input type="hidden" name="version" value="<?= (int) $document->version ?>">
        <?php endif; ?>

        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="title">Judul</label>
                <input class="form-control" id="title" name="title" maxlength="200" value="<?= html_escape($values['title'] ?? '') ?>" required>
            </div>
            <div class="form-group col-md-4">
                <label for="category">Kategori</label>
                <input class="form-control" id="category" name="category" maxlength="100" value="<?= html_escape($values['category'] ?? '') ?>" placeholder="Misalnya Legal" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="document_number">Nomor dokumen</label>
                <input class="form-control" id="document_number" name="document_number" maxlength="100" value="<?= html_escape($values['document_number'] ?? '') ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="issued_on">Terbit atau mulai berlaku</label>
                <input class="form-control" id="issued_on" name="issued_on" type="date" value="<?= html_escape($values['issued_on'] ?? '') ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="expires_on">Kedaluwarsa</label>
                <input class="form-control" id="expires_on" name="expires_on" type="date" value="<?= html_escape($values['expires_on'] ?? '') ?>" aria-describedby="expiry-help">
                <small class="form-text text-muted" id="expiry-help">Kosongkan untuk dokumen tanpa kedaluwarsa.</small>
            </div>
        </div>
        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="3" maxlength="5000"><?= html_escape($values['description'] ?? '') ?></textarea>
        </div>

        <fieldset class="archive-settings mb-3">
            <legend class="h6">Periode dan pengingat</legend>
            <p class="small text-muted">Pengaturan ini berlaku untuk dokumen yang memiliki tanggal kedaluwarsa.</p>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="recurrence">Periode berulang</label>
                    <select id="recurrence" name="recurrence" class="form-control">
                        <?php foreach ($calendar::RECURRENCES as $value => $label): ?>
                            <option value="<?= html_escape($value) ?>" <?= ($values['recurrence'] ?? 'none') === $value ? 'selected' : '' ?>><?= html_escape($label) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="reminder_days">Mulai pengingat (hari sebelum)</label>
                    <input class="form-control" id="reminder_days" name="reminder_days" type="number" min="0" max="3650" value="<?= html_escape($values['reminder_days'] ?? '30') ?>" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="reminder_frequency">Frekuensi pengingat</label>
                    <select id="reminder_frequency" name="reminder_frequency" class="form-control">
                        <?php foreach ($calendar::FREQUENCIES as $value => $label): ?>
                            <option value="<?= html_escape($value) ?>" <?= ($values['reminder_frequency'] ?? 'daily') === $value ? 'selected' : '' ?>><?= html_escape($label) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </fieldset>

        <div class="form-group">
            <label for="attachment"><?= $document ? 'Ganti lampiran (opsional)' : 'Lampiran' ?></label>
            <?php if ($document): ?>
                <p class="small text-muted mb-1">Lampiran saat ini: <?= html_escape($document->original_name) ?></p>
            <?php endif; ?>
            <input class="form-control-file" id="attachment" type="file" name="attachment" accept=".pdf,.jpg,.jpeg,.png,.webp,.txt,.csv,.docx,.xlsx,.pptx" aria-describedby="file-help" <?= $document ? '' : 'required' ?>>
            <small class="form-text text-muted" id="file-help">Maksimal 10 MB. Format yang didukung PDF, JPEG, PNG, WebP, TXT, CSV, DOCX, XLSX, dan PPTX.</small>
        </div>
        <button class="btn btn-primary" type="submit">Simpan dokumen</button>
    </div>
</form>
