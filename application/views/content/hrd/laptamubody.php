<body class="hold-transition sidebar-mini sidebar-collapse">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="<?php echo base_url('assets/images/Karisma.png') ?>" alt="AdminLTELogo" height="150" width="300">
    </div>

    <?php $this->load->view('partial/main/navbar') ?>
    <?php $this->load->view('partial/main/sidebar') ?>

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

        <!-- modal -->
        <div class="modal fade" id="modalEditTamu">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5>Edit Tamu</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <form action="<?= base_url('edit_lap_tamu_hrd') ?>" method="post" id="formEditTamu">
                <div class="modal-body">

                  <input type="hidden" name="id" id="edit_id">

                  <div class="form-group">
                    <label>Tanggal</label>
                    <input type="text" name="tanggal" id="edit_tanggal" class="form-control">
                  </div>

                  <div class="form-group">
                    <label>Nama Tamu</label>
                    <input type="text" name="nama" id="edit_nama" class="form-control">
                  </div>

                  <div class="form-group">
                    <label>Perusahaan</label>
                    <input type="text" name="perusahaan" id="edit_perusahaan" class="form-control">
                  </div>

                  <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="alamat" id="edit_alamat" class="form-control">
                  </div>

                  <div class="form-group">
                    <label>Jumlah Personil</label>
                    <input type="text" name="personil" id="edit_personil" class="form-control">
                  </div>

                  <div class="form-group">
                    <label>Tujuan</label>
                    <input type="text" name="tujuan" id="edit_tujuan" class="form-control">
                  </div>

                  <div class="form-group">
                    <label>Jam Masuk</label>
                    <input type="text" name="jammasuk" id="edit_jmmasuk" class="form-control">
                  </div>

                  <div class="form-group">
                    <label>Jam Keluar</label>
                    <input type="text" name="jamkeluar" id="edit_jmkeluar" class="form-control">
                  </div>

                  <div class="form-group">
                    <label>Keterangan</label>
                    <input type="text" name="keterangan" id="edit_keterangan" class="form-control">
                  </div>

                  <div class="form-group">
                    <label>Inputer</label>
                    <input type="text" name="inputer" id="edit_inputer" class="form-control">
                  </div>

                </div>

                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modalHapusTamu">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <h5>Hapus Data</h5>
              </div>
              <form action="<?= base_url('hapus_lap_tamu_hrd') ?>" method="post" id="modalHapusTamu">
                <div class="modal-body">
                  <input type="hidden" id="hapus_id" name="id_isi">
                  <p>Yakin ingin menghapus data ini?</p>
                </div>

                <div class="modal-footer">
                  <button class="btn btn-danger" id="btnHapus">Hapus</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="container-fluid">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">LAPORAN TAMU</h3>

              <div class="row">
                <div class="col-auto">
                  <a href="<?= base_url('export_data_tamu_all') ?>" class="btn btn-sm btn-success">
                    <i class="fas fa-file"></i>
                    Export File
                  </a>
                </div>
                <div class="col-auto">
                  <a href="<?= base_url('truncate_all_data_tamu') ?>" class="btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i>
                    Hapus Data Tamu
                  </a>
                </div>
              </div>

            </div>

            <div class="ml-2">
              <div class="card-body">
                <table id="tb_lap_distribusi_tamu" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Nama</th>
                      <th>Perusahaan</th>
                      <th>Alamat</th>
                      <th>Jumlah Personil</th>
                      <th>Tujuan</th>
                      <th>Jam Masuk</th>
                      <th>Jam Keluar</th>
                      <th>Keterangan</th>
                      <th>Nama Iputer</th>
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