<style>
    .badge-kondisi input {
        display: none
    }

    .badge-kondisi label {
        cursor: pointer;
        padding: 6px 12px;
        border-radius: 20px;
    }
</style>

<body class="hold-transition sidebar-mini sidebar-collapse">

    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?php echo base_url('assets/images/Karisma.png') ?>" alt="AdminLTELogo" height="150" width="300">
        </div>

        <?php $this->load->view('partial/main/navbar') ?>
        <?php $this->load->view('partial/main/sidebar') ?>

        <?php $this->load->view('content/hrd/modal_paket_pos') ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <section class="content">
                <div class="container-fluid">
                    <a href="<?= base_url('all_laporan_chelist_kendaraan') ?>" class="btn btn-md btn-success mb-3"><i class="fas fa-file"></i> Laporan Checklist Kendaraan</a>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">CHECKLIST KENDARAAN</h3>
                        </div>

                        <div class="card-body">

                            <form method="post" action="<?= base_url('store_checklist_kendaraan') ?>" enctype="multipart/form-data">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Tanggal Check</label>
                                            <input type="date" name="tanggal_check" class="form-control" value="<?= date('Y-m-d') ?>" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Driver</label>
                                            <input type="text" name="driver" class="form-control" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label>No Polisi</label>
                                            <input type="text" name="nopol" class="form-control" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label>No Lambung</label>
                                            <input type="text" name="no_lambung" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <label>Kilometer</label>
                                            <input type="number" name="kilometer" class="form-control" required>
                                        </div>
                                        <div class="col-md-8">
                                            <label>Inputer</label>
                                            <input type="text" name="inputer" class="form-control" required>
                                        </div>
                                    </div>

                                    <hr>

                                    <?php foreach ($parts as $kategori => $items) : ?>
                                        <table class="table table-sm table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Nama Part</th>
                                                    <th width="180">Kondisi</th>
                                                    <th>Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($items as $i => $part) : ?>
                                                    <tr>
                                                        <td>
                                                            <?= $part ?>
                                                            <input type="hidden" name="part[<?= $kategori . $i ?>][nama_part]" value="<?= $part ?>">
                                                            <input type="hidden" name="part[<?= $kategori . $i ?>][kategori]" value="<?= $kategori ?>">

                                                        </td>

                                                        <td>
                                                            <select name="part[<?= $kategori . $i ?>][kondisi]" class="form-control form-control-sm">
                                                                <option value="BAIK">BAIK</option>
                                                                <option value="TIDAK BAIK">TIDAK BAIK</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="part[<?= $kategori . $i ?>][keterangan]" class="form-control form-control-sm">
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    <?php endforeach ?>

                                    <div class="card shadow mb-3 mt-3">
                                        <div class="card-header bg-info text-white">
                                            <strong>Foto Evident Kendaraan</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-md-12 mt-3">
                                                <label>Tambah Foto Kendaraan</label>
                                                <input type="file" name="foto[]" id="fotoInput" class="form-control" multiple accept="image/*">
                                            </div>
                                            <div class="row mt-3" id="previewFoto"></div>
                                        </div>
                                    </div>


                                </div>
                                <button class="btn btn-success btn-block">Simpan Checklist</button>
                            </form>

                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2022 <a href="https://kiu.co.id">PT.KARISMA INDOARGO UNIVERSAL</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <script>
        let selectedFiles = [];

        document.getElementById('fotoInput').addEventListener('change', function() {
            const preview = document.getElementById('previewFoto');
            preview.innerHTML = '';
            selectedFiles = Array.from(this.files);

            selectedFiles.forEach((file, index) => {
                if (!file.type.startsWith('image/')) return;

                const reader = new FileReader();
                reader.onload = function(e) {
                    const col = document.createElement('div');
                    col.className = 'col-md-3 mb-3';
                    col.id = 'preview-' + index;

                    col.innerHTML = `
                <div class="position-relative">
                    <img src="${e.target.result}" class="img-fluid img-thumbnail">
                    <button type="button"
                        class="btn btn-sm btn-danger position-absolute"
                        style="top:5px; right:5px;"
                        onclick="removePreview(${index})">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            `;
                    preview.appendChild(col);
                };
                reader.readAsDataURL(file);
            });
        });

        function removePreview(index) {
            selectedFiles.splice(index, 1);
            document.getElementById('preview-' + index).remove();
        }
    </script>