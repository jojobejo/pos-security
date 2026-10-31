<body class="hold-transition sidebar-mini sidebar-collapse">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="<?php echo base_url('assets/images/Karisma.png') ?>" alt="AdminLTELogo" height="150" width="300">
    </div>

    <?php $this->load->view('partial/main/navbar') ?>
    <?php $this->load->view('partial/main/sidebar') ?>
    <?php $this->load->view('content/hrd/modallapkaryawankm') ?>

    <div class="modal fade" id="modalEditKary">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5>Edit Karyawan Keluar Masuk</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <form id="formEditKary">
            <div class="modal-body">
              <input type="hidden" name="id" id="edit_id">

              <div class="row">
                <div class="col-md-4">
                  <label>Tanggal</label>
                  <input type="text" name="tanggal" id="edit_tanggal" class="form-control">
                </div>
                <div class="col-md-4">
                  <label>Nama</label>
                  <input type="text" name="nama" id="edit_nama" class="form-control">
                </div>
                <div class="col-md-4">
                  <label>Departemen</label>
                  <input type="text" name="departemen" id="edit_departemen" class="form-control">
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-md-4">
                  <label>Jam Keluar</label>
                  <input type="text" name="jamkeluar" id="edit_jamkeluar" class="form-control">
                </div>
                <div class="col-md-4">
                  <label>Jam Masuk</label>
                  <input type="text" name="jammasuk" id="edit_jammasuk" class="form-control">
                </div>
                <div class="col-md-4">
                  <label>No. Plat</label>
                  <input type="text" name="nopol" id="edit_nopol" class="form-control">
                </div>
              </div>
              <div class="mt-2">
                <label>Status</label>
                <input type="text" name="status" id="edit_status" class="form-control">
              </div>
              <div class="mt-2">
                <label>Keterangan</label>
                <textarea name="keterangan" id="edit_keterangan" class="form-control"></textarea>
              </div>
            </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalHapusKary">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h5>Hapus Data</h5>
          </div>
          <div class="modal-body">
            <input type="hidden" id="hapus_id">
            <p>Yakin ingin menghapus data ini?</p>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger" id="btnHapusKary">Hapus</button>
          </div>
        </div>
      </div>
    </div>


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
              <h3 class="card-title">LAPORAN KARYAWAN KELUAR MASUK</h3>
            </div>
            <div class="ml-2">
              <button type="button" class="btn btn-primary m-2 ml-3" data-toggle="modal" data-target="#addkary">
                <i class="fas fa-pen"></i>
                Input Laporan Baru
              </button>
              <a href="<?= base_url('ex_lap_kar') ?>" class="btn btn-success"><i class="fas fa-file"></i> Export Excel</a>
            </div>
            <div class="card-body">
              <table id="tb_lap_karyawan_masuk_keluar" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>Departement</th>
                    <th>Status</th>
                    <th>Jam Keluar</th>
                    <th>Jam Masuk</th>
                    <th>No. Plat</th>
                    <th>Keterangan</th>
                    <th>Keterangan</th>
                    <th>#</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
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