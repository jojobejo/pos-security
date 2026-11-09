  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-2">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('dashboard') ?>" class="brand-link">
      <img src="<?php echo base_url("assets/images/Karisma.png") ?>" style="width: 50px; height: 30px;" alt="Karisma Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Halo , <?= $this->session->userdata('nama_user') ?><br></span>
    </a>

    <?php $idsession = $this->session->userdata('akses_lv') ?>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
          with font-awesome or any other icon font library -->

          <?php if (in_array($this->session->userdata('username'), ['HRD2', 'GA1'], true)) : ?>
            <?php
            $digdocsApp =& get_instance();
            $digdocsApp->load->model('M_Digdocs');
            ?>
            <?php if ($digdocsApp->M_Digdocs->can_access()) : ?>
              <li class="nav-item">
                <a href="<?= html_escape(site_url('digdocs')) ?>" class="nav-link">
                  <i class="nav-icon fas fa-archive"></i>
                  <p>Arsip Dokumen Digital</p>
                </a>
              </li>
            <?php endif; ?>
          <?php endif; ?>

          <!-- START AKSES LV 1 -->
          <?php if ($this->session->userdata('akses_lv') == '1' && $this->session->userdata('departemen') == 'IT') : ?>
            <li class="nav-item">
              <a href="<?php echo base_url('userAdmin') ?>" class="nav-link">
                <i class="nav-icon fa fa-user"></i>
                <p>
                  User Management
                </p>
              </a>
            </li>
            <!-- END AKSES LV 1 -->

            <!-- START AKSES LV 1 USER ADM LOGISTIK -->
          <?php elseif (in_array(strtolower((string) $this->session->userdata('username')), ['alif', 'marisa'], true)) : ?>
            <li class="nav-item">
              <a href="<?php echo base_url('hrd_lap_paket_pos') ?>" class="nav-link">
                <i class="nav-icon fa fa-box"></i>
                <p>Laporan Penerimaan Paket</p>
              </a>
            </li>
            <?php if (strtolower((string) $this->session->userdata('username')) === 'marisa') : ?>
              <li class="nav-item">
                <a href="<?php echo base_url('hrd_lap_tamu') ?>" class="nav-link">
                  <i class="nav-icon fa fa-id-badge"></i>
                  <p>Laporan Tamu</p>
                </a>
              </li>
            <?php endif; ?>
          <?php elseif ($this->session->userdata('akses_lv') == '1' && $this->session->userdata('departemen') == 'LOGISTIK') : ?>
            <li class="nav-item">
              <a href="<?php echo base_url('truckoprational') ?>" class="nav-link">
                <i class="nav-icon fas fa-warehouse"></i>
                <p>
                  Truck Oprational
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('deliveriorder') ?>" class="nav-link">
                <i class="nav-icon fa fa-shipping-fast"></i>
                <p>
                  Deleveri Order
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('tmp_logistik_distribusi') ?>" class="nav-link">
                <i class="nav-icon fa fa-truck"></i>
                <p>
                  Data Logistik Distribusi
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('tracking_driver') ?>" class="nav-link">
                <i class="nav-icon fa fa-route"></i>
                <p>
                  Driver Tracking
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('hrd_lap_distribusi') ?>" class="nav-link">
                <i class="nav-icon fa fa-file"></i>
                <p>
                  Laporan Distribusi
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('hrd_lap_expedisi') ?>" class="nav-link">
                <i class="nav-icon fa fa-truck-loading"></i>
                <p>
                  Konfirmasi Berkas Expedisi
                </p>
              </a>
            </li>

            <!-- END AKSES LV 1 USER LOGISTIK -->

            <!-- START AKSES LV 2 USER HRD -->
          <?php elseif ($this->session->userdata('akses_lv') == '2' && $this->session->userdata('departemen') == 'HRD GA' && $this->session->userdata('username') == 'HRD1' || $this->session->userdata('username') == 'HRD2' || $this->session->userdata('username') == 'HRD3') : ?>
            <li class="nav-item">
              <a href="<?php echo base_url('hrd_lap_distribusi') ?>" class="nav-link">
                <i class="nav-icon fa fa-car-side"></i>
                <p>
                  Laporan Distribusi
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('hrd_lap_tamu') ?>" class="nav-link">
                <i class="nav-icon fa fa-id-badge"></i>
                <p>
                  Laporan Tamu
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('hrd_data_truk') ?>" class="nav-link">
                <i class="nav-icon fa fa-tools"></i>
                <p>
                  Data Service Truk
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('hrd_truck_cek') ?>" class="nav-link">
                <i class="nav-icon fa fa-tools"></i>
                <p>
                  General Checkup Truck
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('hrd_lap_Karyawan_KM') ?>" class="nav-link">
                <i class="nav-icon fa fa-people-arrows"></i>
                <p>
                  Laporan Karyawan K-M
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('hrd_lap_expedisi') ?>" class="nav-link">
                <i class="nav-icon fa fa-truck-loading"></i>
                <p>
                  Laporan Expedisi
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('hrd_lap_issue') ?>" class="nav-link">
                <i class="nav-icon fa fa-exclamation-triangle"></i>
                <p>
                  Laporan Issue
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('hrd_all_karyawan') ?>" class="nav-link">
                <i class="nav-icon fa fa-users"></i>
                <p>
                  Data Karyawan
                </p>
              </a>
            </li>
            <?php if ($this->session->userdata('username') === 'HRD2') : ?>
              <li class="nav-item">
                <a href="<?= base_url('hrd_lap_paket_pos') ?>" class="nav-link">
                  <i class="nav-icon fa fa-box"></i>
                  <p>Laporan Penerimaan Paket</p>
                </a>
              </li>
            <?php endif; ?>

          <?php elseif ($this->session->userdata('akses_lv') == '2' && $this->session->userdata('departemen') == 'HRD GA' && $this->session->userdata('username') == 'HRD4') : ?>
            <li class="nav-item">
              <a href="<?php echo base_url('hrd_lap_distribusi') ?>" class="nav-link">
                <i class="nav-icon fa fa-car-side"></i>
                <p>
                  Laporan Distribusi
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('tmp_logistik_distribusi') ?>" class="nav-link">
                <i class="nav-icon fa fa-truck"></i>
                <p>
                  Data Logistik Distribusi
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('hrd_add_tamu') ?>" class="nav-link">
                <i class="nav-icon fa fa-id-badge"></i>
                <p>
                  Laporan Tamu
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('hrd_lap_Karyawan_KM') ?>" class="nav-link">
                <i class="nav-icon fa fa-people-arrows"></i>
                <p>
                  Laporan Karyawan K-M
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('hrd_lap_expedisi') ?>" class="nav-link">
                <i class="nav-icon fa fa-truck-loading"></i>
                <p>
                  Laporan Expedisi
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('hrd_chelklist_kendaraan') ?>" class="nav-link">
                <i class="nav-icon fa fa-car"></i>
                <p>
                  Checklist Kendaraan
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('hrd_lap_paket_pos') ?>" class="nav-link">
                <i class="nav-icon fa fa-box"></i>
                <p>
                  Laporan Penerimaan Paket
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('hrd_lap_issue') ?>" class="nav-link">
                <i class="nav-icon fa fa-exclamation-triangle"></i>
                <p>
                  Laporan Issue
                </p>
              </a>
            </li>
            <!-- END AKSES LV 2 USER HRD -->

            <!-- START AKSES LV2 USER ADMLOBY -->
          <?php elseif ($this->session->userdata('akses_lv') == '2' && $this->session->userdata('departemen') == 'KEUANGAN') : ?>
            <li class="nav-item">
              <a href="<?php echo base_url('hrd_lap_paket_pos') ?>" class="nav-link">
                <i class="nav-icon fa fa-box"></i>
                <p>
                  Laporan Penerimaan Paket
                </p>
              </a>
            </li>
          <?php elseif ($this->session->userdata('akses_lv') == '2' && $this->session->userdata('departemen') == 'MIA') : ?>
            <li class="nav-item">
              <a href="<?php echo base_url('hrd_lap_paket_pos') ?>" class="nav-link">
                <i class="nav-icon fa fa-box"></i>
                <p>
                  Laporan Penerimaan Paket
                </p>
              </a>
            </li>

          <?php elseif ($this->session->userdata('akses_lv') == '2' && $this->session->userdata('departemen') == 'HRD & GA') : ?>

            <li class="nav-item">
              <a href="<?= base_url('hrd_lap_paket_pos') ?>" class="nav-link">
                <i class="nav-icon fa fa-box"></i>
                <p>Laporan Penerimaan Paket</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('hrd_lap_tamu') ?>" class="nav-link">
                <i class="nav-icon fa fa-id-badge"></i>
                <p>
                  Laporan Tamu
                </p>
              </a>
            </li>

          <?php endif; ?>

          <?php if ($this->session->userdata('status') === 'is_login') : ?>
            <li class="nav-item">
              <a href="<?= base_url('logout') ?>" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Log Out</p>
              </a>
            </li>
          <?php endif; ?>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
