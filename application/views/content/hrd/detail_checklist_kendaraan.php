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
                    <a href="<?= base_url('all_laporan_chelist_kendaraan') ?>" class="btn btn-secondary mb-3">Kembali ke Laporan</a>

                    <div class="card shadow mb-4">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0">Detail Checklist Kendaraan</h5>
                        </div>
                        <div class="card-body">

                            <div class="row mb-3">
                                <div class="col-md-3"><strong>Tanggal</strong><br><?= date('d-m-Y', strtotime($header->tanggal_check)) ?></div>
                                <div class="col-md-3"><strong>Driver</strong><br><?= $header->driver ?></div>
                                <div class="col-md-3"><strong>No Polisi</strong><br><?= $header->nopol ?></div>
                                <div class="col-md-3"><strong>No Lambung</strong><br><?= $header->no_lambung ?></div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-3"><strong>Kilometer</strong><br><?= number_format($header->kilometer) ?> KM</div>
                            </div>

                        </div>
                    </div>

                    <?php foreach ($detail as $kategori => $items) : ?>
                        <div class="card shadow mb-3">
                            <div class="card-header bg-primary text-white">
                                <strong><?= $kategori ?></strong>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-bordered table-sm mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Nama Part</th>
                                            <th width="150" style="text-align: center;">Kondisi</th>
                                            <th>Keterangan</th>
                                            <th>Evident</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($items as $row) : ?>
                                            <tr class="<?= $row->kondisi == 'TIDAK BAIK' ? 'table-danger' : '' ?>">
                                                <td s><?= $row->nama_part ?></td>
                                                <td>
                                                    <center>
                                                        <?php if ($row->kondisi == 'TIDAK BAIK') : ?>
                                                            <span class="badge badge-danger">TIDAK BAIK</span>
                                                        <?php else : ?>
                                                            <span class="badge badge-success">BAIK</span>
                                                        <?php endif ?>
                                                    </center>
                                                </td>
                                                <td><?= $row->keterangan ?: '-' ?></td>
                                                <td>
                                                    <?php if ($row->foto) : ?>
                                                        <a href="<?= base_url('uploads/checklist_kendaraan/' . $row->foto) ?>" target="_blank">
                                                            <img src="<?= base_url('uploads/checklist_kendaraan/' . $row->foto) ?>" class="img-thumbnail" style="max-width:80px">
                                                        </a>
                                                    <?php else : ?>
                                                        -
                                                    <?php endif ?>
                                                </td>

                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    <?php endforeach ?>

                    <div class="card shadow mb-3">
                        <div class="card-header bg-info text-white">
                            <strong>Foto Evident Kendaraan</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php if (!empty($foto)) : ?>
                                    <?php foreach ($foto as $f) : ?>
                                        <div class="col-md-3 mb-3">
                                            <a href="<?= base_url($f->path) ?>" target="_blank">
                                                <img src="<?= base_url($f->path) ?>" class="img-fluid img-thumbnail">
                                            </a>
                                        </div>
                                    <?php endforeach ?>
                                <?php else : ?>
                                    <div class="col-md-12 text-center text-muted">
                                        Tidak ada foto
                                    </div>
                                <?php endif ?>
                            </div>
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