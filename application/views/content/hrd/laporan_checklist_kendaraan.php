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
                    <a href="<?= base_url('hrd_chelklist_kendaraan') ?>" class="btn btn-md btn-primary mb-3"><i class="fa fa-caret-square-left"></i> FORM INPUT</a>
                    <a href="<?= base_url('export_data_checklist_kendaraan') ?>" class="btn btn-md btn-success mb-3 ml-3"><i class="fa fa-file"></i> Export Data Laporan</a>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">LAPORAN CHECKLIST KENDARAAN</h3>
                        </div>

                        <div class="card-body">
                            <table id="checklist_kendaraan" class="table table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Driver</th>
                                        <th>No Polisi</th>
                                        <th>No Lambung</th>
                                        <th>Kilometer</th>
                                        <th>Inputer</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
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

    <script>
        $(function() {
            $('#checklist_kendaraan').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "<?= base_url('ajax_checklist_kendaraan') ?>",
                    type: "POST"
                },
                order: [],
                columnDefs: [{
                    targets: [0, 7],
                    orderable: false
                }]
            });
        });
    </script>