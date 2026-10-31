<body class="hold-transition sidebar-mini sidebar-collapse">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="<?php echo base_url('assets/images/Karisma.png') ?>" alt="AdminLTELogo" height="150" width="300">
    </div>

    <?php $this->load->view('partial/main/navbar') ?>
    <?php $this->load->view('partial/main/sidebar') ?>
    <?php $this->load->view('content/hrd/modallapissue') ?>


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
              <h3 class="card-title">LAPORAN ISSUE</h3>
            </div>
            <div class="ml-2">
              <button type="button" class="btn btn-primary m-2 ml-3" data-toggle="modal" data-target="#addissue">
                <i class="fas fa-pen"></i>
                Input Laporan Baru
              </button>
              <a href="<?= base_url('export_laporan_issue') ?>" class="btn btn-success"><i class="fas fa-file"></i> Export Excel</a>
            </div>
            <div class="card-body">
              <table id="tb_lap_distribusi" class="table table-bordered table-striped">
                <colgroup>
                  <col style="display:none">
                  <col>
                  <col>
                  <col>
                  <col>
                  <col style="width:10%">
                  <col>
                </colgroup>

                <thead>
                  <tr>
                    <th hidden>ID</th>
                    <th>Tanggal</th>
                    <th>Des Issue</th>
                    <th>Lokasi</th>
                    <th>Penemu Issue</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">#</th>
                  </tr>
                </thead>

                <tbody>
                  <?php foreach ($laporan as $l) : ?>
                    <tr>
                      <td hidden><?= $l->id ?></td>
                      <td><?= $l->tanggal ?></td>
                      <td><?= $l->issue ?></td>
                      <td><?= $l->lokasi ?></td>
                      <td><?= $l->nama ?></td>

                      <!-- STATUS -->
                      <td class="text-center" style="width:10%">
                        <?php if ($l->status == '1') : ?>
                          <span class="badge badge-warning px-3 py-1">On Progress</span>
                        <?php else : ?>
                          <span class="badge badge-success px-3 py-1">Done</span>
                        <?php endif; ?>
                      </td>

                      <!-- ACTION -->
                      <?php if ($l->status == '1') : ?>
                        <td class="text-center">
                          <div class="row">
                            <div class="col-4">
                              <a href="#" class="btn btn-warning btn-sm btn-block " data-toggle="modal" data-target="#editissue<?= $l->id ?>">
                                <i class="fa fa-solid fa-pencil-alt"></i>
                              </a>
                            </div>
                            <div class="col-4">
                              <a href="#" class="btn btn-danger btn-sm btn-block " data-toggle="modal" data-target="#hapuslapissue<?= $l->id ?>">
                                <i class="fa fa-solid fa-trash-alt"></i>
                              </a>
                            </div>
                            <div class="col-4">
                              <a href="<?= base_url('update_status_issue/' . $l->id) ?>" class="btn btn-success btn-sm btn-block">
                                <i class="fa fa-check"></i>
                              </a>
                            </div>
                          </div>
                        </td>
                      <?php else : ?>
                        <td class="text-center"><a href="#" class="btn btn-primary btn-sm btn-block">
                            <i class="fa fa-check"></i>
                          </a></td>
                      <?php endif; ?>

                    </tr>
                  <?php endforeach; ?>
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