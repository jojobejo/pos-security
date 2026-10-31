<script>
    $(document).ready(function() {
        $('#tb_lap_expedisi').DataTable({
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                url: "<?= base_url('lap_expedisi_serverside') ?>",
                type: "POST"
            },
            columnDefs: [{
                targets: -1,
                orderable: false
            }]
        });
    });

    // EDIT CLICK
    $('#tb_lap_expedisi').on('click', '.btn-edit', function() {
        let id = $(this).data('id');

        $.get("<?= base_url('get_expedisi_by_id/') ?>" + id, function(res) {
            let d = JSON.parse(res);

            $('#edit_id').val(d.id);
            $('#edit_tanggal').val(d.tanggal);
            $('#edit_jammasuk').val(d.jammasuk);
            $('#edit_jamkeluar').val(d.jamkeluar);
            $('#edit_nopol').val(d.nopol);
            $('#edit_namadriver').val(d.namadriver);
            $('#edit_notlpndriver').val(d.notlpndriver);
            $('#edit_perusahaanpengirim').val(d.perusahaanpengirim);
            $('#edit_namabarang').val(d.namabarang);
            $('#edit_jumlahbarang').val(d.jumlahbarang);
            $('#edit_keterangan').val(d.keterangan);
            $('#edit_penerima_berkas_id').val(d.penerima_berkas_id);
            $('#edit_inputer').val(d.nm_inputer);

            $('#modalEditExpedisi').modal('show');
        });
    });

    // SUBMIT EDIT
    $('#formEditExpedisi').submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: "<?= base_url('edit_lap_expedisi') ?>",
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function(res) {
                if (res.status) {
                    $('#modalEditExpedisi').modal('hide');
                    $('#tb_lap_expedisi').DataTable().ajax.reload(null, false);
                } else {
                    alert(res.message || 'Data gagal diperbarui.');
                }
            }
        });
    });


    // HAPUS
    $('#tb_lap_expedisi').on('click', '.btn-hapus', function() {
        $('#hapus_id').val($(this).data('id'));
        $('#modalHapusExpedisi').modal('show');
    });

    $('#btnHapusExpedisi').click(function() {
        $.post("<?= base_url('hapus_lap_expedisi') ?>", {
            id: $('#hapus_id').val()
        }, function() {
            $('#modalHapusExpedisi').modal('hide');
            $('#tb_lap_expedisi').DataTable().ajax.reload(null, false);
        });
    });

    $('#tb_lap_expedisi').on('click', '.btn-terima', function() {
        $('#terima_id').val($(this).data('id'));
        $('#modalKonfirmasiPenerimaan').modal('show');
    });

    $('#formKonfirmasiPenerimaan').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?= base_url('konfirmasi_penerimaan_expedisi') ?>",
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(res) {
                if (res.status) {
                    $('#modalKonfirmasiPenerimaan').modal('hide');
                    $('#tb_lap_expedisi').DataTable().ajax.reload(null, false);
                } else {
                    alert(res.message);
                }
            },
            error: function() {
                alert('Konfirmasi gagal diproses. Silakan muat ulang halaman.');
            }
        });
    });

    $('#tb_lap_expedisi').on('click', '.btn-riwayat', function() {
        let id = $(this).data('id');
        $('#isiRiwayatPenerimaan').html('Memuat riwayat...');
        $('#modalRiwayatPenerimaan').modal('show');
        $.get("<?= base_url('riwayat_penerimaan_expedisi/') ?>" + id, function(res) {
            let html = '';
            if (!res.data || res.data.length === 0) {
                html = '<p class="mb-0">Belum ada riwayat penerimaan.</p>';
            } else {
                html = '<table class="table table-bordered"><thead><tr><th>Status</th><th>Penerima</th><th>Waktu</th><th>Catatan</th></tr></thead><tbody>';
                $.each(res.data, function(_, item) {
                    html += '<tr><td><span class="badge badge-success">Sudah Diterima</span></td><td>' + (item.nama_penerima || '-') + '</td><td>' + item.diterima_pada + '</td><td>' + (item.catatan || '-') + '</td></tr>';
                });
                html += '</tbody></table>';
            }
            $('#isiRiwayatPenerimaan').html(html);
        }, 'json');
    });
</script>
