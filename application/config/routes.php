<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

// Sistem Routes
$route['default_controller'] = 'Auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//Auth Login
$route['process']   = 'Auth/process';
$route['logout']    = 'Auth/logout';

//Dashboard
$route['dashboard'] = 'Dashboard';
$route['konfirm_tamu'] = 'Dashboard/konfirm_tamu';

//inventaris
$route['inventaris']                            = 'inventaris/C_Inventaris';
$route['addinventaris']                         = 'inventaris/C_Inventaris/addinventaris';
$route['editinventaris']                        = 'inventaris/C_Inventaris/editinventaris';
$route['hapusinventaris1']                      = 'inventaris/C_Inventaris/hapusinventaris';
$route['changeowner']                           = 'inventaris/C_Inventaris/changeowner';
$route['selectowner']                           = 'inventaris/C_Inventaris/selectowner';

//LOGISTIK - TRUK SETTING
$route['truckoprational']                       = 'logistik/C_Logistik';
$route['opplat']                                = 'logistik/C_Logistik/op_plat';
$route['addplat']                               = 'logistik/C_Logistik/addplat';
$route['editplat']                              = 'logistik/C_Logistik/editplat';
$route['hapusplat']                             = 'logistik/C_Logistik/hapusplat';
$route['driverop']                              = 'logistik/C_Logistik/driverop';
$route['tambahdriver']                          = 'logistik/C_Logistik/addriver';
$route['editdriver']                            = 'logistik/C_Logistik/editdriver';
$route['hapusdriver']                           = 'logistik/C_Logistik/hapusdriver';
$route['activedrver/(:any)']                    = 'logistik/C_Logistik/activedrver/$1';
$route['nonactivedriver/(:any)']                = 'logistik/C_Logistik/nonactivedriver/$1';
$route['tambahpenggunadriver']                  = 'logistik/C_Logistik/tambahpenggunadriver';
$route['editnorut']                             = 'logistik/C_Logistik/editnorut';
$route['tambahhelper']                          = 'logistik/C_Logistik/tambahhelper';
$route['edithelper']                            = 'logistik/C_Logistik/edithelper';
$route['hapushelper']                           = 'logistik/C_Logistik/hapushelper';
$route['nonactivehelper/(:any)']                = 'logistik/C_Logistik/nonactivehelper/$1';
$route['activehelper/(:any)']                   = 'logistik/C_Logistik/activehelper/$1';

$route['tambahhelper']                          = 'logistik/C_Logistik/tambahhelper';

//LOGISTIK DELIVERI ORDER
$route['deliveriorder']                         = 'logistik/C_Logistik/deleveriorder';
$route['tambahorderdriver']                     = 'logistik/C_Logistik/tambahorderdriver';
$route['editorderdeliver/(:any)']               = 'logistik/C_Logistik/editdeliv/$1';
$route['addorderdeliv']                         = 'logistik/C_Logistik/addorderdeliv';
$route['select2driver']                         = 'logistik/C_Logistik/select2driver';
$route['detail_deliveri/(:any)']                = 'logistik/C_Logistik/det_deliveri/$1';
$route['detail_deliveri/(:any)/(:any)']         = 'logistik/C_Logistik/det_driver/$1/$2';
$route['add_pending_driver']                    = 'logistik/C_Logistik/add_pending_driver';
$route['driver_pending']                        = 'logistik/C_Logistik/driver_pending';
$route['det_pnd_driver/(:any)/(:any)']          = 'logistik/C_Logistik/det_pnd_driver/$1/$2';
$route['get_kd_truk_order']                     = 'logistik/C_Logistik/select_kd_truk';
$route['tracking_driver']                       = 'logistik/C_Logistik/tracking_driver';
$route['export_excel']                          = 'logistik/C_Logistik/export_tracking_driver';
$route['det_driver_tracking/(:any)']            = 'logistik/C_Logistik/detail_tracking_driver/$1';
$route['editdetaildriver']                      = 'logistik/C_Logistik/editdetaildriver';
$route['hapus_detail_order']                    = 'logistik/C_Logistik/hapus_detail_order';
$route['export_excel_lap_distribusi']           = 'logistik/C_Logistik/export_lap_distribusi/';
$route['exportrekaplaporandriver']              = 'logistik/C_Logistik/export_rekap_laporan_driver/';
$route['tmp_logistik_distribusi']               = 'logistik/C_Logistik/tmp_lap_distribusi/';
$route['edit_laporan_tmp_dis']                  = 'logistik/C_Logistik/edit_laporan_tmp_dis/';
$route['insert_laporan_tmp_dis']                = 'logistik/C_Logistik/insert_laporan_tmp_dis/';

// HRD 
$route['hrd_lap_distribusi']                    = 'hrd/C_Hrd/lap_distribusi';
$route['get_server_lap_dis']                    = 'hrd/C_Hrd/get_lap_distribusi';
$route['add_lap_distribusi_hrd']                = 'hrd/C_Hrd/input_lap_distribusi';
$route['edit_lap_distribusi_hrd/(:any)']        = 'hrd/C_Hrd/v_edit_lap_distribusi/$1';
$route['edit_lap_distribusi_hrd']               = 'hrd/C_Hrd/edit_lap_distribusi';
$route['hapus_lap_distribusi_hrd/(:any)']       = 'hrd/C_Hrd/v_hapus_lap_distribusi_hrd/$1';
$route['hapus_lap_distribusi_hrd']              = 'hrd/C_Hrd/hapus_lap_distribusi_hrd';
$route['hrd_lap_tamu']                          = 'hrd/C_Hrd/lap_tamu';
$route['hrd_add_tamu']                          = 'hrd/C_Hrd/hrd_add_tamu';
$route['tambah_lap_tamu']                       = 'hrd/C_Hrd/tambah_lap_tamu';
$route['hapus_lap_tamu_hrd']                    = 'hrd/C_Hrd/hapus_lap_tamu_hrd';
$route['edit_lap_tamu_hrd']                     = 'hrd/C_Hrd/edit_lap_tamu';
$route['konfirm_buku_tamu']                     = 'hrd/C_Hrd/konfirm_buku_tamu';
$route['hrd_lap_Karyawan_KM']                   = 'hrd/C_Hrd/lap_karykm';
$route['edit_lap_Karyawan_KM']                  = 'hrd/C_Hrd/edit_lap_karykm';
$route['tambah_lap_karykm']                     = 'hrd/C_Hrd/tambah_lap_karykm';
$route['hapus_lap_karykm']                      = 'hrd/C_Hrd/hapus_lap_karykm';
$route['hrd_lap_expedisi']                      = 'hrd/C_Hrd/lap_expedisi';
$route['edit_lap_expedisi']                     = 'hrd/C_Hrd/edit_lap_expedisi';
$route['tambah_lap_expedisi']                   = 'hrd/C_Hrd/tambah_lap_expedisi';
$route['hapus_lap_expedisi']                    = 'hrd/C_Hrd/hapus_lap_expedisi';
$route['hrd_lap_issue']                         = 'hrd/C_Hrd/lap_issue';
$route['edit_lap_issue']                        = 'hrd/C_Hrd/edit_lap_issue';
$route['update_status_issue/(:any)']            = 'hrd/C_Hrd/update_status_issue/$1';
$route['tambah_lap_issue']                      = 'hrd/C_Hrd/tambah_lap_issue';
$route['hapus_lap_issue']                       = 'hrd/C_Hrd/hapus_lap_issue';
$route['search_lap_distribusi']                 = 'hrd/C_Hrd/search_lap_distribusi';
$route['v_cari_lap_distribusi']                 = 'hrd/C_Hrd/v_cari_lap_distribusi';
$route['hrd_data_truk']                         = 'hrd/C_Hrd/hrd_data_truk';
$route['hrd_all_karyawan']                      = 'hrd/C_Hrd/hrd_all_karyawan';
$route['updatekmsekarang']                      = 'hrd/C_Hrd/update_km_now_service_truk';
$route['updatekmsebelum']                       = 'hrd/C_Hrd/update_km_past_service_truk';
$route['edit_karyawan']                         = 'hrd/C_Hrd/edit_karyawan';
$route['add_karyawan']                          = 'hrd/C_Hrd/add_karyawan';
$route['export_laporan_issue']                  = 'hrd/C_Hrd/export_laporan_issue';
$route['ex_lap_kar']                            = 'hrd/C_Hrd/export_laporan_karyawan';
$route['export_hrd_lap_distribusi']             = 'hrd/C_Hrd/export_hrd_lap_distribusi';

$route['truncate_laporan_distribusi']           = 'hrd/C_Hrd/truncate_laporan_distribusi';
$route['lap_tamu_serverside']                   = 'hrd/C_Hrd/lap_tamu_serverside';
$route['get_tamu_by_id/(:any)']                 = 'hrd/C_Hrd/get_tamu_by_id/$1';
$route['export_data_tamu_all']                  = 'hrd/C_Hrd/export_data_tamu_all';
$route['truncate_all_data_tamu']                = 'hrd/C_Hrd/truncate_all_data_tamu';
$route['lap_karykm_serverside']                 = 'hrd/C_Hrd/lap_karykm_serverside';
$route['get_karykm_by_id/(:any)']               = 'hrd/C_Hrd/get_karykm_by_id/$1';
$route['hapus_karykm']                          = 'hrd/C_Hrd/hapus_karykm';
$route['lap_expedisi_serverside']               = 'hrd/C_Hrd/lap_expedisi_serverside';
$route['get_expedisi_by_id/(:any)']             = 'hrd/C_Hrd/get_expedisi_by_id/$1';
$route['riwayat_penerimaan_expedisi/(:num)']    = 'hrd/C_Hrd/riwayat_penerimaan_expedisi/$1';
$route['konfirmasi_penerimaan_expedisi']        = 'hrd/C_Hrd/konfirmasi_penerimaan_expedisi';
$route['export_file_laporan_expedisis']         = 'hrd/C_Hrd/export_data_hrd_lap_expedisi';

$route['hrd_lap_paket_pos']                     = 'hrd/C_Hrd/hrd_lap_penerimaan_pos';
$route['lap_penerimaan_pos_serverside']         = 'hrd/C_Hrd/lap_penerimaan_pos_serverside';
$route['tambah_penerimaan_paket']               = 'hrd/C_Hrd/tambah_penerimaan_paket';
$route['konfirmasi_penerimaan_paket']           = 'hrd/C_Hrd/konfirmasi_penerimaan_paket';
$route['get_paket_by_id/(:any)']                = 'hrd/C_Hrd/get_paket_by_id/$1';
$route['edit_penerimaan_paket']                 = 'hrd/C_Hrd/edit_penerimaan_paket';
$route['hapus_penerimaan_paket']                = 'hrd/C_Hrd/hapus_penerimaan_paket';

$route['hrd_truck_cek']                         = 'hrd/C_Hrd/hrd_truck_cek';
$route['ajax_truck_checkup_list']               = 'hrd/C_Hrd/ajax_truck_checkup_list';
$route['ajax_truck_checkup_detail/(:num)']      = 'hrd/C_Hrd/ajax_truck_checkup_detail/$1';
$route['ajax_truck_checkup_save']               = 'hrd/C_Hrd/ajax_truck_checkup_save';
$route['ajax_truck_master_checklist']           = 'hrd/C_Hrd/ajax_truck_master_checklist';
$route['ajax_mekanik_kategori_list']            = 'hrd/C_Hrd/ajax_mekanik_kategori_list';
$route['ajax_mekanik_kategori_save']            = 'hrd/C_Hrd/ajax_mekanik_kategori_save';
$route['ajax_mekanik_kategori_delete']          = 'hrd/C_Hrd/ajax_mekanik_kategori_delete';
$route['ajax_mekanik_kategori_detail_list']     = 'hrd/C_Hrd/ajax_mekanik_kategori_detail_list';
$route['ajax_mekanik_kategori_detail_save']     = 'hrd/C_Hrd/ajax_mekanik_kategori_detail_save';
$route['ajax_mekanik_kategori_detail_delete']   = 'hrd/C_Hrd/ajax_mekanik_kategori_detail_delete';

$route['hrd_chelklist_kendaraan']               = 'hrd/C_Hrd/checklist_kendaraan';
$route['store_checklist_kendaraan']             = 'hrd/C_Hrd/store_checklist_kendaraan';
$route['all_laporan_chelist_kendaraan']         = 'hrd/C_Hrd/all_laporan_chelist_kendaraan';
$route['ajax_checklist_kendaraan']              = 'hrd/C_Hrd/ajax_checklist_kendaraan';
$route['export_data_checklist_kendaraan']       = 'hrd/C_Hrd/export_laporan_checklist_kendaraan';
$route['detail_checklist_kendaraan/(:any)']     = 'hrd/C_Hrd/detail_checklist/$1';

//KPI
$route['dashboardkpi']                          = 'kpi/C_Kpi';
$route['dashboardkpiwhat']                      = 'kpi/C_Kpi/what';
$route['add_kpi_baru']                          = 'kpi/C_Kpi/addkpi';
$route['detail_kpi/(:any)/(:any)']              = 'kpi/C_Kpi/detail_kpi/$1/$2';

//UserAccount
$route['userAdmin']                             = 'user/Admin';
$route['addUser']                               = 'user/Admin/addUser';

//IndeksNilaiKepuasanPelanggan
$route['kepuasan_pelanggan']                    = 'pelanggan/C_Pelanggan';
$route['nilai_ipkp/(:any)']                     = 'pelanggan/C_Pelanggan/input_nilai/$1';
$route['ratingreview']                          = 'pelanggan/C_Pelanggan/rating_review';

//RequestDesign
$route['requestdesign']                         = 'requestdesign/C_requestdesign';
$route['addinventaris']                         = 'inventaris/C_Inventaris/addinventaris';
$route['editinventaris']                        = 'inventaris/C_Inventaris/editinventaris';
$route['hapusinventaris1']                      = 'inventaris/C_Inventaris/hapusinventaris';
$route['changeowner']                           = 'inventaris/C_Inventaris/changeowner';
$route['selectowner']                           = 'inventaris/C_Inventaris/selectowner';
