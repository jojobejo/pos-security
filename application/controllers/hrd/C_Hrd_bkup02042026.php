<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Hrd extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
        $this->load->model('M_Hrd');
        $this->load->helper('tanggal_helper');
    }

    public function index()
    {
        $data['page_title'] = 'KARISMA';

        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/body.php', $data);
        $this->load->view('partial/main/footer.php');
    }

    // TAMPILAN HALAMAN ADD

    public function hrd_add_tamu()
    {
        $data['page_title'] = 'KARISMA';
        $data['tamu'] = $this->M_Hrd->getalltamulb()->result();
        $data['laporan']    = $this->M_Hrd->get_all_tamu_lb()->result();

        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/hrd/v_add_tamu.php', $data);
        $this->load->view('partial/main/footer.php');
    }


    // TAMPILAN HALAMAN LAP DISTRIBUSI
    public function lap_distribusi()
    {
        $data['page_title'] = 'KARISMA';

        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/hrd/lapbody.php', $data);
        $this->load->view('partial/main/footer.php');
        $this->load->view('content/hrd/ajaxhrd.php');
    }

    function get_lap_distribusi()
    {
        $list = $this->M_Hrd->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $field->tglkeluar;
            $row[] = $field->tglmasuk;
            $row[] = $field->nopol;
            $row[] = $field->nolambung;
            $row[] = $field->namadriver;
            $row[] = $field->namahelper;
            $row[] = $field->tujuan;
            $row[] = $field->jamkeluar;
            $row[] = $field->kmkeluar;
            $row[] = $field->jammasuk;
            $row[] = $field->kmmasuk;
            $row[] = $field->keterangan;
            $row[] =  '<td>
            <a href="' . base_url('edit_lap_distribusi_hrd/' . $field->id . '') . '" class="btn btn-warning btn-sm">
            <i class="fa fa-solid fa-pencil-alt"></i>
            </a>
            </td>
            <a href="' . base_url('hapus_lap_distribusi_hrd/' . $field->id . '') . '" class="btn btn-danger btn-sm">
            <i class="fa fa-solid fa-trash-alt"></i>
            </a>
            </td>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_Hrd->count_all(),
            "recordsFiltered" => $this->M_Hrd->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }


    // FUNGSI CRUD
    public function input_lap_distribusi()
    {
        $nopol = $this->input->post('nopol');
        $nolambung = $this->input->post('nolambung');
        $nm_driver = $this->input->post('nm_driver');
        $nm_helper = $this->input->post('nm_helper');
        $tujuan = $this->input->post('tujuan');
        $tgl_keluar = $this->input->post('tgl_keluar');
        $jm_keluar = $this->input->post('jm_keluar');
        $km_keluar = $this->input->post('km_keluar');
        $tgl_masuk = $this->input->post('tgl_masuk');
        $jm_masuk = $this->input->post('jm_masuk');
        $km_masuk = $this->input->post('km_masuk');
        $keterangan = $this->input->post('keterangan');
        $inputer = $this->session->userdata('nama_user');

        $data = array(
            'nopol' => $nopol,
            'nolambung' => $nolambung,
            'namadriver' => $nm_driver,
            'namahelper' => $nm_helper,
            'tujuan' => $tujuan,
            'tglkeluar' => $tgl_keluar,
            'jamkeluar' => $jm_keluar,
            'kmkeluar' => $km_keluar,
            'tglmasuk' => $tgl_masuk,
            'jammasuk' => $jm_masuk,
            'kmmasuk' => $km_masuk,
            'keterangan' => $keterangan,
            'inputer' => $inputer,
        );
        $this->M_Hrd->addlapdistribusihrd($data);
        redirect('hrd_lap_distribusi');
    }

    public function v_edit_lap_distribusi($id)
    {
        $data['page_title'] = 'KARISMA';
        $data['laporan'] = $this->M_Hrd->get_lap_id($id)->result();

        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/hrd/v_lap_dis.php', $data);
        $this->load->view('partial/main/footer.php');
    }

    public function v_hapus_lap_distribusi_hrd($id)
    {
        $data['page_title'] = 'KARISMA';
        $data['laporan'] = $this->M_Hrd->get_lap_id($id)->result();

        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/hrd/v_lap_dis_hapus.php', $data);
        $this->load->view('partial/main/footer.php');
    }

    public function edit_lap_distribusi()
    {
        $id = $this->input->post('id_isi');
        $nopol = $this->input->post('nopol');
        $nolambung = $this->input->post('nolambung');
        $nm_driver = $this->input->post('nm_driver');
        $nm_helper = $this->input->post('nm_helper');
        $tujuan = $this->input->post('tujuan');
        $tgl_keluar = $this->input->post('tgl_keluar');
        $jm_keluar = $this->input->post('jm_keluar');
        $km_keluar = $this->input->post('km_keluar');
        $tgl_masuk = $this->input->post('tgl_masuk');
        $jm_masuk = $this->input->post('jm_masuk');
        $km_masuk = $this->input->post('km_masuk');
        $keterangan = $this->input->post('keterangan');
        $inputer = $this->session->userdata('nama_user');

        $data = array(
            'nopol' => $nopol,
            'nolambung' => $nolambung,
            'namadriver' => $nm_driver,
            'namahelper' => $nm_helper,
            'tujuan' => $tujuan,
            'tglkeluar' => $tgl_keluar,
            'jamkeluar' => $jm_keluar,
            'kmkeluar' => $km_keluar,
            'tglmasuk' => $tgl_masuk,
            'jammasuk' => $jm_masuk,
            'kmmasuk' => $km_masuk,
            'keterangan' => $keterangan,
            'inputer' => $inputer,
        );
        $this->M_Hrd->editlapdistribusihrd($id, $data);
        redirect('hrd_lap_distribusi');
    }
    public function hapus_lap_distribusi_hrd()
    {
        $id     = $this->input->post('id_isi');

        $this->M_Hrd->hapus_lap_distribusi_hrd($id);
        redirect('hrd_lap_distribusi');
    }


    public function lap_tamu()
    {
        $data['page_title'] = 'KARISMA';

        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/hrd/laptamubody.php', $data);
        $this->load->view('partial/main/footer.php');
        $this->load->view('content/hrd/ajaxhrd_tamu.php');
    }

    public function lap_tamu_serverside()
    {
        $list = $this->M_Hrd->get_datatables_tamu();
        $data = [];
        $no   = $_POST['start'];

        foreach ($list as $l) {
            $no++;
            $row = [];

            $row[] = $l->tanggal;
            $row[] = $l->nama;
            $row[] = $l->perusahaan;
            $row[] = $l->alamat;
            $row[] = $l->jumlahpersonil;
            $row[] = $l->tujuan;
            $row[] = $l->jammasuk;
            $row[] = $l->jamkeluar;
            $row[] = $l->keterangan;
            $row[] = $l->nm_inputer;

            $row[] = '
                        <button class="btn btn-warning btn-sm btn-edit" data-id="' . $l->id . '">
                            <i class="fa fa-pencil-alt"></i>
                        </button>
                        <button class="btn btn-danger btn-sm btn-hapus" data-id="' . $l->id . '">
                            <i class="fa fa-trash-alt"></i>
                        </button>
                    ';


            $data[] = $row;
        }

        echo json_encode([
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->M_Hrd->count_all_tamu(),
            "recordsFiltered" => $this->M_Hrd->count_filtered_tamu(),
            "data"            => $data,
        ]);
    }

    public function edit_data_tamu()
    {
    }

    public function get_tamu_by_id($id)
    {
        $data = $this->db->get_where('tb_tamu', ['id' => $id])->row();
        echo json_encode($data);
    }

    public function hapus_tamu()
    {
        $id = $this->input->post('id');
        $this->db->delete('tb_tamu', ['id' => $id]);
        echo json_encode(['status' => true]);
    }

    public function tambah_lap_tamu()
    {

        date_default_timezone_set('Asia/Jakarta');
        $tgl = date("Y-m-d");
        $jm  = date("H:i");
        $nama = $this->input->post('nama');
        $perusahaan = $this->input->post('perusahaan');
        $alamat = $this->input->post('alamat');
        $jumlahpersonil = $this->input->post('jumlahpersonil');
        $tujuan = $this->input->post('tujuan');
        $keterangan = $this->input->post('keterangan');
        $nminputer = $this->input->post('nm_inputer');

        $data = array(
            'tanggal' => $tgl,
            'nama' => $nama,
            'perusahaan' => $perusahaan,
            'alamat' => $alamat,
            'jumlahpersonil' => $jumlahpersonil,
            'tujuan' => $tujuan,
            'jammasuk' => $jm,
            'keterangan' => $keterangan,
            'nm_inputer' => $nminputer,
        );

        $this->M_Hrd->addlaptamuhrd($data);
        redirect('hrd_add_tamu');
    }

    public function konfirm_buku_tamu()
    {
        date_default_timezone_set('Asia/Jakarta');
        $jm  = date("H:i");

        $id = $this->input->post('id');
        $tanggal = $this->input->post('tanggal');
        $nama = $this->input->post('nama');
        $perusahaan = $this->input->post('perusahaan');
        $alamat = $this->input->post('alamat');
        $jumlahpersonil = $this->input->post('jumlahpersonil');
        $tujuan = $this->input->post('tujuan');
        $jammasuk = $this->input->post('jammasuk');
        $keterangan = $this->input->post('keterangan');
        $nmnputer = $this->input->post('nm_inputer');

        $data = array(
            'tanggal' => $tanggal,
            'nama' => $nama,
            'perusahaan' => $perusahaan,
            'alamat' => $alamat,
            'jumlahpersonil' => $jumlahpersonil,
            'tujuan' => $tujuan,
            'jammasuk' => $jammasuk,
            'jamkeluar' => $jm,
            'keterangan' => $keterangan,
            'nm_inputer' => $nmnputer
        );

        $this->M_Hrd->konfirmtamulb($data);
        $this->M_Hrd->hapus_lap_tamu_lb($id);
        redirect('hrd_add_tamu');
    }

    public function edit_lap_tamu()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $tanggal = $this->input->post('tanggal');
        $perusahaan = $this->input->post('perusahaan');
        $alamat = $this->input->post('alamat');
        $jumlahpersonil = $this->input->post('personil');
        $tujuan     = $this->input->post('tujuan');
        $jammasuk   = $this->input->post('jammasuk');
        $jamkeluar  = $this->input->post('jamkeluar');
        $keterangan = $this->input->post('keterangan');
        $inputer    = $this->input->post('inputer');

        $data = array(
            'tanggal' => $tanggal,
            'nama' => $nama,
            'perusahaan' => $perusahaan,
            'alamat' => $alamat,
            'jumlahpersonil' => $jumlahpersonil,
            'tujuan' => $tujuan,
            'jammasuk' => $jammasuk,
            'jamkeluar' => $jamkeluar,
            'keterangan' => $keterangan,
            'nm_inputer' => $inputer,
        );
        $this->M_Hrd->editlaptamu($id, $data);
        redirect('hrd_lap_tamu');
    }

    public function hapus_lap_tamu_hrd()
    {
        $id     = $this->input->post('id_isi');

        $this->M_Hrd->hapus_lap_tamu_hrd($id);
        redirect('hrd_lap_tamu');
    }



    //karyawan keluar masuk
    public function lap_karykm()
    {
        $data['page_title'] = 'KARISMA';

        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/hrd/lapkaryawankmbody.php', $data);
        $this->load->view('partial/main/footer.php');
        $this->load->view('content/hrd/ajaxhrd_karayawanm.php');
    }

    public function lap_karykm_serverside()
    {
        $list = $this->M_Hrd->get_datatables_karykm();
        $data = [];

        foreach ($list as $l) {
            $row = [];

            $row[] = $l->tanggal;
            $row[] = $l->nama;
            $row[] = $l->departemen;
            $row[] = $l->status;
            $row[] = $l->jamkeluar;
            $row[] = $l->jammasuk;
            $row[] = $l->nopol;
            $row[] = $l->keterangan;
            $row[] = $l->nm_inputer;

            $row[] = '
            <button class="btn btn-warning btn-sm btn-edit" data-id="' . $l->id . '">
                <i class="fa fa-pencil-alt"></i>
            </button>
            <button class="btn btn-danger btn-sm btn-hapus" data-id="' . $l->id . '">
                <i class="fa fa-trash-alt"></i>
            </button>
        ';

            $data[] = $row;
        }

        echo json_encode([
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->M_Hrd->count_all_karykm(),
            "recordsFiltered" => $this->M_Hrd->count_filtered_karykm(),
            "data"            => $data,
        ]);
    }

    public function get_karykm_by_id($id)
    {
        $data = $this->db
            ->get_where('tb_karyawan_keluarmasuk', ['id' => $id])
            ->row();

        echo json_encode($data);
    }

    public function hapus_karykm()
    {
        $id = $this->input->post('id');
        $this->db->delete('tb_karyawan_keluarmasuk', ['id' => $id]);
        echo json_encode(['status' => true]);
    }


    // FUNGSI CRUD
    public function tambah_lap_karykm()
    {
        $tanggal = $this->input->post('tanggal');
        $nama = $this->input->post('nama');
        $departemen = $this->input->post('departemen');
        $status = $this->input->post('status');
        $jammasuk = $this->input->post('jammasuk');
        $jamkeluar = $this->input->post('jamkeluar');
        $nopol = $this->input->post('nopol');
        $keterangan = $this->input->post('keterangan');
        $nm_inputer = $this->input->post('nm_inputer');


        $data = array(
            'tanggal' => $tanggal,
            'nama' => $nama,
            'departemen' => $departemen,
            'status' => $status,
            'jammasuk' => $jammasuk,
            'jamkeluar' => $jamkeluar,
            'nopol' => $nopol,
            'keterangan' => $keterangan,
            'nm_inputer' => $nm_inputer

        );
        $this->M_Hrd->addlapkarykm($data);
        redirect('hrd_lap_Karyawan_KM');
    }

    public function edit_lap_karykm()
    {
        $id = $this->input->post('id');

        $data = [
            'tanggal'     => $this->input->post('tanggal'),
            'nama'        => $this->input->post('nama'),
            'status'      => $this->input->post('status'),
            'departemen'  => $this->input->post('departemen'),
            'jammasuk'    => $this->input->post('jammasuk'),
            'jamkeluar'   => $this->input->post('jamkeluar'),
            'nopol'       => $this->input->post('nopol'),
            'keterangan'  => $this->input->post('keterangan'),
        ];

        $this->M_Hrd->editlapkarykm($id, $data);

        echo json_encode([
            'status' => true
        ]);
    }


    public function hapus_lap_karykm()
    {
        $id     = $this->input->post('id_isi');

        $this->M_Hrd->hapuslapkarykm($id);
        redirect('hrd_lap_Karyawan_KM');
    }


    //karyawan expedisi
    public function lap_expedisi()
    {
        $data['page_title'] = 'KARISMA';
        $data['laporan']    = $this->M_Hrd->get_all_laporan_expedisi()->result();

        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/hrd/lapexpedisibody.php', $data);
        $this->load->view('partial/main/footer.php');
        $this->load->view('content/hrd/ajaxhrd_lap_expedisi.php');
    }

    public function lap_expedisi_serverside()
    {
        $list = $this->M_Hrd->get_datatables_expedisi();
        $data = [];
        $no   = $_POST['start'];

        foreach ($list as $l) {
            $row = [];

            $row[] = $l->tanggal;
            $row[] = $l->jamkeluar;
            $row[] = $l->jammasuk;
            $row[] = $l->nopol;
            $row[] = $l->namadriver;
            $row[] = $l->notlpndriver;
            $row[] = $l->perusahaanpengirim;
            $row[] = $l->namabarang;
            $row[] = $l->jumlahbarang;
            $row[] = $l->keterangan;

            // tombol hanya non LOGISTIK
            if ($this->session->userdata('departemen') != 'LOGISTIK') {
                $row[] = '
                <button class="btn btn-warning btn-sm btn-edit" data-id="' . $l->id . '">
                    <i class="fa fa-pencil-alt"></i>
                </button>
                <button class="btn btn-danger btn-sm btn-hapus" data-id="' . $l->id . '">
                    <i class="fa fa-trash-alt"></i>
                </button>
            ';
            }

            $data[] = $row;
        }

        echo json_encode([
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->M_Hrd->count_all_expedisi(),
            "recordsFiltered" => $this->M_Hrd->count_filtered_expedisi(),
            "data"            => $data,
        ]);
    }

    public function get_expedisi_by_id($id)
    {
        echo json_encode(
            $this->db->get_where('tb_expedisi', ['id' => $id])->row()
        );
    }



    public function kpi_digital()
    {
        $kduser = $this->session->userdata('kode');
        $data['kpi']    = $this->M_hrd->getkpi($kduser);
    }


    // FUNGSI CRUD
    public function tambah_lap_expedisi()
    {
        $tanggal = $this->input->post('tanggal');
        $jammasuk = $this->input->post('jammasuk');
        $jamkeluar = $this->input->post('jamkeluar');
        $nopol = $this->input->post('nopol');
        $namadriver = $this->input->post('namadriver');
        $notlpndriver = $this->input->post('notlpndriver');
        $perusahaanpengirim = $this->input->post('perusahaanpengirim');
        $namabarang = $this->input->post('namabarang');
        $jumlahbarang = $this->input->post('jumlahbarang');
        $keterangan = $this->input->post('keterangan');


        $data = array(
            'tanggal' => $tanggal,
            'jammasuk' => $jammasuk,
            'jamkeluar' => $jamkeluar,
            'nopol' => $nopol,
            'namadriver' => $namadriver,
            'notlpndriver' => $notlpndriver,
            'perusahaanpengirim' => $perusahaanpengirim,
            'namabarang' => $namabarang,
            'jumlahbarang' => $jumlahbarang,
            'keterangan' => $keterangan,

        );
        $this->M_Hrd->addlapexpedisi($data);
        redirect('hrd_lap_expedisi');
    }

    public function edit_lap_expedisi()
    {
        $id = $this->input->post('id');

        $data = [
            'tanggal' => $this->input->post('tanggal'),
            'jammasuk' => $this->input->post('jammasuk'),
            'jamkeluar' => $this->input->post('jamkeluar'),
            'nopol' => $this->input->post('nopol'),
            'namadriver' => $this->input->post('namadriver'),
            'notlpndriver' => $this->input->post('notlpndriver'),
            'perusahaanpengirim' => $this->input->post('perusahaanpengirim'),
            'namabarang' => $this->input->post('namabarang'),
            'jumlahbarang' => $this->input->post('jumlahbarang'),
            'keterangan' => $this->input->post('keterangan'),
        ];

        $this->M_Hrd->editlapexpedisi($id, $data);

        echo json_encode([
            'status' => true,
            'message' => 'Data berhasil diperbarui'
        ]);
    }

    public function hapus_lap_expedisi()
    {
        $id = $this->input->post('id');
        $this->db->delete('tb_expedisi', ['id' => $id]);
        echo json_encode(['status' => true]);
    }



    //laporan issue
    public function lap_issue()
    {
        $data['page_title'] = 'KARISMA';
        $data['laporan']    = $this->M_Hrd->export_lap_issue();

        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/hrd/lapissuebody.php', $data);
        $this->load->view('partial/main/footer.php');
        $this->load->view('content/hrd/ajaxhrd.php');
    }

    // FUNGSI CRUD
    public function tambah_lap_issue()
    {
        $tanggal = $this->input->post('tanggal');
        $issue = $this->input->post('issue');
        $lokasi = $this->input->post('lokasi');
        $nama = $this->input->post('nama');

        $data = array(
            'tanggal' => $tanggal,
            'issue' => $issue,
            'lokasi' => $lokasi,
            'nama' => $nama,
            'status' => '1'
        );
        $this->M_Hrd->addlapissue($data);
        redirect('hrd_lap_issue');
    }
    public function edit_lap_issue()
    {
        $id = $this->input->post('id');
        $tanggal = $this->input->post('tanggal');
        $issue = $this->input->post('issue');
        $lokasi = $this->input->post('lokasi');
        $nama = $this->input->post('nama');

        $data = array(
            'id' => $id,
            'tanggal' => $tanggal,
            'issue' => $issue,
            'lokasi' => $lokasi,
            'nama' => $nama,
        );
        $this->M_Hrd->editlapissue($id, $data);
        redirect('hrd_lap_issue');
    }
    public function hapus_lap_issue()
    {
        $id     = $this->input->post('id_isi');

        $this->M_Inventaris->hapuslapissue($id);
        redirect('hrd_lap_issue');
    }
    public function update_status_issue($id)
    {
        $data = array(
            'status' => '2'
        );
        $this->M_Hrd->editlapissue($id, $data);
        redirect('hrd_lap_issue');
    }
    public function search_lap_distribusi()
    {
        $vkolom = $this->input->post('sc_bar');
        $vcari  = $this->input->post('nmsearch');
        $_SESSION['varkolom'] = $vkolom;
        $_SESSION['varcari'] = $vcari;

        redirect('v_cari_lap_distribusi');
    }
    public function v_cari_lap_distribusi()
    {
        $data['page_title'] = 'KARISMA';
        $valkolom       = $_SESSION['varkolom'];
        $varcari        = $_SESSION['varcari'];
        $data['vcari']    = $this->M_Hrd->cari_lap_distribusi($valkolom, $varcari)->result();
        $data['laporan']    = $this->M_Hrd->get_all_laporan()->result();

        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/hrd/v_cari_lap_distribusi.php', $data);
        $this->load->view('partial/main/footer.php');
        $this->load->view('content/hrd/ajaxhrd.php');
    }
    public function hrd_all_karyawan()
    {
        $data['page_title'] = 'HISTORI SERVICE TRUK';
        $data['karyawan']    = $this->M_Hrd->get_all_karyawan()->result();

        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/hrd/karyawanall.php', $data);
        $this->load->view('partial/main/footer.php');
        $this->load->view('content/hrd/ajaxhrd.php');
    }
    public function hrd_data_truk()
    {
        $data['page_title'] = 'HISTORI SERVICE TRUK';
        $data['truk']    = $this->M_Hrd->get_all_truk_service_histori()->result();

        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/hrd/trukbodyhrd.php', $data);
        $this->load->view('partial/main/footer.php');
        $this->load->view('content/hrd/ajaxhrd.php');
    }
    public function update_km_now_service_truk()
    {
        $id         = $this->input->post('id');
        $kmsekarang = $this->input->post('kmnow');

        $dataupdate = array(
            'km_sekarang' => $kmsekarang
        );
        $this->M_Hrd->update_km_service($id, $dataupdate);
        redirect('hrd_data_truk');
    }
    public function update_km_past_service_truk()
    {
        $id         = $this->input->post('id');
        $kmsekarang = $this->input->post('kmnow');

        $dataupdate = array(
            'km_sebelum' => $kmsekarang
        );
        $this->M_Hrd->update_km_service($id, $dataupdate);
        redirect('hrd_data_truk');
    }

    public function add_karyawan()
    {
        $nik = $this->input->post('nik_isi');
        $nmkaryawan = $this->input->post('nm_isi');
        $departemen = $this->input->post('departemen_i');
        $almt_isi = $this->input->post('alamat_isi');
        $tgl_lahir = $this->input->post('tgl_isi');

        $dataupdate = array(
            'nik'       => $nik,
            'nama_lengkap' => $nmkaryawan,
            'departemen' => $departemen,
            'alamat'    => $almt_isi,
            'tgl_lahir' => $tgl_lahir
        );
        $this->M_Hrd->add_karyawan($dataupdate);
        redirect('hrd_all_karyawan');
    }

    public function edit_karyawan()
    {
        $id         = $this->input->post('id');
        $nik = $this->input->post('nik_isi');
        $nmkaryawan = $this->input->post('nm_isi');
        $departemen = $this->input->post('departemen_i');
        $almt_isi = $this->input->post('alamat_isi');
        $tgl_lahir = $this->input->post('tgl_isi');

        $dataupdate = array(
            'nik'       => $nik,
            'nama_lengkap' => $nmkaryawan,
            'departemen' => $departemen,
            'alamat'    => $almt_isi,
            'tgl_lahir' => $tgl_lahir
        );
        $this->M_Hrd->update_karyawan($id, $dataupdate);
        redirect('hrd_all_karyawan');
    }

    public function export_laporan_issue()
    {
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
        $excel = new PHPExcel();
        $excel->getProperties()->setCreator('it_karisma')
            ->setLastModifiedBy('lap_issue_hrd_')
            ->setTitle("Rekap Laporan Issue")
            ->setSubject("Rekap Laporan Issue")
            ->setDescription("Rekap Laporan Issue")
            ->setKeywords("Laporan Issue");

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

        $excel->setActiveSheetIndex(0)->setCellValue('A1', "Rekap Laporan Issue");
        $excel->getActiveSheet()->mergeCells('A1:E1');
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO");
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "TANGGAL");
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "DESKRIPSI ISU");
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "LOKASI");
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "NAMA PENEMU");

        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);

        $export = $this->M_Hrd->export_lap_issue();

        $no = 1;
        $numrow = 4;
        foreach ($export as $data) {
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data->tanggal);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data->issue);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data->lokasi);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data->nama);
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
            $no++;
            $numrow++;
        }

        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(85);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(35);
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $excel->getActiveSheet(0)->setTitle("Rekap Laporan Issue HRD");
        $excel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="laporan_issue_hrd.xlsx"');
        header('Cache-Control: max-age=0');


        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }

    public function export_hrd_lap_distribusi()
    {
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
        $excel = new PHPExcel();
        $excel->getProperties()->setCreator('it_karisma')
            ->setLastModifiedBy('security_hrd_')
            ->setTitle("Rekap Laporan Distribusi Keluar Masuk Kendaraan")
            ->setSubject("Rekap Laporan Distribusi Keluar Masuk")
            ->setDescription("Rekap Laporan Distribusi Masuk-Keluar")
            ->setKeywords("Dsitribusi Masuk Keluar");

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

        $excel->setActiveSheetIndex(0)->setCellValue('A1', "Rekap Laporan Keluar Masuk Distribusi");
        $excel->getActiveSheet()->mergeCells('A1:M1');
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO");
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "TANGGAL KELUAR");
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "TANGGAL MASUK");
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "NOPOL");
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "NOLAMBUNG");
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "NAMA DRIVER");
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "NAMA HELPER");
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "TUJUAN");
        $excel->setActiveSheetIndex(0)->setCellValue('I3', "JAM KELUAR");
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "KM KELUAR");
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

        $export = $this->M_Hrd->get_all_laporan()->result();

        $no = 1;
        $numrow = 4;
        foreach ($export as $data) {
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data->tglkeluar);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data->tglmasuk);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data->nopol);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data->nolambung);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data->namadriver);
            $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $data->namahelper);
            $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $data->tujuan);
            $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, $data->jamkeluar);
            $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, $data->kmkeluar);
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
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(85);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(35);
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
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
        $excel->getActiveSheet(0)->setTitle("Laporan Keluar Masuk Distribusi");
        $excel->setActiveSheetIndex(0);

        ob_end_clean();
        ob_start();

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="laporan_keluar_masuk_distribusi.xlsx"');
        header('Cache-Control: max-age=0');

        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
        exit;
    }

    public function export_data_tamu_all()
    {
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
        $excel = new PHPExcel();
        $excel->getProperties()->setCreator('it_karisma')
            ->setLastModifiedBy('security_hrd_')
            ->setTitle("Rekap Laporan Tamu")
            ->setSubject("Rekap Laporan Tamu")
            ->setDescription("Rekap Laporan Tamu")
            ->setKeywords("Rekap Laporan Tamu");

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

        $excel->setActiveSheetIndex(0)->setCellValue('A1', "Rekap Laporan Tamu");
        $excel->getActiveSheet()->mergeCells('A1:K1');
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO");
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "TANGGAL");
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "NAMA");
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "PERUSAHAAN");
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "ALAMAT");
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "JUMLAH PERSONIL");
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "TUJUAN");
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "JAM MASUK");
        $excel->setActiveSheetIndex(0)->setCellValue('I3', "JAM KELUAR");
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "KETERANGAN");
        $excel->setActiveSheetIndex(0)->setCellValue('K3', "INPUTER");

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

        $export = $this->M_Hrd->get_all_tamu()->result();

        $no = 1;
        $numrow = 4;
        foreach ($export as $data) {
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data->tanggal);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data->nama);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data->perusahaan);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data->alamat);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data->jumlahpersonil);
            $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $data->tujuan);
            $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $data->jammasuk);
            $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, $data->jamkeluar);
            $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, $data->keterangan);
            $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, $data->nm_inputer);
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
            $no++;
            $numrow++;
        }

        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(85);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(35);
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $excel->getActiveSheet(0)->setTitle("Laporan Keluar Masuk Distribusi");
        $excel->setActiveSheetIndex(0);

        ob_end_clean();
        ob_start();

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="laporan_tamu_loby.xlsx"');
        header('Cache-Control: max-age=0');

        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
        exit;
    }

    public function export_data_hrd_lap_expedisi()
    {
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
        $excel = new PHPExcel();
        $excel->getProperties()->setCreator('it_karisma')
            ->setLastModifiedBy('security_hrd_')
            ->setTitle("Rekap Laporan Expedisi")
            ->setSubject("Rekap Laporan Expedisi")
            ->setDescription("Rekap Laporan Expedisi")
            ->setKeywords("Rekap Laporan Expedisi");

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

        $excel->setActiveSheetIndex(0)->setCellValue('A1', "Rekap Laporan Expedisi");
        $excel->getActiveSheet()->mergeCells('A1:K1');
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO");
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "TANGGAL");
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "JAM MASUK");
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "JAM KELUAR");
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "NOPOL");
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "NAMA DRIVER");
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "NO DRIVER");
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "PERUSAHAAN PENGIRIM");
        $excel->setActiveSheetIndex(0)->setCellValue('I3', "NAMA BARANG");
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "JUMLAH BARANG");
        $excel->setActiveSheetIndex(0)->setCellValue('K3', "KETERANGAN");

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

        $export = $this->M_Hrd->get_all_laporan_expedisi()->result();

        $no = 1;
        $numrow = 4;
        foreach ($export as $data) {
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data->tanggal);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data->jammasuk);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data->jamkeluar);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data->nopol);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data->namadriver);
            $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $data->notlpndriver);
            $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $data->perusahaanpengirim);
            $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, $data->namabarang);
            $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, $data->jumlahbarang);
            $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, $data->keterangan);
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
            $no++;
            $numrow++;
        }

        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(85);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(35);
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $excel->getActiveSheet(0)->setTitle("Laporan Expedisi");
        $excel->setActiveSheetIndex(0);

        ob_end_clean();
        ob_start();

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="laporan_expedisi.xlsx"');
        header('Cache-Control: max-age=0');

        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
        exit;
    }

    public function export_laporan_karyawan()
    {
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
        $excel = new PHPExcel();
        $excel->getProperties()->setCreator('it_karisma')
            ->setLastModifiedBy('lap_km_karyawan_hrd_')
            ->setTitle("Rekap Laporan karyawankm")
            ->setSubject("Rekap Laporan karyawankm")
            ->setDescription("Rekap Laporan karyawankm")
            ->setKeywords("karyawankm");

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

        $excel->setActiveSheetIndex(0)->setCellValue('A1', "Rekap Laporan Keluar Masuk Karyawan");
        $excel->getActiveSheet()->mergeCells('A1:I1');
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO");
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "TANGGAL");
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "NAMA");
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "DEPARTEMEN");
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "STATUS");
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "JAM KELUAR");
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "JAM MASUK");
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "NOPOL");
        $excel->setActiveSheetIndex(0)->setCellValue('I3', "KETERANGAN");

        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);

        $export = $this->M_Hrd->export_lap_km_karyawan();

        $no = 1;
        $numrow = 4;
        foreach ($export as $data) {
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data->tanggal);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data->nama);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data->departemen);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data->status);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data->jamkeluar);
            $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $data->jammasuk);
            $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $data->nopol);
            $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, $data->keterangan);
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
            $no++;
            $numrow++;
        }

        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(85);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(35);
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $excel->getActiveSheet(0)->setTitle("Laporan Keluar Masuk Karyawan");
        $excel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="laporan_keluar_masuk_karyawan.xlsx"');
        header('Cache-Control: max-age=0');

        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }

    public function export_laporan_checklist_kendaraan()
    {
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
        $excel = new PHPExcel();
        $excel->getProperties()->setCreator('it_karisma')
            ->setLastModifiedBy('sys_karisma_')
            ->setTitle("Laporan Checklist Kendaraan")
            ->setSubject("Rekap Checklist")
            ->setDescription("Rekap Checklist Kendaraan")
            ->setKeywords("Checklist Kendaraan");

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

        $excel->setActiveSheetIndex(0)->setCellValue('A1', "Rekap Laporan Checklist Kendaraan");
        $excel->getActiveSheet()->mergeCells('A1:H1');
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO");
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "TANGGAL CHEKC");
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "NOPOL");
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "DRIVER");
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "KATAGORI CEK");
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "TOTAL PART CEK");
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "TOTAL PART BAIK");
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "TOTAL PART TIDAK BAIK");

        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);

        $export = $this->M_Hrd->get_exported_checklist_kendaraan();

        $no = 1;
        $numrow = 4;
        foreach ($export as $data) {
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data->tanggal_check);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data->nopol);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data->driver);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data->total_kategori);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data->total_part);
            $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $data->total_baik);
            $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $data->total_tidak_baik);
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
            $no++;
            $numrow++;
        }

        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $excel->getActiveSheet(0)->setTitle("Rekap Checklist Kendaraan");
        $excel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Rekap_Laporan_Checklist_Kendaraan.xlsx"');
        header('Cache-Control: max-age=0');

        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }

    // SERVERSIDE SYSTEM 

    function get_server_issue()
    {

        $list = $this->M_Hrd->get_datatables();
        $data = array();
        foreach ($list as $field) {
            $row = array();
            $row[] = $field->kode_barang;
            $row[] = $field->nama_barang;
            $row[] = $field->qty_box;
            $row[] = $field->qty_pcs;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_Inventor->count_all(),
            "recordsFiltered" => $this->M_Inventor->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function truncate_laporan_distribusi()
    {

        $this->M_Hrd->truncate_lap_distribusi();

        $this->session->set_flashdata('success', 'Data laporan distribusi berhasil dikosongkan');
        redirect('hrd_lap_distribusi');
    }

    public function truncate_laporan_loby()
    {

        $this->M_Hrd->truncate_lap_tamu();

        $this->session->set_flashdata('success', 'Data laporan distribusi berhasil dikosongkan');
        redirect('hrd_lap_distribusi');
    }

    public function hrd_lap_penerimaan_pos()
    {
        $data['page_title'] = 'Penerimaan POS Paket';

        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/hrd/getpostpaket.php', $data);
        $this->load->view('partial/main/footer.php');
        $this->load->view('content/hrd/ajaxhrd_pospaket.php');
    }

    public function lap_penerimaan_pos_serverside()
    {
        $list = $this->M_Hrd->get_datatables_get_pos_paket(
            $this->session->userdata('nama_user')
        );

        $data = [];

        foreach ($list as $l) {
            $row = [];

            // ===== STATUS =====
            $status_label = ($l->status == 1)
                ? '<span class="badge badge-success">TELAH DIKONFIRMASI</span>'
                : '<span class="badge badge-secondary">BELUM DIKONFIRMASI</span>';

            // ===== MAPPING PENERIMA =====
            switch ($l->kd_penerima) {
                case 'IKA':
                case 'SUPRIYANTO':
                    $penerima_raw = 'KEUANGAN';
                    break;
                case 'LADY':
                    $penerima_raw = 'PURCHASING';
                    break;
                case 'NITA':
                    $penerima_raw = 'HRD & GA';
                    break;
                // case 'MIA':
                //     $penerima_raw = 'MIA';
                //     break;
                    // case 'SHEILA':
                    //     $penerima_raw = 'KARISMA ONLINE';
                    //     break;
                default:
                    $penerima_raw = $l->kd_penerima;
                    break;
            }

            // ===== BADGE PENERIMA =====
            if ($penerima_raw === 'KEUANGAN') {
                $penerima = '<span class="badge badge-primary">KEUANGAN</span>';
            } elseif ($penerima_raw === 'SHEILA') {
                $penerima = '<span class="badge badge-success">KARISMA ONLINE</span>';
            } elseif ($penerima_raw === 'MIA') {
                $penerima = '<span class="badge badge-warning">MIA</span>';
            } else {
                $penerima = '<span class="badge badge-info">' . $penerima_raw . '</span>';
            }

            $row[] = $l->tanggal;
            $row[] = $l->kd_penerima;
            $row[] = $penerima;
            $row[] = $l->keterangan_1;
            $row[] = $l->tanggal_terima_1;
            $row[] = $l->tanggal_terima_2;
            $row[] = $l->jam_terima_1;
            $row[] = $l->jam_terima_2;
            $row[] = $status_label;


            if ($this->session->userdata('departemen') == 'KEUANGAN') {
                $row[] = '
           <button class="btn btn-success btn-sm btn-konfirmasi"
                data-toggle="modal"
                data-target="#modalKonfirmasi"
                data-id="' . $l->id . '">
                <i class="fa fa-check"></i>
            </button>
            ';
            } else {
                $row[] = $l->inputer;
                $row[] = '
            <div class="row">
                                <div class="col-6">
                                    <button class="btn btn-warning btn-sm btn-edit" data-id="' . $l->id . '">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-danger btn-sm btn-hapus" data-id="' . $l->id . '">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>
            ';
            }
            $data[] = $row;
        }

        $user = $this->session->userdata('nama_user');

        echo json_encode([
            "draw"            => intval($_POST['draw']),
            "recordsTotal"    => $this->M_Hrd->count_all_pos_paket($user),
            "recordsFiltered" => $this->M_Hrd->count_filtered_pos_paket($user),
            "data"            => $data,
        ]);
    }


    public function get_paket_by_id($id)
    {
        $data = $this->M_Hrd->get_paket_by_id($id);
        echo json_encode($data);
    }

    public function edit_penerimaan_paket()
    {
        $id = $this->input->post('id');

        $data = [
            'tanggal'          => $this->input->post('tanggal'),
            'kd_penerima'      => $this->input->post('kd_penerima'),
            'keterangan_1'     => $this->input->post('keterangan_1'),
            'tanggal_terima_1' => $this->input->post('tanggal_terima_1'),
            'jam_terima_1'     => $this->input->post('jam_terima_1'),
        ];

        $this->M_Hrd->update_penerimaan_paket($id, $data);
        echo json_encode(['status' => true]);
    }

    public function hapus_penerimaan_paket()
    {
        $id = $this->input->post('id');

        if (!$id) {
            echo json_encode(['status' => false]);
            return;
        }

        $delete = $this->M_Hrd->hapus_penerimaan_paket($id);

        echo json_encode([
            'status' => $delete ? true : false
        ]);
    }

    public function tambah_penerimaan_paket()
    {
        $data = [
            'tanggal'            => $this->input->post('tanggal'),
            'kd_penerima'        => $this->input->post('kd_penerima'),
            'keterangan_1'       => $this->input->post('keterangan_1'),
            'tanggal_terima_1'   => $this->input->post('tanggal_terima_1'),
            'tanggal_terima_2'   => $this->input->post('tanggal_terima_2'),
            'jam_terima_1'       => $this->input->post('jam_terima_1'),
            'jam_terima_2'       => $this->input->post('jam_terima_2'),
            'status'             => 'BELUM DITERIMA',
            'inputer'            => $this->input->post('inputer'),
        ];

        if (
            empty($data['tanggal']) ||
            empty($data['kd_penerima']) ||
            empty($data['keterangan_1']) ||
            empty($data['status']) ||
            empty($data['inputer'])
        ) {
            echo json_encode([
                'status' => false,
                'message' => 'Field wajib belum lengkap'
            ]);
            return;
        }

        $this->M_Hrd->insert_penerimaan_paket($data);

        echo json_encode([
            'status' => true,
            'message' => 'Data penerimaan paket berhasil disimpan'
        ]);
    }

    public function konfirmasi_penerimaan_paket()
    {
        $id = $this->input->post('id');

        $data = [
            'tanggal_terima_2' => $this->input->post('tanggal_terima_2'),
            'jam_terima_2'     => $this->input->post('jam_terima_2'),
            'status'           => '1'
        ];

        $this->M_Hrd->update_penerimaan_paket($id, $data);
        redirect('hrd_lap_paket_pos');
    }

    public function checklist_kendaraan()
    {
        $data['page_title'] = 'Checklist Kendaraan';
        $data['parts'] = $this->M_Hrd->get_master_parts_checklist_kendaraan();


        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/hrd/checklist_kendaraan.php', $data);
        $this->load->view('partial/main/footer.php');
    }

    public function store_checklist_kendaraan()
    {
        $tanggal = date('Y-m-d');

        $header = [
            'tanggal_check' => $tanggal,
            'driver'        => $this->input->post('driver'),
            'nopol'         => $this->input->post('nopol'),
            'no_lambung'    => $this->input->post('no_lambung'),
            'kilometer'     => $this->input->post('kilometer'),
            'inputer'       => $this->input->post('inputer')
        ];

        $checklist_id = $this->M_Hrd->insert_header_checklist_kendaraan($header);

        foreach ($this->input->post('part') as $row) {
            $detail = [
                'checklist_id' => $checklist_id,
                'kategori'     => $row['kategori'],
                'nama_part'    => $row['nama_part'],
                'kondisi'      => $row['kondisi'],
                'keterangan'   => $row['keterangan']
            ];

            $this->M_Hrd->insert_detail_checklist_kendaraan($detail);
        }

        if (!empty($_FILES['foto']['name'][0])) {

            $config = [
                'upload_path'   => './uploads/checklist_kendaraan/',
                'allowed_types' => 'jpg|jpeg|png',
                'max_size'      => 2048
            ];

            $this->load->library('upload');

            foreach ($_FILES['foto']['name'] as $i => $name) {

                $_FILES['file']['name']     = $_FILES['foto']['name'][$i];
                $_FILES['file']['type']     = $_FILES['foto']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['foto']['tmp_name'][$i];
                $_FILES['file']['error']    = $_FILES['foto']['error'][$i];
                $_FILES['file']['size']     = $_FILES['foto']['size'][$i];

                $config['file_name'] = 'CHK_' . $checklist_id . '_' . time() . '_' . $i;
                $this->upload->initialize($config);

                if ($this->upload->do_upload('file')) {
                    $file = $this->upload->data();

                    $this->M_Hrd->insert_foto_checklist([
                        'id_cheklist'  => $checklist_id,
                        'name_file'    => $file['file_name'],
                        'path'         => 'uploads/checklist_kendaraan/' . $file['file_name']
                    ]);
                }
            }
        }

        redirect('hrd_chelklist_kendaraan');
    }


    public function all_laporan_chelist_kendaraan()
    {

        $data['page_title'] = 'Checklist Kendaraan';

        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/hrd/laporan_checklist_kendaraan.php');
        $this->load->view('partial/main/footer.php');
    }

    public function ajax_checklist_kendaraan()
    {
        $list = $this->M_Hrd->get_datatables_checklist_kendaraan();
        $data = [];
        $no   = $_POST['start'];

        foreach ($list as $row) {
            $no++;
            $status = $row->total_tidak_baik > 0
                ? '<span class="badge badge-danger w-100">' . $row->total_tidak_baik . ' Masalah</span>'
                : '<span class="badge badge-success w-100">Normal</span>';

            $data[] = [
                $no,
                date('d-m-Y', strtotime($row->tanggal_check)),
                $row->driver,
                $row->nopol,
                $row->no_lambung,
                number_format($row->kilometer),
                $row->inputer,
                $status,
                '<a href="' . base_url('detail_checklist_kendaraan/' . $row->id) . '" 
                class="btn btn-sm btn-info w-100">Detail</a>'
            ];
        }

        echo json_encode([
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->M_Hrd->count_all_checklist_kendaraan(),
            "recordsFiltered" => $this->M_Hrd->count_filtered_checklist_kendaraan(),
            "data"            => $data
        ]);
    }

    public function detail_checklist($id)
    {

        $data['page_title'] = 'Checklist Kendaraan';
        $data['foto'] = $this->M_Hrd->get_foto_checklist($id);

        $data['header'] = $this->M_Hrd->get_checklist_header($id);
        $data['detail'] = $this->M_Hrd->get_checklist_detail_grouped($id);

        if (!$data['header']) {
            show_404();
        }

        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/hrd/detail_checklist_kendaraan.php');
        $this->load->view('partial/main/footer.php');
    }

    public function ajax_truck_checkup_list()
    {
        $rows = $this->M_Hrd->get_truck_checkup_list(100);
        echo json_encode([
            'status' => true,
            'data'   => $rows
        ]);
    }

    public function ajax_truck_checkup_detail($id)
    {
        $header = $this->M_Hrd->get_truck_checkup_header($id);

        if (!$header) {
            echo json_encode([
                'status'  => false,
                'message' => 'Data checkup tidak ditemukan'
            ]);
            return;
        }

        $detail = $this->M_Hrd->get_truck_checkup_detail($id);

        echo json_encode([
            'status' => true,
            'data'   => [
                'header' => $header,
                'detail' => $detail
            ]
        ]);
    }

    public function ajax_truck_checkup_save()
    {
        $nopol     = trim($this->input->post('no_polisi'));
        $tanggal   = trim($this->input->post('tanggal_check'));
        $jam       = trim($this->input->post('jam_check'));
        $kilometer = (int) $this->input->post('kilometer');
        $inputBy   = trim($this->input->post('inmpuuter'));
        $rawItems  = $this->input->post('items_json');
        $items     = json_decode($rawItems, true);

        $missing = [];
        if ($nopol === '') {
            $missing[] = 'no_polisi';
        }
        if ($tanggal === '') {
            $missing[] = 'tanggal_check';
        }
        if ($jam === '') {
            $missing[] = 'jam_check';
        }
        if ($kilometer <= 0) {
            $missing[] = 'kilometer';
        }

        if (!empty($missing)) {
            echo json_encode([
                'status'  => false,
                'message' => 'Field wajib belum lengkap: ' . implode(', ', $missing)
            ]);
            return;
        }

        if (!is_array($items) || count($items) === 0) {
            echo json_encode([
                'status'  => false,
                'message' => 'Detail checklist tidak ditemukan'
            ]);
            return;
        }

        $uploadDir = FCPATH . 'uploads/checklist_kendaraan/';
        if (!is_dir($uploadDir)) {
            @mkdir($uploadDir, 0777, true);
        }

        if ($inputBy === '') {
            $inputBy = $this->session->userdata('username');
        }
        if (empty($inputBy)) {
            $inputBy = 'system';
        }

        $this->db->trans_begin();

        $header = [
            'nopol'         => $nopol,
            'tanggal'       => $tanggal,
            'jam'           => $jam,
            'kilometer'     => $kilometer,
            'input_by'      => $inputBy
        ];

        $checklistId = $this->M_Hrd->insert_truck_checkup_header($header);
        if (!$checklistId) {
            $this->db->trans_rollback();
            echo json_encode([
                'status'  => false,
                'message' => 'Gagal menyimpan header checkup'
            ]);
            return;
        }

        $this->load->library('upload');

        foreach ($items as $idx => $item) {
            $idKategori = isset($item['id_kategori']) ? (int) $item['id_kategori'] : 0;
            $idDetail   = isset($item['id_detail_kat']) ? (int) $item['id_detail_kat'] : 0;
            $kondisiRaw = isset($item['status']) ? strtoupper(trim($item['status'])) : 'BAIK';
            $keterangan = isset($item['keterangan']) ? trim($item['keterangan']) : '';
            $fileKey    = isset($item['file_key']) ? trim($item['file_key']) : '';

            if ($idKategori <= 0 || $idDetail <= 0) {
                continue;
            }

            $kondisi = $kondisiRaw === 'TIDAK BAIK' ? 'TIDAK BAIK' : 'BAIK';
            $fotoFile = '';

            if ($fileKey !== '' && isset($_FILES[$fileKey])) {
                $fileError = isset($_FILES[$fileKey]['error']) ? (int) $_FILES[$fileKey]['error'] : UPLOAD_ERR_NO_FILE;
                $fileName  = isset($_FILES[$fileKey]['name']) ? trim($_FILES[$fileKey]['name']) : '';
                $tmpName   = isset($_FILES[$fileKey]['tmp_name']) ? trim($_FILES[$fileKey]['tmp_name']) : '';

                // Lewati proses upload jika memang tidak ada file yang dipilih.
                if ($fileError !== UPLOAD_ERR_NO_FILE) {
                    if ($fileError !== UPLOAD_ERR_OK || $fileName === '' || $tmpName === '') {
                        $this->db->trans_rollback();
                        echo json_encode([
                            'status'  => false,
                            'message' => 'File evident gagal diupload'
                        ]);
                        return;
                    }

                    $_FILES['single_file'] = $_FILES[$fileKey];

                    $config = [
                        'upload_path'   => $uploadDir,
                        'allowed_types' => 'jpg|jpeg|png|webp',
                        'max_size'      => 4096,
                        'file_name'     => 'TRUCK_' . $checklistId . '_' . $idx . '_' . time()
                    ];

                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('single_file')) {
                        $uploadData = $this->upload->data();
                        $fotoFile = $uploadData['file_name'];
                    } else {
                        $this->db->trans_rollback();
                        echo json_encode([
                            'status'  => false,
                            'message' => strip_tags($this->upload->display_errors())
                        ]);
                        return;
                    }
                }
            }

            $detail = [
                'id_ckup'      => $checklistId,
                'id_kategori'  => $idKategori,
                'id_detail_kat' => $idDetail,
                'status'       => $kondisi,
                'keterangan'   => $keterangan,
                'evident'      => $fotoFile,
                'input_by'     => $inputBy
            ];

            $this->M_Hrd->insert_truck_checkup_detail($detail);
        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            echo json_encode([
                'status'  => false,
                'message' => 'Gagal menyimpan data checkup'
            ]);
            return;
        }

        $this->db->trans_commit();
        echo json_encode([
            'status'  => true,
            'message' => 'General checkup truk berhasil disimpan'
        ]);
    }

    public function ajax_truck_master_checklist()
    {
        $rows = $this->M_Hrd->get_master_checkup_join();
        $grouped = [];

        foreach ($rows as $row) {
            $idKategori = (int) $row->id_kategori;
            if (!isset($grouped[$idKategori])) {
                $grouped[$idKategori] = [
                    'id_kategori' => $idKategori,
                    'nm_kategori' => $row->nm_kategori,
                    'details'     => []
                ];
            }

            if (!empty($row->id_detail_kat)) {
                $grouped[$idKategori]['details'][] = [
                    'id_detail_kat' => (int) $row->id_detail_kat,
                    'nm_detail'     => $row->nm_detail
                ];
            }
        }

        echo json_encode([
            'status' => true,
            'data'   => array_values($grouped)
        ]);
    }

    public function ajax_mekanik_kategori_list()
    {
        echo json_encode([
            'status' => true,
            'data'   => $this->M_Hrd->get_mekanik_kategori_all()
        ]);
    }

    public function ajax_mekanik_kategori_save()
    {
        $id = (int) $this->input->post('id_kategori');
        $nmKategori = trim($this->input->post('nm_kategori'));

        if ($nmKategori === '') {
            echo json_encode([
                'status'  => false,
                'message' => 'Nama kategori wajib diisi'
            ]);
            return;
        }

        if ($id > 0) {
            $exists = $this->M_Hrd->get_mekanik_kategori_by_id($id);
            if (!$exists) {
                echo json_encode([
                    'status'  => false,
                    'message' => 'Data kategori tidak ditemukan'
                ]);
                return;
            }

            $ok = $this->M_Hrd->update_mekanik_kategori($id, [
                'nm_kategori' => $nmKategori
            ]);
        } else {
            $ok = $this->M_Hrd->insert_mekanik_kategori([
                'nm_kategori' => $nmKategori
            ]);
        }

        echo json_encode([
            'status'  => (bool) $ok,
            'message' => $ok ? 'Kategori berhasil disimpan' : 'Gagal menyimpan kategori'
        ]);
    }

    public function ajax_mekanik_kategori_delete()
    {
        $id = (int) $this->input->post('id_kategori');

        if ($id <= 0) {
            echo json_encode([
                'status'  => false,
                'message' => 'ID kategori tidak valid'
            ]);
            return;
        }

        $totalDetail = $this->M_Hrd->count_mekanik_detail_by_kategori($id);
        if ($totalDetail > 0) {
            echo json_encode([
                'status'  => false,
                'message' => 'Kategori tidak bisa dihapus karena masih punya detail'
            ]);
            return;
        }

        $ok = $this->M_Hrd->delete_mekanik_kategori($id);
        echo json_encode([
            'status'  => (bool) $ok,
            'message' => $ok ? 'Kategori berhasil dihapus' : 'Gagal menghapus kategori'
        ]);
    }

    public function ajax_mekanik_kategori_detail_list()
    {
        echo json_encode([
            'status' => true,
            'data'   => $this->M_Hrd->get_mekanik_kategori_detail_all()
        ]);
    }

    public function ajax_mekanik_kategori_detail_save()
    {
        $id = (int) $this->input->post('id_detail_kat');
        $idKategori = (int) $this->input->post('id_kategori');
        $nmDetail = trim($this->input->post('nm_detail'));

        if ($idKategori <= 0 || $nmDetail === '') {
            echo json_encode([
                'status'  => false,
                'message' => 'Kategori dan nama detail wajib diisi'
            ]);
            return;
        }

        $kategori = $this->M_Hrd->get_mekanik_kategori_by_id($idKategori);
        if (!$kategori) {
            echo json_encode([
                'status'  => false,
                'message' => 'Kategori tidak ditemukan'
            ]);
            return;
        }

        if ($id > 0) {
            $exists = $this->M_Hrd->get_mekanik_kategori_detail_by_id($id);
            if (!$exists) {
                echo json_encode([
                    'status'  => false,
                    'message' => 'Detail kategori tidak ditemukan'
                ]);
                return;
            }

            $ok = $this->M_Hrd->update_mekanik_kategori_detail($id, [
                'id_kategori' => $idKategori,
                'nm_detail'   => $nmDetail
            ]);
        } else {
            $ok = $this->M_Hrd->insert_mekanik_kategori_detail([
                'id_kategori' => $idKategori,
                'nm_detail'   => $nmDetail
            ]);
        }

        echo json_encode([
            'status'  => (bool) $ok,
            'message' => $ok ? 'Detail kategori berhasil disimpan' : 'Gagal menyimpan detail kategori'
        ]);
    }

    public function ajax_mekanik_kategori_detail_delete()
    {
        $id = (int) $this->input->post('id_detail_kat');

        if ($id <= 0) {
            echo json_encode([
                'status'  => false,
                'message' => 'ID detail kategori tidak valid'
            ]);
            return;
        }

        $ok = $this->M_Hrd->delete_mekanik_kategori_detail($id);
        echo json_encode([
            'status'  => (bool) $ok,
            'message' => $ok ? 'Detail kategori berhasil dihapus' : 'Gagal menghapus detail kategori'
        ]);
    }

    public function hrd_truck_cek()
    {
        $data['page_title'] = 'General Checkup Truk';

        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/hrd/hrd_truck_cek.php');
        $this->load->view('partial/main/footer.php');
    }
}
