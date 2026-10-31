<body class="hold-transition sidebar-mini sidebar-collapse">
<div class="wrapper">
    <?php $this->load->view('partial/main/navbar'); ?>
    <?php $this->load->view('partial/main/sidebar'); ?>
    <div class="content-wrapper">
        <section class="content-header"><div class="container-fluid"><h1>User Management</h1></div></section>
        <section class="content"><div class="container-fluid">
            <?php if ($this->session->flashdata('success')): ?><div class="alert alert-success"><?= html_escape($this->session->flashdata('success')) ?></div><?php endif; ?>
            <?php if ($this->session->flashdata('gagal')): ?><div class="alert alert-danger"><?= html_escape($this->session->flashdata('gagal')) ?></div><?php endif; ?>
            <div class="card"><div class="card-header"><h3 class="card-title">Kelola nama, username, dan password user</h3></div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead><tr><th>Nama</th><th>Username</th><th>Departemen</th><th>Level</th><th>Ganti Data</th></tr></thead>
                        <tbody><?php foreach ($alluser as $u): ?>
                            <tr>
                                <td><?= html_escape($u->nama_user) ?></td>
                                <td><?= html_escape($u->username) ?></td>
                                <td><?= html_escape($u->departemen) ?></td>
                                <td><?= html_escape($u->akses_lv) ?></td>
                                <td><button class="btn btn-primary btn-sm btn-edit-user" data-id="<?= (int) $u->id ?>" data-username="<?= html_escape($u->username) ?>" data-nama="<?= html_escape($u->nama_user) ?>">Ubah</button></td>
                            </tr>
                        <?php endforeach; ?></tbody>
                    </table>
                </div>
            </div>
            <div class="modal fade" id="modalEditUser" tabindex="-1" role="dialog"><div class="modal-dialog" role="document"><div class="modal-content">
                <form id="formEditUser" method="post">
                    <div class="modal-header"><h5 class="modal-title">Ubah Data User</h5><button type="button" class="close" data-dismiss="modal">&times;</button></div>
                    <div class="modal-body">
                        <div class="form-group"><label>Nama</label><input class="form-control" id="editNamaUser" name="nama_user" required></div>
                        <div class="form-group"><label>Username</label><input class="form-control" id="editUsername" name="username" required></div>
                        <div class="form-group"><label>Password baru</label><input class="form-control" type="password" name="password" minlength="4" autocomplete="new-password" placeholder="Kosongkan jika tidak diubah"></div>
                    </div>
                    <div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button><button class="btn btn-primary" type="submit">Simpan</button></div>
                </form>
            </div></div></div>
        </div></section>
    </div>
    <?php $this->load->view('partial/main/footer'); ?>
</div>
<script>
    $(function () {
        $('.btn-edit-user').on('click', function () {
            var button = $(this);
            $('#editNamaUser').val(button.data('nama'));
            $('#editUsername').val(button.data('username'));
            $('#formEditUser').attr('action', '<?= base_url('updateUser') ?>/' + button.data('id'));
            $('#modalEditUser').modal('show');
        });
    });
</script>
