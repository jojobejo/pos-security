<body class="hold-transition sidebar-mini sidebar-collapse">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="<?php echo base_url('assets/images/Karisma.png') ?>" alt="AdminLTELogo" height="150" width="300">
    </div>

    <?php $this->load->view('partial/main/navbar') ?>
    <?php $this->load->view('partial/main/sidebar') ?>
    <?php $this->load->view('content/hrd/modallapexpedisi') ?>

    <div class="modal fade" id="modalEditExpedisi">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4>Edit Laporan Expedisi</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <form id="formEditExpedisi">
            <div class="modal-body">
              <input type="hidden" name="id" id="edit_id">

              <div class="row">
                <div class="col-md-4">
                  <label>Tanggal</label>
                  <input type="date" name="tanggal" id="edit_tanggal" class="form-control" required>
                </div>
                <div class="col-md-4">
                  <label>Jam Masuk</label>
                  <input type="text" name="jammasuk" id="edit_jammasuk" class="form-control" required>
                </div>
                <div class="col-md-4">
                  <label>Jam Keluar</label>
                  <input type="text" name="jamkeluar" id="edit_jamkeluar" class="form-control" required>
                </div>
              </div>

              <div class="row mt-2">
                <div class="col-md-4">
                  <label>No Pol</label>
                  <input type="text" name="nopol" id="edit_nopol" class="form-control" required>
                </div>
                <div class="col-md-4">
                  <label>Nama Driver</label>
                  <input type="text" name="namadriver" id="edit_namadriver" class="form-control" required>
                </div>
                <div class="col-md-4">
                  <label>No Tlpn</label>
                  <input type="text" name="notlpndriver" id="edit_notlpndriver" class="form-control" required>
                </div>
              </div>

              <div class="row mt-2">
                <div class="col-md-6">
                  <label>Perusahaan Pengirim</label>
                  <input type="text" name="perusahaanpengirim" id="edit_perusahaanpengirim" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label>Nama Barang</label>
                  <input type="text" name="namabarang" id="edit_namabarang" class="form-control" required>
                </div>
              </div>

              <div class="row mt-2">
                <div class="col-md-6">
                  <label>Jumlah Barang</label>
                  <input type="text" name="jumlahbarang" id="edit_jumlahbarang" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label>Keterangan</label>
                  <input type="text" name="keterangan" id="edit_keterangan" class="form-control" required>
                </div>
              </div>

              <div class="row mt-2">
                <div class="col-md-6">
                  <label>Penerima Berkas</label>
                  <select name="penerima_berkas_id" id="edit_penerima_berkas_id" class="form-control" required>
                    <option value="">Pilih petugas Logistik</option>
                    <?php foreach ($penerima_berkas as $penerima) : ?>
                      <option value="<?= (int) $penerima->id ?>"><?= html_escape($penerima->nama_user) ?> (<?= html_escape($penerima->username) ?>)</option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-6">
                  <label>Inputer</label>
                  <input type="text" name="inputer" id="edit_inputer" class="form-control" maxlength="255" required>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalHapusExpedisi">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h4>Hapus Data</h4>
          </div>
          <div class="modal-body">
            <input type="hidden" id="hapus_id">
            <p>Data yang dihapus tidak bisa dikembalikan.</p>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger" id="btnHapusExpedisi">Hapus</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalKonfirmasiPenerimaan">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Konfirmasi Penerimaan Berkas</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <form id="formKonfirmasiPenerimaan">
            <div class="modal-body">
              <input type="hidden" name="id" id="terima_id">
              <p>Pastikan berkas fisik telah diterima sebelum melakukan konfirmasi.</p>
              <label>Catatan Penerimaan</label>
              <textarea class="form-control" name="catatan_penerimaan" maxlength="500" placeholder="Opsional"></textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-success">Konfirmasi Diterima</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalRiwayatPenerimaan">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Riwayat Penerimaan Berkas</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body" id="isiRiwayatPenerimaan"></div>
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
              <h3 class="card-title"><?= $is_logistik ? 'KONFIRMASI PENERIMAAN BERKAS EXPEDISI' : 'LAPORAN EXPEDISI' ?></h3>
            </div>
            <?php if ($is_hrd4) : ?>
              <div class="row">
                <div class="col-auto">
                  <button type="button" class="btn btn-primary m-2 ml-3" data-toggle="modal" data-target="#addexpedisi">
                    <i class="fas fa-pen"></i>
                    Input Laporan Baru
                  </button>
                </div>
                <div class="col-auto">
                  <a href="<?= base_url('export_file_laporan_expedisis') ?>" class="btn btn-success m-2">
                    <i class="fas fa-file"></i>
                    Export File Excel
                  </a>
                </div>
              </div>

            <?php endif; ?>
            <div class="card-body">
              <table id="tb_lap_expedisi" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Tanggal</th>
                    <th>Jam Keluar</th>
                    <th>Jam Masuk</th>
                    <th>No Pol</th>
                    <th>Nama Driver</th>
                    <th>No Tlpn Driver</th>
                    <th>Perusahaan Krm</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Keterangan</th>
                    <th>Penerima Berkas</th>
                    <th>Inputer</th>
                    <th>Status Berkas</th>
                    <th>Diterima Pada</th>
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
