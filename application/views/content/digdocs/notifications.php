<?php defined("BASEPATH") or exit("No direct script access allowed"); ?>

<a class="archive-back" href="<?= html_escape(site_url('digdocs')) ?>">← Kembali ke arsip</a>
<h1 class="h2">Pengingat dokumen</h1>
<p class="text-muted">Pengingat yang belum dibaca untuk akun Anda. Jadwal menggunakan waktu Jakarta.</p>

<div class="card archive-card">
    <?php if (!$reminders): ?>
        <p class="p-4 mb-0 text-muted">Tidak ada pengingat baru.</p>
    <?php else: ?>
        <ul class="list-group list-group-flush">
            <?php foreach ($reminders as $reminder): ?>
                <?php $document = $reminder['document']; $status = $calendar->status($document, $today); ?>
                <li class="list-group-item d-flex flex-wrap justify-content-between align-items-center">
                    <div class="my-1 mr-2">
                        <a class="font-weight-bold archive-wrap" href="<?= html_escape(site_url('digdocs/detail/' . $document->id)) ?>"><?= html_escape($document->title) ?></a>
                        <div class="small text-muted">
                            <span class="archive-status archive-status-<?= html_escape($status) ?>"><?= html_escape($calendar::STATUSES[$status]) ?></span>
                            <span class="ml-1">Kedaluwarsa <?= html_escape($document->expires_on) ?> · Jadwal <?= html_escape($reminder['occurrence']['date']) ?></span>
                        </div>
                    </div>
                    <form method="post" action="<?= html_escape(site_url('digdocs/acknowledge/' . $document->id)) ?>" class="my-1">
                        <input type="hidden" name="digdocs_csrf" value="<?= html_escape($csrf) ?>">
                        <input type="hidden" name="occurrence" value="<?= html_escape($reminder['occurrence']['key']) ?>">
                        <button class="btn btn-sm btn-outline-secondary" type="submit">Tandai dibaca</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
