<body class="hold-transition sidebar-mini sidebar-collapse">
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center"><img class="animation__shake" src="<?php echo base_url('assets/images/Karisma.png') ?>" alt="AdminLTELogo" height="150" width="300"></div>
        <?php $this->load->view('partial/main/navbar') ?>
        <?php $this->load->view('partial/main/sidebar') ?>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2"></div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">

                    <div class="row mb-2">
                        <div class="col-2">
                            <button type="button" class="btn btn-sm btn-warning btn-block" id="btnOpenSettingMaster"><i class="fa fa-cogs"></i> Setting Master Checklist</button>
                        </div>
                        <div class="col-2">
                            <!-- <button type="button" class="btn btn-sm btn-warning btn-block" id="btnOpenSettingMaster"><i class="fa fa-cogs"></i> Setting Master Checklist</button> -->
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">GENERAL CHECKUP TRUK</h3>

                        </div>
                        <div class="card-body">
                            <form id="formCheckupHeader">
                                <div class="row">
                                    <div class="col-md-3"><label>No.Polisi</label><input type="text" class="form-control" id="no_polisi" required></div>
                                    <div class="col-md-3"><label>Hari</label><input type="text" class="form-control" id="hari_check" required></div>
                                    <div class="col-md-3"><label>Tanggal</label><input type="date" class="form-control" id="tanggal_check" value="<?= date('Y-m-d') ?>" required></div>
                                    <?php date_default_timezone_set('Asia/Jakarta'); ?>
                                    <div class="col-md-3"><label>Jam</label><input type="time" class="form-control" id="jam_check" value="<?= date('H:i') ?>" required></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-3"><label>Kilometer</label><input type="number" class="form-control" id="kilometer" min="1" required></div>
                                    <div class="col-md-3"><label>Inputer</label><input type="text" class="form-control" id="inmpuuter" value="" required></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">HASIL PENGECEKAN</h3>
                        </div>
                        <div class="card-body" id="checkupContainer">
                            <p class="text-muted mb-0">Memuat master checklist...</p>
                        </div>
                        <div class="card-footer"><button class="btn btn-success btn-block" id="btnSimpanCheckup" type="button"><i class="fa fa-save"></i> Simpan General Checkup</button></div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">RIWAYAT GENERAL CHECKUP</h3>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th style="width:40px;">No</th>
                                        <th>Tanggal</th>
                                        <th>No.Polisi</th>
                                        <th>Jam</th>
                                        <th>Kilometer</th>
                                        <th>Total Point</th>
                                        <th>Temuan</th>
                                        <th style="width:90px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyRiwayat">
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">Memuat data...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="modal fade" id="modalDetailRiwayat" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail General Checkup</h5><button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body" id="detailRiwayatBody">
                    <p class="text-muted mb-0">Memuat detail...</p>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalSettingMaster" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Setting Master General Checkup</h5><button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">Master Kategori</h6><button class="btn btn-sm btn-primary" id="btnTambahKategori" type="button">Tambah Kategori</button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th style="width:60px;">ID</th>
                                            <th>Nama Kategori</th>
                                            <th style="width:95px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyKategori"></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">Master Detail Kategori</h6><button class="btn btn-sm btn-primary" id="btnTambahDetailKategori" type="button">Tambah Detail</button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th style="width:60px;">ID</th>
                                            <th style="width:180px;">Kategori</th>
                                            <th>Nama Detail</th>
                                            <th style="width:95px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyDetailKategori"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button></div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalFormKategori" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Kategori</h5><button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body"><input type="hidden" id="kategori_id">
                    <div class="form-group mb-0"><label>Nama Kategori</label><input type="text" class="form-control" id="kategori_nama"></div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button><button type="button" class="btn btn-primary" id="btnSimpanKategori">Simpan</button></div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalFormDetailKategori" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Detail Kategori</h5><button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body"><input type="hidden" id="detail_id">
                    <div class="form-group"><label>Kategori</label><select class="form-control" id="detail_kategori_id"></select></div>
                    <div class="form-group mb-0"><label>Nama Detail</label><input type="text" class="form-control" id="detail_nama"></div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button><button type="button" class="btn btn-primary" id="btnSimpanDetailKategori">Simpan</button></div>
            </div>
        </div>
    </div>
    <script>
        let masterChecklist = [],
            kategoriData = [],
            detailKategoriData = [];
        const inputState = {};
        const categoryFiles = {};
        $(function() {
            syncDayName();
            loadMasterChecklist();
            loadRiwayat();
            $('#tanggal_check').on('change', syncDayName);
            $('#btnSimpanCheckup').on('click', submitCheckup);
            $('#btnOpenSettingMaster').on('click', openMasterSettingModal);
            $('#btnTambahKategori').on('click', openTambahKategori);
            $('#btnSimpanKategori').on('click', saveKategori);
            $('#btnTambahDetailKategori').on('click', openTambahDetailKategori);
            $('#btnSimpanDetailKategori').on('click', saveDetailKategori);
        });

        function syncDayName() {
            const t = $('#tanggal_check').val();
            if (!t) return;
            const d = new Date(t + 'T00:00:00');
            const m = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            $('#hari_check').val(m[d.getDay()]);
        }

        function loadMasterChecklist() {
            $.ajax({
                url: "<?= base_url('ajax_truck_master_checklist') ?>",
                method: 'GET',
                dataType: 'json',
                success: function(r) {
                    if (!r || !r.status) {
                        $('#checkupContainer').html('<p class="text-danger mb-0">Gagal memuat master checklist.</p>');
                        return;
                    }
                    masterChecklist = r.data || [];
                    renderMasterChecklist();
                },
                error: function() {
                    $('#checkupContainer').html('<p class="text-danger mb-0">Terjadi kesalahan saat memuat master checklist.</p>');
                }
            });
        }

        function renderMasterChecklist() {
            if (!masterChecklist.length) {
                $('#checkupContainer').html('<p class="text-muted mb-0">Master checklist belum tersedia. Silakan atur dari tombol Setting Master Checklist.</p>');
                return;
            }
            let h = '';
            masterChecklist.forEach(function(k, ki) {
                const catKey = String(k.id_kategori);
                if (!(catKey in categoryFiles)) categoryFiles[catKey] = [];
                const catCount = categoryFiles[catKey].length;
                const catInfo = catCount ? '<span class="badge badge-info">' + catCount + ' foto</span>' : '<span class="text-muted">Belum ada</span>';
                h += '<div class="card card-outline card-info mb-3"><div class="card-header py-2 d-flex justify-content-between align-items-center"><strong>' + (ki + 1) + '. ' + escapeHtml(k.nm_kategori || '-') + '</strong><div class="d-flex align-items-center"><span class="text-muted mr-2">Bukti Foto Kategori</span><input type="file" class="form-control form-control-sm" style="max-width:240px" accept="image/*" multiple onchange="setKategoriFoto(' + k.id_kategori + ',this)"><div class="ml-2" id="kategori_file_info_' + k.id_kategori + '">' + catInfo + '</div></div></div><div class="card-body table-responsive p-0"><table class="table table-sm table-bordered mb-0"><thead class="thead-light"><tr><th style="width:40px;">No</th><th>Point Checklist</th><th style="width:130px;">Status</th><th>Keterangan</th></tr></thead><tbody>';
                if (!k.details || !k.details.length) {
                    h += '<tr><td colspan="4" class="text-center text-muted">Belum ada detail checklist pada kategori ini</td></tr>';
                } else {
                    k.details.forEach(function(d, i) {
                        const key = String(d.id_detail_kat);
                        if (!inputState[key]) inputState[key] = {
                            id_kategori: k.id_kategori,
                            id_detail_kat: d.id_detail_kat,
                            status: 'BAIK',
                            keterangan: ''
                        };
                        const s = inputState[key].status || 'BAIK';
                        const ket = escapeHtml(inputState[key].keterangan || '');
                        h += '<tr><td>' + (i + 1) + '</td><td>' + escapeHtml(d.nm_detail || '-') + '</td><td><select class="form-control form-control-sm" onchange="setStatus(' + d.id_detail_kat + ',this.value)"><option value="BAIK" ' + (s === 'BAIK' ? 'selected' : '') + '>BAIK</option><option value="TIDAK BAIK" ' + (s === 'TIDAK BAIK' ? 'selected' : '') + '>TIDAK BAIK</option></select></td><td><input type="text" class="form-control form-control-sm" value="' + ket + '" oninput="setKeterangan(' + d.id_detail_kat + ',this.value)"></td></tr>';
                    });
                }
                h += '</tbody></table></div></div>';
            });
            $('#checkupContainer').html(h);
        }

        function setStatus(id, v) {
            const k = String(id);
            if (inputState[k]) inputState[k].status = v;
        }

        function setKeterangan(id, v) {
            const k = String(id);
            if (inputState[k]) inputState[k].keterangan = v;
        }

        function setKategoriFoto(id, input) {
            const k = String(id);
            const files = input.files ? Array.from(input.files) : [];
            categoryFiles[k] = files;
            const count = files.length;
            $('#kategori_file_info_' + id).html(count ? '<span class="badge badge-info">' + count + ' foto</span>' : '<span class="text-muted">Belum ada</span>');
        }

        function submitCheckup() {
            const noPolisi = ($('#no_polisi').val() || '').trim(),
                hari = ($('#hari_check').val() || '').trim(),
                tanggal = ($('#tanggal_check').val() || '').trim(),
                jam = ($('#jam_check').val() || '').trim(),
                kilometer = ($('#kilometer').val() || '').trim(),
                inmpuuter = ($('#inmpuuter').val() || '').trim();
            if (!noPolisi || !hari || !tanggal || !jam || !kilometer || !inmpuuter) {
                alert('Header checkup belum lengkap.');
                return;
            }
            const items = Object.keys(inputState).map(k => inputState[k]).filter(it => Number(it.id_kategori) > 0 && Number(it.id_detail_kat) > 0);
            if (!items.length) {
                alert('Master detail checklist belum tersedia.');
                return;
            }
            const fd = new FormData();
            fd.append('no_polisi', noPolisi);
            fd.append('hari_check', hari);
            fd.append('tanggal_check', tanggal);
            fd.append('jam_check', jam);
            fd.append('kilometer', kilometer);
            fd.append('inmpuuter', inmpuuter);
            const payload = [];
            items.forEach(function(it, i) {
                const row = {
                    id_kategori: it.id_kategori,
                    id_detail_kat: it.id_detail_kat,
                    status: it.status || 'BAIK',
                    keterangan: it.keterangan || ''
                };
                payload.push(row);
            });
            fd.append('items_json', JSON.stringify(payload));
            const kategoriPayload = [];
            Object.keys(categoryFiles).forEach(function(k) {
                const files = categoryFiles[k] || [];
                if (!files.length) return;
                const key = 'kategori_foto_' + k;
                files.forEach(function(f) {
                    fd.append(key + '[]', f);
                });
                kategoriPayload.push({
                    id_kategori: Number(k),
                    file_key: key
                });
            });
            fd.append('kategori_json', JSON.stringify(kategoriPayload));
            $('#btnSimpanCheckup').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
            $.ajax({
                url: "<?= base_url('ajax_truck_checkup_save') ?>",
                method: 'POST',
                data: fd,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(r) {
                    if (!r || !r.status) {
                        alert((r && r.message) ? r.message : 'Gagal menyimpan checkup.');
                        return;
                    }
                    alert(r.message);
                    resetFormCheckup();
                    loadRiwayat();
                },
                error: function() {
                    alert('Terjadi kesalahan saat menyimpan data.');
                },
                complete: function() {
                    $('#btnSimpanCheckup').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan General Checkup');
                }
            });
        }

        function resetFormCheckup() {
            $('#no_polisi').val('');
            $('#tanggal_check').val('<?= date('Y-m-d') ?>');
            $('#jam_check').val('<?= date('H:i') ?>');
            $('#kilometer').val('');
            syncDayName();
            Object.keys(inputState).forEach(function(k) {
                inputState[k].status = 'BAIK';
                inputState[k].keterangan = '';
            });
            Object.keys(categoryFiles).forEach(function(k) {
                categoryFiles[k] = [];
            });
            renderMasterChecklist();
        }

        function loadRiwayat() {
            $.ajax({
                url: "<?= base_url('ajax_truck_checkup_list') ?>",
                method: 'GET',
                dataType: 'json',
                success: function(r) {
                    if (!r || !r.status) {
                        $('#tbodyRiwayat').html('<tr><td colspan="8" class="text-center text-danger">Gagal memuat data</td></tr>');
                        return;
                    }
                    if (!r.data || !r.data.length) {
                        $('#tbodyRiwayat').html('<tr><td colspan="8" class="text-center text-muted">Belum ada riwayat checkup</td></tr>');
                        return;
                    }
                    let h = '';
                    r.data.forEach(function(row, i) {
                        const b = Number(row.total_problem) > 0 ? '<span class="badge badge-danger">' + row.total_problem + ' temuan</span>' : '<span class="badge badge-success">Normal</span>';
                        h += '<tr><td>' + (i + 1) + '</td><td>' + formatDate(row.tanggal) + '</td><td>' + escapeHtml(row.nopol || '-') + '</td><td>' + escapeHtml(row.jam || '-') + '</td><td class="text-right">' + numberFormat(row.kilometer || 0) + '</td><td class="text-center">' + numberFormat(row.total_item || 0) + '</td><td class="text-center">' + b + '</td><td class="text-center"><button class="btn btn-xs btn-info" onclick="showDetailRiwayat(' + row.id_ckup + ')">Detail</button></td></tr>';
                    });
                    $('#tbodyRiwayat').html(h);
                },
                error: function() {
                    $('#tbodyRiwayat').html('<tr><td colspan="8" class="text-center text-danger">Terjadi kesalahan saat memuat data</td></tr>');
                }
            });
        }

        function showDetailRiwayat(id) {
            $('#detailRiwayatBody').html('<p class="text-muted mb-0">Memuat detail...</p>');
            $('#modalDetailRiwayat').modal('show');
            $.ajax({
                url: "<?= base_url('ajax_truck_checkup_detail') ?>/" + id,
                method: 'GET',
                dataType: 'json',
                success: function(r) {
                    if (!r || !r.status) {
                        $('#detailRiwayatBody').html('<p class="text-danger mb-0">Data detail tidak ditemukan.</p>');
                        return;
                    }
                    const header = r.data.header,
                        details = r.data.detail || [];
                    let h = '<div class="mb-3"><strong>No.Polisi:</strong> ' + escapeHtml(header.nopol || '-') + ' | <strong>Tanggal:</strong> ' + formatDate(header.tanggal) + ' | <strong>Jam:</strong> ' + escapeHtml(header.jam || '-') + ' | <strong>Kilometer:</strong> ' + numberFormat(header.kilometer || 0) + '</div>';
                    if (!details.length) {
                        h += '<p class="text-muted mb-0">Tidak ada detail checklist.</p>';
                        $('#detailRiwayatBody').html(h);
                        return;
                    }
                    h += '<div class="table-responsive"><table class="table table-bordered table-sm"><thead><tr><th>Kategori</th><th>Point</th><th>Status</th><th>Keterangan</th><th>Foto Kategori</th></tr></thead><tbody>';
                    details.forEach(function(row) {
                        const b = String(row.status).toUpperCase() === 'TIDAK BAIK' ? '<span class="badge badge-danger">TIDAK BAIK</span>' : '<span class="badge badge-success">BAIK</span>';
                        let p = '-';
                        if (row.foto_kategori) {
                            const files = String(row.foto_kategori).split(',').filter(Boolean);
                            if (files.length) {
                                p = files.map(function(f) {
                                    return '<a href="<?= base_url('uploads/checklist_kendaraan/') ?>' + f + '" target="_blank">Lihat Foto</a>';
                                }).join('<br>');
                            }
                        }
                        h += '<tr><td>' + escapeHtml(row.nm_kategori || '-') + '</td><td>' + escapeHtml(row.nm_detail || '-') + '</td><td>' + b + '</td><td>' + escapeHtml(row.keterangan || '-') + '</td><td>' + p + '</td></tr>';
                    });
                    h += '</tbody></table></div>';
                    $('#detailRiwayatBody').html(h);
                },
                error: function() {
                    $('#detailRiwayatBody').html('<p class="text-danger mb-0">Terjadi kesalahan saat memuat detail.</p>');
                }
            });
        }

        function openMasterSettingModal() {
            loadKategoriList();
            loadDetailKategoriList();
            $('#modalSettingMaster').modal('show');
        }

        function loadKategoriList() {
            $.ajax({
                url: "<?= base_url('ajax_mekanik_kategori_list') ?>",
                method: 'GET',
                dataType: 'json',
                success: function(r) {
                    if (!r || !r.status) {
                        $('#tbodyKategori').html('<tr><td colspan="3" class="text-center text-danger">Gagal memuat kategori</td></tr>');
                        return;
                    }
                    kategoriData = r.data || [];
                    renderKategoriTable();
                    fillKategoriOptions();
                },
                error: function() {
                    $('#tbodyKategori').html('<tr><td colspan="3" class="text-center text-danger">Terjadi kesalahan saat memuat kategori</td></tr>');
                }
            });
        }

        function renderKategoriTable() {
            if (!kategoriData.length) {
                $('#tbodyKategori').html('<tr><td colspan="3" class="text-center text-muted">Belum ada data kategori</td></tr>');
                return;
            }
            let h = '';
            kategoriData.forEach(function(row) {
                h += '<tr><td>' + row.id_kategori + '</td><td>' + escapeHtml(row.nm_kategori || '-') + '</td><td class="text-center"><button class="btn btn-xs btn-warning mr-1" onclick="editKategori(' + row.id_kategori + ',\'' + jsQuote(row.nm_kategori || '') + '\')"><i class="fa fa-edit"></i></button><button class="btn btn-xs btn-danger" onclick="deleteKategori(' + row.id_kategori + ')"><i class="fa fa-trash"></i></button></td></tr>';
            });
            $('#tbodyKategori').html(h);
        }

        function fillKategoriOptions() {
            let o = '<option value="">Pilih Kategori</option>';
            kategoriData.forEach(function(row) {
                o += '<option value="' + row.id_kategori + '">' + escapeHtml(row.nm_kategori || '-') + '</option>';
            });
            $('#detail_kategori_id').html(o);
        }

        function openTambahKategori() {
            $('#kategori_id').val('');
            $('#kategori_nama').val('');
            $('#modalFormKategori').modal('show');
        }

        function editKategori(id, n) {
            $('#kategori_id').val(id);
            $('#kategori_nama').val(n);
            $('#modalFormKategori').modal('show');
        }

        function saveKategori() {
            const id = ($('#kategori_id').val() || '').trim(),
                nama = ($('#kategori_nama').val() || '').trim();
            if (!nama) {
                alert('Nama kategori wajib diisi.');
                return;
            }
            $.ajax({
                url: "<?= base_url('ajax_mekanik_kategori_save') ?>",
                method: 'POST',
                dataType: 'json',
                data: {
                    id_kategori: id,
                    nm_kategori: nama
                },
                success: function(r) {
                    if (!r || !r.status) {
                        alert((r && r.message) ? r.message : 'Gagal menyimpan kategori.');
                        return;
                    }
                    $('#modalFormKategori').modal('hide');
                    loadKategoriList();
                    loadDetailKategoriList();
                    loadMasterChecklist();
                },
                error: function() {
                    alert('Terjadi kesalahan saat menyimpan kategori.');
                }
            });
        }

        function deleteKategori(id) {
            if (!confirm('Hapus kategori ini?')) return;
            $.ajax({
                url: "<?= base_url('ajax_mekanik_kategori_delete') ?>",
                method: 'POST',
                dataType: 'json',
                data: {
                    id_kategori: id
                },
                success: function(r) {
                    if (!r || !r.status) {
                        alert((r && r.message) ? r.message : 'Gagal menghapus kategori.');
                        return;
                    }
                    loadKategoriList();
                    loadDetailKategoriList();
                    loadMasterChecklist();
                },
                error: function() {
                    alert('Terjadi kesalahan saat menghapus kategori.');
                }
            });
        }

        function loadDetailKategoriList() {
            $.ajax({
                url: "<?= base_url('ajax_mekanik_kategori_detail_list') ?>",
                method: 'GET',
                dataType: 'json',
                success: function(r) {
                    if (!r || !r.status) {
                        $('#tbodyDetailKategori').html('<tr><td colspan="4" class="text-center text-danger">Gagal memuat detail kategori</td></tr>');
                        return;
                    }
                    detailKategoriData = r.data || [];
                    renderDetailKategoriTable();
                },
                error: function() {
                    $('#tbodyDetailKategori').html('<tr><td colspan="4" class="text-center text-danger">Terjadi kesalahan saat memuat detail kategori</td></tr>');
                }
            });
        }

        function renderDetailKategoriTable() {
            if (!detailKategoriData.length) {
                $('#tbodyDetailKategori').html('<tr><td colspan="4" class="text-center text-muted">Belum ada data detail kategori</td></tr>');
                return;
            }
            let h = '';
            detailKategoriData.forEach(function(row) {
                h += '<tr><td>' + row.id_detail_kat + '</td><td>' + escapeHtml(row.nm_kategori || '-') + '</td><td>' + escapeHtml(row.nm_detail || '-') + '</td><td class="text-center"><button class="btn btn-xs btn-warning mr-1" onclick="editDetailKategori(' + row.id_detail_kat + ',' + row.id_kategori + ',\'' + jsQuote(row.nm_detail || '') + '\')"><i class="fa fa-edit"></i></button><button class="btn btn-xs btn-danger" onclick="deleteDetailKategori(' + row.id_detail_kat + ')"><i class="fa fa-trash"></i></button></td></tr>';
            });
            $('#tbodyDetailKategori').html(h);
        }

        function openTambahDetailKategori() {
            $('#detail_id').val('');
            $('#detail_kategori_id').val('');
            $('#detail_nama').val('');
            $('#modalFormDetailKategori').modal('show');
        }

        function editDetailKategori(id, k, n) {
            $('#detail_id').val(id);
            $('#detail_kategori_id').val(k);
            $('#detail_nama').val(n);
            $('#modalFormDetailKategori').modal('show');
        }

        function saveDetailKategori() {
            const id = ($('#detail_id').val() || '').trim(),
                idKategori = ($('#detail_kategori_id').val() || '').trim(),
                nama = ($('#detail_nama').val() || '').trim();
            if (!idKategori || !nama) {
                alert('Kategori dan nama detail wajib diisi.');
                return;
            }
            $.ajax({
                url: "<?= base_url('ajax_mekanik_kategori_detail_save') ?>",
                method: 'POST',
                dataType: 'json',
                data: {
                    id_detail_kat: id,
                    id_kategori: idKategori,
                    nm_detail: nama
                },
                success: function(r) {
                    if (!r || !r.status) {
                        alert((r && r.message) ? r.message : 'Gagal menyimpan detail kategori.');
                        return;
                    }
                    $('#modalFormDetailKategori').modal('hide');
                    loadDetailKategoriList();
                    loadMasterChecklist();
                },
                error: function() {
                    alert('Terjadi kesalahan saat menyimpan detail kategori.');
                }
            });
        }

        function deleteDetailKategori(id) {
            if (!confirm('Hapus detail kategori ini?')) return;
            $.ajax({
                url: "<?= base_url('ajax_mekanik_kategori_detail_delete') ?>",
                method: 'POST',
                dataType: 'json',
                data: {
                    id_detail_kat: id
                },
                success: function(r) {
                    if (!r || !r.status) {
                        alert((r && r.message) ? r.message : 'Gagal menghapus detail kategori.');
                        return;
                    }
                    loadDetailKategoriList();
                    loadMasterChecklist();
                },
                error: function() {
                    alert('Terjadi kesalahan saat menghapus detail kategori.');
                }
            });
        }

        function numberFormat(n) {
            return Number(n || 0).toLocaleString('id-ID');
        }

        function formatDate(d) {
            if (!d) return '-';
            const p = d.split('-');
            return p.length === 3 ? p[2] + '-' + p[1] + '-' + p[0] : d;
        }

        function escapeHtml(s) {
            return String(s).replace(/[&<>"']/g, function(m) {
                return ({
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#039;'
                })[m];
            });
        }

        function jsQuote(s) {
            return String(s).replace(/\\/g, '\\\\').replace(/'/g, "\\'");
        }
    </script>
</body>
