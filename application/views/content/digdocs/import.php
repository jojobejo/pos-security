<?php defined("BASEPATH") or exit("No direct script access allowed"); ?>

<a class="archive-back" href="<?= html_escape(site_url('digdocs')) ?>">← Kembali ke arsip</a>
<h1 class="h2">Impor file</h1>
<p class="text-muted">Setiap file menjadi satu dokumen. Judul diambil dari nama file. Atur metadata dan kedaluwarsa setelah impor.</p>
<form method="post" action="<?= html_escape(site_url('digdocs/import')) ?>" enctype="multipart/form-data" class="card archive-card">
    <div class="card-body">
        <input type="hidden" name="digdocs_csrf" value="<?= html_escape($csrf) ?>">
        <div class="form-group">
            <label for="category">Kategori bersama</label>
            <input class="form-control" id="category" name="category" maxlength="100" value="<?= html_escape($category ?? '') ?>" placeholder="Misalnya Langganan" required>
        </div>
        <div class="form-group">
            <label for="attachments">Pilih 1–10 file</label>
            <input class="form-control-file" id="attachments" type="file" name="attachments[]" accept=".pdf,.jpg,.jpeg,.png,.webp,.txt,.csv,.docx,.xlsx,.pptx" aria-describedby="import-help" multiple required>
            <small class="form-text text-muted" id="import-help">Maksimal 10 MB per file. Format PDF, JPEG, PNG, WebP, TXT, CSV, DOCX, XLSX, dan PPTX.</small>
        </div>
        <button class="btn btn-primary" type="submit">Impor dokumen</button>
    </div>
</form>
