<?php if ($this->session->userdata('departemen') == 'KEUANGAN' || $this->session->userdata('departemen') == 'MIA' || $this->session->userdata('departemen') == 'HRD & GA') : ?>

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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">LAPORAN PENERIMAAN PAKET</h3>
                            </div>

                            <div class="card-body">

                                <table id="tb_penerimaan_pos" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Penerima</th>
                                            <th>Departement</th>
                                            <th>Keterangan Paket</th>
                                            <th>Tanggal Terima POS</th>
                                            <th>Tanggal Terima Penerima</th>
                                            <th>Jam Diterima POS</th>
                                            <th>Jam Konfirmasi</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody></tbody>
                                </table>
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
    <?php else : ?>

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
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">LAPORAN PENERIMAAN PAKET</h3>
                                </div>
                                <div class="row">
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-primary m-2 ml-3" data-toggle="modal" data-target="#modalInputPaket">
                                            <i class="fas fa-pen"></i>
                                            Input Laporan Paket
                                        </button>
                                    </div>

                                    <!-- <div class="col-auto">
                                <a href="<?= base_url('export_file_laporan_expedisis') ?>" class="btn btn-success m-2">
                                    <i class="fas fa-file"></i>
                                    Export File Excel
                                </a>
                            </div> -->
                                </div>

                                <div class="card-body">
                                    <table id="tb_penerimaan_pos" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Penerima</th>
                                                <th>Departement</th>
                                                <th>Keterangan Paket</th>
                                                <th>Tanggal Terima POS</th>
                                                <th>Tanggal Terima Penerima</th>
                                                <th>Jam Diterima POS</th>
                                                <th>Jam Konfirmasi</th>
                                                <th>Status</th>
                                                <th>Inputer</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>

                                        <tbody></tbody>
                                    </table>
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

        <?php endif; ?>