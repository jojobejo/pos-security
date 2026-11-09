<?php defined("BASEPATH") or exit("No direct script access allowed"); ?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Arsip Dokumen Digital | Karisma</title>
    <link rel="icon" href="<?= html_escape(base_url('assets/images/Karisma.png')) ?>">
    <link rel="stylesheet" href="<?= html_escape(base_url('assets/dist/css/adminlte.min.css')) ?>">
    <link rel="stylesheet" href="<?= html_escape(base_url('assets/plugins/sweetalert2/sweetalert2.min.css')) ?>">
    <link rel="stylesheet" href="<?= html_escape(base_url('assets/digdocs/archive.css')) ?>">
</head>
<body>
    <header class="archive-header">
        <div class="container d-flex flex-wrap align-items-center justify-content-between py-2">
            <a class="archive-brand py-2" href="<?= html_escape(site_url('digdocs')) ?>">Karisma <span>/</span> Arsip Dokumen Digital</a>
            <nav class="d-flex flex-wrap" aria-label="Navigasi arsip">
                <a class="btn btn-sm btn-outline-light mr-2 my-1" href="<?= html_escape(site_url('digdocs/notifications')) ?>">Pengingat</a>
                <?php if ($this->session->userdata('username') === 'HRD2'): ?>
                    <a class="btn btn-sm btn-outline-light mr-2 my-1" href="<?= html_escape(site_url('hrd_lap_paket_pos')) ?>">Paket POS</a>
                <?php endif; ?>
                <a class="btn btn-sm btn-outline-light my-1" href="<?= html_escape(site_url('logout')) ?>">Keluar</a>
            </nav>
        </div>
    </header>
    <main class="container py-4">
        <?php if ($message): ?>
            <?php $level = $message['type'] === 'error' ? 'danger' : $message['type']; ?>
            <div class="alert alert-<?= html_escape($level) ?>" role="status"><?= html_escape($message['text']) ?></div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert"><?= html_escape($error) ?></div>
        <?php endif; ?>
        <?php $this->load->view('content/digdocs/' . $view); ?>
    </main>
    <script src="<?= html_escape(base_url('assets/plugins/jquery/jquery.min.js')) ?>"></script>
    <script src="<?= html_escape(base_url('assets/plugins/sweetalert2/sweetalert2.min.js')) ?>"></script>
    <script src="<?= html_escape(base_url('assets/digdocs/archive.js')) ?>"></script>
    <?php if ($view === 'detail' && $preview_kind): ?>
        <script type="module" src="<?= html_escape(base_url('assets/digdocs/archive-preview.mjs')) ?>"></script>
    <?php endif; ?>
</body>
</html>
