<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Logistik extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
        $this->load->model('M_Logistik');
    }

    public function index()
    {
        $data['page_title'] = 'KARISMA - LOGISTIK';
        $data['dataplat']   = $this->M_Logistik->getallplat();
        $data['driver']    = $this->M_Logistik->getAllDriver();
        $data['driverurut']   = $this->M_Logistik->getnorutdriveractive();
        $data['helper']    = $this->M_Logistik->getAllHelper();
        $data['kd_driver']  = $this->M_Logistik->kd_driver();
        $data['kd_helper']  = $this->M_Logistik->kd_helper();


        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/logistik/bodylogistik.php', $data);
        $this->load->view('partial/main/footer.php');
        $this->load->view('content/logistik/ajaxlogistik');
    }


    public function addplat()
    {
        $kdplat = $this->input->post('kd_plat_isi');
        $noplat = $this->input->post('plat_isi');

        $dataplat = array(
            'noplat'    => $noplat,
            'nm_truk'   => $kdplat
        );
        $this->M_Logistik->addnoplatbaru($dataplat);
        redirect('truckoprational');
    }
    public function editplat()
    {
        $id     = $this->input->post('id_isi');
        $kdplat = $this->input->post('kd_plat_isi');
        $noplat = $this->input->post('plat_isi');

        $dataplat = array(
            'noplat'    => $noplat,
            'nm_truk'   => $kdplat
        );
        $this->M_Logistik->editnoplat($id, $dataplat);
        redirect('truckoprational');
    }
    public function hapusplat()
    {
        $id     = $this->input->post('id_isi');

        $this->M_Logistik->deletenoplat($id);
        redirect('truckoprational');
    }
    public function addriver()
    {
        $kd_driver  = $this->input->post('kd_driver');
        $nmdriver   = $this->input->post('driver_isi');
        $stsisi     = $this->input->post('sts_select');

        $dataplat = array(
            'kd_driver' => $kd_driver,
            'nama_driver'   => $nmdriver,
            'status'   => $stsisi
        );
        $this->M_Logistik->adddriverbaru($dataplat);
        redirect('truckoprational');
    }
    public function editdriver()
    {
        $kd_driver  = $this->input->post('kd_driver');
        $nmdriver   = $this->input->post('driver_isi');

        $dataplat = array(
            'kd_driver' => $kd_driver,
            'nama_driver'   => $nmdriver,
        );
        $this->M_Logistik->editdriver($kd_driver, $dataplat);
        redirect('truckoprational');
    }
    public function activedrver($kd_driver)
    {
        $dataupdate = array(
            'status' => 'ACTIVE'
        );
        $this->M_Logistik->editdriver($kd_driver, $dataupdate);
        redirect('truckoprational');
    }
    public function nonactivedriver($kd_driver)
    {
        $dataupdate = array(
            'status' => 'NON-ACTIVE'
        );
        $this->M_Logistik->editdriver($kd_driver, $dataupdate);
        redirect('truckoprational');
    }
    public function hapusdriver()
    {
        $id     = $this->input->post('id_isi');

        $this->M_Logistik->hapusdriver($id);
        redirect('truckoprational');
    }
    public function tambahpenggunadriver()
    {
    }
    public function deleveriorder()
    {
        $data['page_title'] = 'KARISMA - LOGISTIK';
        $data['deliveri']   = $this->M_Logistik->get_deliv_logistik()->result();

        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/logistik/orderdriver.php', $data);
        $this->load->view('partial/main/footer.php');
        $this->load->view('content/logistik/ajaxorderdriver');
    }
    public function tambahorderdriver()
    {
        $data['page_title'] = 'KARISMA - LOGISTIK';
        $data['driver'] = $this->M_Logistik->get_all_driver();
        $data['helper'] = $this->M_Logistik->select_kd_helper();
        $data['kdorder'] = $this->M_Logistik->get_kd_order();
        $data['kdtruk'] = $this->M_Logistik->select_kd_truk();

        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/logistik/tambahorderdriver.php', $data);
        $this->load->view('partial/main/footer.php');
        $this->load->view('content/logistik/ajaxorderdriver');
    }
    public function editdeliv($kd)
    {
        $data['page_title'] = 'KARISMA - LOGISTIK';
        $data['deliv'] = $this->M_Logistik->get_deliv($kd);
        $data['kdtruk'] = $this->M_Logistik->select_kd_truk();
        $data['driver'] = $this->M_Logistik->get_all_driver();
        $data['helper'] = $this->M_Logistik->select_kd_helper();
        $data['status'] = $this->M_Logistik->detail_deliv($kd);

        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/logistik/editorderdriver.php', $data);
        $this->load->view('partial/main/footer.php');
        $this->load->view('content/logistik/ajaxorderdriver');
    }
    // public function addorderdeliv1()
    // {
    //     $kdorder    = $this->input->post('kd_order_i');
    //     $tglorder   = $this->input->post('tgl_deliv_i');
    //     $nmdriver   = $this->input->post('nm_driver_i');
    //     $kdtruk     = $this->input->post('kd_truk_i');
    //     $destinasi  = $this->input->post('destinsasi_i');
    //     $nmtoko     = $this->input->post('nm_toko_i');
    //     if (!empty($kdorder) && !empty($tglorder) && !empty($nmdriver) && !empty($kdtruk) && !empty($destinasi) && !empty($nmtoko)) {
    //         foreach ($kdorder as $key => $value) {
    //             $this->db->insert('tb_log_tracking', $value);
    //         }
    //     }
    //     redirect('deliveriorder');
    // }

    public function addorderdeliv()
    {
        $kdorder    = $this->input->post('kd_order_i');
        $tglorder   = $this->input->post('tgl_deliv_i');

        $dataOrder  = array(
            'kd_order'  => $kdorder,
            'tgl_jalan' => $tglorder,
        );

        $jumlah = count($this->input->post('nm_driver_i[]'));
        for ($i = 0; $i < $jumlah; $i++) {
            $data = array(
                'norut' => $this->input->post('no_urut_i')[$i],
                'kd_deliveri' => $this->input->post('kd_order_i'),
                'tgl_jalan' => $this->input->post('tgl_deliv_i'),
                'kd_driver' => $this->input->post('kd_driver_i')[$i],
                'kd_helper' => $this->input->post('helper_i')[$i],
                'kd_truk' => $this->input->post('kd_truk_i')[$i],
                'destinasi' => $this->input->post('destinsasi_i')[$i],
                'jml_kios' => $this->input->post('jml_kios')[$i],
                'tonase' => $this->input->post('tonase_i')[$i],
                'kubikasi' => $this->input->post('kubikasi_i')[$i],
                'sts_driver' => $this->input->post('sts_driver[]')[$i],
                'keterangan' => $this->input->post('keterangan_i[]')[$i]
            );

            $datatmp = array(
                'kd_deliveri' => $this->input->post('kd_order_i'),
                'tgl_jalan' => $this->input->post('tgl_deliv_i'),
                'kd_driver' => $this->input->post('kd_driver_i')[$i],
                'kd_helper' => $this->input->post('helper_i')[$i],
                'kd_truk' => $this->input->post('kd_truk_i')[$i],
                'destinasi' => $this->input->post('destinsasi_i')[$i],
                'status' => $this->input->post('sts_driver[]')[$i],
            );
            $this->M_Logistik->insert_tmp_lap_distribusi($datatmp);
            $this->M_Logistik->insert_detail_order_driver($data);
        }
        $this->M_Logistik->insert_deliveri_order($dataOrder);
        redirect('deliveriorder');
    }
    public function editorderdeliver()
    {
        $kdorder    = $this->input->post('kd_order_i');
        $tglorder   = $this->input->post('tgl_deliv_i');

        $dataOrder  = array(
            'kd_order'  => $kdorder,
            'tgl_jalan' => $tglorder,
        );

        $jumlah = count($this->input->post('nm_driver_i[]'));
        for ($i = 0; $i < $jumlah; $i++) {
            $data = array(
                'norut' => $this->input->post('no_urut_i')[$i],
                'kd_deliveri' => $this->input->post('kd_order_i'),
                'tgl_jalan' => $this->input->post('tgl_deliv_i'),
                'kd_driver' => $this->input->post('kd_driver_i')[$i],
                'kd_helper' => $this->input->post('helper_i')[$i],
                'kd_truk' => $this->input->post('kd_truk_i')[$i],
                'destinasi' => $this->input->post('destinsasi_i')[$i],
                'jml_kios' => $this->input->post('jml_kios')[$i],
                'tonase' => $this->input->post('tonase_i')[$i],
                'kubikasi' => $this->input->post('kubikasi_i')[$i],
                'sts_driver' => $this->input->post('sts_driver[]')[$i],
                'keterangan' => $this->input->post('keterangan_i[]')[$i]
            );
            $this->M_Logistik->insert_detail_order_driver($data);
        }
        $this->M_Logistik->insert_deliveri_order($dataOrder);
        redirect('deliveriorder');
    }

    function select_kd_truk()
    {
        $nm_truk = $this->input->post('nm_truk[]');
        $data = $this->M_Logistik->select_kd_truk($nm_truk);

        echo json_encode($data);
    }

    // public function addorderdeliv()
    // {
    //     $kdorder    = $this->input->post('kd_order_i');
    //     $tglorder   = $this->input->post('tgl_deliv_i');

    //     $dataOrder  = array(
    //         'kd_order'  => $kdorder,
    //         'tgl_jalan' => $tglorder,
    //     );

    //     $jumlah = count($this->input->post('nm_driver_i'));
    //     for ($i = 0; $i < $jumlah; $i++) {
    //         $data = array(
    //             'kd_deliveri' => $this->input->post('kd_order_i'),
    //             'tgl_jalan' => $this->input->post('tgl_deliv_i'),
    //             'kd_driver' => $this->input->post('nm_driver_i')[$i],
    //             'kd_truk' => $this->input->post('kd_truk_i')[$i],
    //             'destinasi' => $this->input->post('destinsasi_i')[$i],
    //             'nm_toko' => $this->input->post('nm_toko_i')[$i]
    //         );
    //         $this->M_Logistik->insert_detail_order_driver($data);
    //     }
    //     $this->M_Logistik->insert_deliveri_order($dataOrder);
    //     redirect('deliveriorder');
    // }

    function select2driver()
    {
        $kduser = $this->input->post('nm_driver_i')[''];
        $data   = $this->M_Logistik->get_driver($kduser);
        echo json_encode($data);
    }

    public function det_deliveri($kd_deliveri)
    {
        $data['page_title'] = 'KARISMA - LOGISTIK';
        $data['kd'] = $kd_deliveri;
        $data['order_deliv'] = $this->M_Logistik->get_order($kd_deliveri);
        $data['detail']   = $this->M_Logistik->get_det_deliv($kd_deliveri)->result();
        $data['helper'] = $this->M_Logistik->select_kd_helper();
        $data['kdtruk'] = $this->M_Logistik->select_kd_truk();

        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/logistik/detailorder.php', $data);
        $this->load->view('partial/main/footer.php');
        $this->load->view('content/logistik/ajaxlogistik.php');
        $this->load->view('content/logistik/modaldetaildriverorder.php');
    }
    public function add_pending_driver()
    {
        $id    = $this->input->post('id_isi');
        $pending    = $this->input->post('pnd_isi');

        $result = array();
        foreach ($_POST['kd_deliv_isi'] as $i => $val) {
            $result[] = array(
                'kd_deliveri' => $this->input->post('kd_deliv_isi')[$i],
                'tgl_jalan' => $this->input->post('tgl_isi')[$i],
                'kd_driver' => $this->input->post('driver_isi')[$i],
                'kd_truk' => $this->input->post('truk_isi')[$i],
                'destinasi' => $this->input->post('destinasi_isi')[$i],
                'nm_toko' => $this->input->post('tko_isi')[$i],
                'note_pending' => $pending
            );
        }
        $this->db->insert_batch('tb_driver_pending', $result);
        $this->db->where_in('id', $id);
        $this->db->delete('tb_det_tracking_driver');

        redirect('deliveriorder');
    }
    public function det_driver($kdorder, $kddriver)
    {
        $data['page_title'] = 'KARISMA - LOGISTIK';
        $data['kd'] = $this->M_Logistik->get_kd($kdorder)->result();
        $data['detail']   = $this->M_Logistik->get_det_jalan_driver($kdorder, $kddriver)->result();

        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/logistik/detaildriver.php', $data);
        $this->load->view('partial/main/footer.php');
        $this->load->view('content/logistik/ajaxlogistik.php');
        $this->load->view('content/logistik/modaldetaildriverorder.php');
    }
    public function driver_pending()
    {
        $data['page_title'] = 'KARISMA - LOGISTIK';
        $data['driver'] = $this->M_Logistik->get_pnd_driver()->result();

        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/logistik/driverpending.php', $data);
        $this->load->view('partial/main/footer.php');
    }
    public function det_pnd_driver($kdorder, $kddriver)
    {
        $data['page_title'] = 'KARISMA - LOGISTIK';
        $data['kd']         = $this->M_Logistik->get_kd_det_pnd($kdorder)->result();
        $data['detail']     = $this->M_Logistik->get_det_driver_pnd($kdorder, $kddriver)->result();

        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/logistik/det_pnd_driver.php', $data);
        $this->load->view('partial/main/footer.php');
        $this->load->view('content/logistik/ajaxlogistik.php');
        $this->load->view('content/logistik/modaldetaildriverorder.php');
    }
    public function tracking_driver()
    {
        $data['page_title'] = 'KARISMA - LOGISTIK';
        $data['driver'] = $this->M_Logistik->get_data_driver()->result();

        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/logistik/driver_tracking.php', $data);
        $this->load->view('partial/main/footer.php');
    }
    public function detail_tracking_driver($kd)
    {
        $data['page_title'] = 'KARISMA - LOGISTIK';
        $data['driver'] = $this->M_Logistik->get_det_data_driver($kd)->result();
        $data['detail'] = $this->M_Logistik->get_det_tracking($kd)->result();

        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/logistik/det_tracking_driver.php', $data);
        $this->load->view('partial/main/footer.php');
    }

    public function export_tracking_driver()
    {
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
        $excel = new PHPExcel();
        $excel->getProperties()->setCreator('it_karisma')
            ->setLastModifiedBy('tracking_driver_')
            ->setTitle("Tracking All Driver")
            ->setSubject("Tracking All Driver")
            ->setDescription("Tracking All Driver")
            ->setKeywords("Tracking Driver");

        $style_col = array(
            'font' => array('bold' => true),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
            )
        );

        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
            )
        );

        $excel->setActiveSheetIndex(0)->setCellValue('A1', "Tracking Driver");
        $excel->getActiveSheet()->mergeCells('A1:J1');
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO");
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "KODE DELIVERI");
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "TANGGAL JALAN");
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "NO JALAN");
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "NAMA DRIVER");
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "KODE TRUK");
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "NOMOR PLAT");
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "STATUS DRIVER");
        $excel->setActiveSheetIndex(0)->setCellValue('I3', "DESTINASI");
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "KETERANGAN");

        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);

        $tracking = $this->M_Logistik->export_tracking()->result();

        $no = 1;
        $numrow = 4;
        foreach ($tracking as $data) {
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data->kd_deliveri);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, format_indo($data->tgl_jalan));
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data->norut);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data->nama_driver);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data->kd_truk);
            $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $data->noplat);
            $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $data->sts_driver);
            $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, $data->destinasi);
            $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, $data->keterangan);
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
            $no++;
            $numrow++;
        }

        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(11);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(13);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $excel->getActiveSheet(0)->setTitle("Rekap Tracking Driver ");
        $excel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="rekap_tracking_driver.xlsx"');
        header('Cache-Control: max-age=0');

        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }
    public function export_lap_distribusi()
    {
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
        $excel = new PHPExcel();
        $excel->getProperties()->setCreator('it_karisma')
            ->setLastModifiedBy('lap_distribusi_')
            ->setTitle("Laporan Keluar Masuk Distribusi")
            ->setSubject("Laporan Distribusi Logistik")
            ->setDescription("Laporan Keluar Masuk Distribusi Logistik")
            ->setKeywords("Laporan Distribusi");

        $style_col = array(
            'font' => array('bold' => true),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
            )
        );

        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
            )
        );

        $excel->setActiveSheetIndex(0)->setCellValue('A1', "Laporan Distribusi");
        $excel->getActiveSheet()->mergeCells('A1:M1');
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO");
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "NOPOL");
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "NOMOR LAMBUNG");
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "NAMA DRIVER");
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "NAMA HELPER");
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "TUJUAN");
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "TGL KELUAR");
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "JAM KELUAR");
        $excel->setActiveSheetIndex(0)->setCellValue('I3', "KM KELUAR");
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "TGL MASUK");
        $excel->setActiveSheetIndex(0)->setCellValue('K3', "JAM MASUK");
        $excel->setActiveSheetIndex(0)->setCellValue('L3', "KM MASUK");
        $excel->setActiveSheetIndex(0)->setCellValue('M3', "KETERANGAN");

        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('M3')->applyFromArray($style_col);
 
        $export = $this->M_Logistik->export_lap_distribusi();

        $no = 1;
        $numrow = 4;
        foreach ($export as $data) {
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data->nopol);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data->nolambung);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data->namadriver);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data->namahelper);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data->tujuan);
            $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $data->tglkeluar);
            $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $data->jamkeluar);
            $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, $data->kmkeluar);
            $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, $data->tglmasuk);
            $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, $data->jammasuk);
            $excel->setActiveSheetIndex(0)->setCellValue('L' . $numrow, $data->kmmasuk);
            $excel->setActiveSheetIndex(0)->setCellValue('M' . $numrow, $data->keterangan);
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('M' . $numrow)->applyFromArray($style_row);
            $no++;
            $numrow++;
        }

        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $excel->getActiveSheet(0)->setTitle("Laporan Keluar Masuk Kendaraan ");
        $excel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="laporan_keluar_masuk_kendaraan.xlsx"');
        header('Cache-Control: max-age=0');

        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }
    public function editnorut()
    {
        $id    = $this->input->post('id_isi');
        $no    = $this->input->post('norut');

        $result = array();
        foreach ($_POST['id_isi'] as $i => $val) {
            $result[] = array(
                'id' => $this->input->post('id_isi')[$i],
                'no_urut_hr_i' => $this->input->post('norut')[$i],
            );
        }
        $this->db->update_batch('tb_op_driver', $result, 'id');

        redirect('truckoprational');
    }
    public function tambahhelper()
    {
        $kd_driver  = $this->input->post('kd_driver');
        $nmdriver   = $this->input->post('driver_isi');
        $stsisi     = $this->input->post('sts_select');

        $dataplat = array(
            'kd_helper' => $kd_driver,
            'nama_helper'   => $nmdriver,
            'status'   => $stsisi
        );
        $this->M_Logistik->addhelperbaru($dataplat);
        redirect('truckoprational');
    }
    public function edithelper()
    {
        $kd_driver  = $this->input->post('kd_driver');
        $nmdriver   = $this->input->post('driver_isi');

        $dataplat = array(
            'kd_helper' => $kd_driver,
            'nama_helper'   => $nmdriver,
        );
        $this->M_Logistik->edithelper($kd_driver, $dataplat);
        redirect('truckoprational');
    }
    public function activehelper($kd_driver)
    {
        $dataupdate = array(
            'status' => 'ACTIVE'
        );
        $this->M_Logistik->edithelper($kd_driver, $dataupdate);
        redirect('truckoprational');
    }
    public function nonactivehelper($kd_driver)
    {
        $dataupdate = array(
            'status' => 'NON-ACTIVE'
        );
        $this->M_Logistik->edithelper($kd_driver, $dataupdate);
        redirect('truckoprational');
    }
    public function hapushelper()
    {
        $id     = $this->input->post('id_isi');

        $this->M_Logistik->hapushelper($id);
        redirect('truckoprational');
    }
    public function editdetaildriver()
    {
        $kd         = $this->input->post('kdorder');
        $id         = $this->input->post('id_i');
        $norut      = $this->input->post('no_jalan_i');
        $kdriver    = $this->input->post('kddriver');
        $kdhelper   = $this->input->post('helper_i');
        $kdtruk     = $this->input->post('kd_truk_i');
        $destinasi  = $this->input->post('destinasi_i');
        $jmlkios    = $this->input->post('jml_kios_i');
        $tonase     = $this->input->post('tonase_i');
        $kubikasi   = $this->input->post('kubikasi_i');
        $stsdriver  = $this->input->post('sts_isi');
        $keterangan = $this->input->post('keterangan_i');

        $data = array(
            'norut'     => $norut,
            'kd_driver' => $kdriver,
            'kd_helper' => $kdhelper,
            'kd_truk'   => $kdtruk,
            'destinasi' => $destinasi,
            'jml_kios'  => $jmlkios,
            'tonase'    => $tonase,
            'kubikasi'  => $kubikasi,
            'sts_driver' => $stsdriver,
            'keterangan' => $keterangan
        );
        $this->M_Logistik->edit_detail_order_driver($id, $data);
        redirect('detail_deliveri/' . $kd);
    }
    public function hapus_detail_order()
    {
        $kd = $this->input->post('id_isi');

        $this->M_Logistik->deletedetailorder($kd);
        $this->M_Logistik->deleteorder($kd);
        redirect('deliveriorder');
    }
    public function export_rekap_laporan_driver()
    {
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
        $excel = new PHPExcel();
        $excel->getProperties()->setCreator('it_karisma')
            ->setLastModifiedBy('rekap_driver_order_')
            ->setTitle("Rekap Laporan Driver Order")
            ->setSubject("Rekap Laporan Driver Order")
            ->setDescription("Rekap Laporan DO")
            ->setKeywords("Rekap DO");

        $style_col = array(
            'font' => array('bold' => true),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
            )
        );

        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
            )
        );

        $excel->setActiveSheetIndex(0)->setCellValue('A1', "Rekap Laporan Driver Order");
        $excel->getActiveSheet()->mergeCells('A1:J1');
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO");
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "KODE DELIVERI");
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "TANGGAL JALAN");
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "NO JALAN");
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "NAMA DRIVER");
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "NAMA HELPER");
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "KODE TRUK");
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "NOMOR PLAT");
        $excel->setActiveSheetIndex(0)->setCellValue('I3', "DESTINASI");
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "JUMLAH KIOS");
        $excel->setActiveSheetIndex(0)->setCellValue('K3', "TONASE");
        $excel->setActiveSheetIndex(0)->setCellValue('L3', "KUBIKASI");
        $excel->setActiveSheetIndex(0)->setCellValue('M3', "STATUS DRIVER");
        $excel->setActiveSheetIndex(0)->setCellValue('N3', "KETERANGAN");

        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('M3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('N3')->applyFromArray($style_col);

        $tracking = $this->M_Logistik->export_tracking()->result();

        $no = 1;
        $numrow = 4;
        foreach ($tracking as $data) {
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data->kd_deliveri);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data->tgl_jalan);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data->norut);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data->nama_driver);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data->nama_helper);
            $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $data->kd_truk);
            $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $data->noplat);
            $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, $data->destinasi);
            $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, $data->jml_kios);
            $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, $data->tonase);
            $excel->setActiveSheetIndex(0)->setCellValue('L' . $numrow, $data->kubikasi);
            $excel->setActiveSheetIndex(0)->setCellValue('M' . $numrow, $data->sts_driver);
            $excel->setActiveSheetIndex(0)->setCellValue('N' . $numrow, $data->keterangan);
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('M' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('N' . $numrow)->applyFromArray($style_row);
            $no++;
            $numrow++;
        }

        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(16);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(16);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(14);
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(14);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(13);
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(13);
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(8);
        $excel->getActiveSheet()->getColumnDimension('L')->setWidth(9);
        $excel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('N')->setWidth(55);
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $excel->getActiveSheet(0)->setTitle("Rekap Driver Order");
        $excel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="rekap_driver_order.xlsx"');
        header('Cache-Control: max-age=0');

        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }

    public function tmp_lap_distribusi()
    {
        $data['page_title'] = 'KARISMA - LOGISTIK';
        $data['data'] = $this->M_Logistik->get_tmp_distribusi()->result();

        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/logistik/tmp_lap_distribusi', $data);
        $this->load->view('partial/main/footer.php');
        $this->load->view('content/logistik/ajaxlogistik');
    }
    public function edit_laporan_tmp_dis()
    {
        $id         = $this->input->post('id_isi');
        $tglmasuk   = $this->input->post('tgl_masuk_i');
        $jmin       = $this->input->post('jm_masuk');
        $kmin       = $this->input->post('km_masuk');
        $tglout     = $this->input->post('tgl_keluar');
        $jmout      = $this->input->post('jm_keluar');
        $kmout      = $this->input->post('km_keluar');

        $datatmp = array(
            'tgl_masuk' => $tglmasuk,
            'jm_masuk'  => $jmin,
            'km_masuk'  => $kmin,
            'tgl_keluar' => $tglout,
            'jm_keluar' => $jmout,
            'km_keluar' => $kmout
        );
        $this->M_Logistik->edited_tmp_lap_dis($id, $datatmp);
        redirect('tmp_logistik_distribusi');
    }
    public function insert_laporan_tmp_dis()
    {
        $id         = $this->input->post('id_isi');
        $nmdriver   = $this->input->post('driver_isi');
        $nmhelper   = $this->input->post('helper_isi');
        $nolambung  = $this->input->post('nmlambung');
        $noplat     = $this->input->post('plat_isi');
        $destinasi  = $this->input->post('destinasi_i');
        $tglmasuk   = $this->input->post('tgl_masuk_i');
        $jmin       = $this->input->post('jm_masuk');
        $kmin       = $this->input->post('km_masuk');
        $tglout     = $this->input->post('tgl_keluar');
        $jmout      = $this->input->post('jm_keluar');
        $kmout      = $this->input->post('km_keluar');
        $ket        = $this->input->post('keterangan');

        $datatmp = array(
            'nopol'      => $noplat,
            'nolambung'  => $nolambung,
            'namadriver' => $nmdriver,
            'namahelper' => $nmhelper,
            'tujuan'     => $destinasi,
            'tglkeluar' => $tglout,
            'jamkeluar'  => $jmout,
            'kmkeluar' => $kmout,
            'tglmasuk' => $tglmasuk,
            'jammasuk'  => $jmin,
            'kmmasuk'  => $kmin,
            'keterangan' => $ket,
            'inputer'   => 'Security'

        );
        $this->M_Logistik->insert_lap_distribusi($datatmp);
        $this->M_Logistik->delete_tmp_lap_dis($id);
        redirect('tmp_logistik_distribusi');
    }
}
