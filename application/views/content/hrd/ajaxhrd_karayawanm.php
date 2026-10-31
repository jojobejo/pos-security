<script>
    $(document).ready(function() {

        var table = $('#tb_lap_karyawan_masuk_keluar').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?= base_url('lap_karykm_serverside') ?>",
                type: "POST"
            },
            order: [],
            columnDefs: [{
                targets: -1,
                orderable: false
            }]
        });

        // SHOW EDIT
        $('#tb_lap_karyawan_masuk_keluar').on('click', '.btn-edit', function() {
            let id = $(this).data('id');

            $.getJSON("<?= base_url('get_karykm_by_id/') ?>" + id, function(d) {
                $('#edit_id').val(d.id);
                $('#edit_tanggal').val(d.tanggal);
                $('#edit_nama').val(d.nama);
                $('#edit_departemen').val(d.departemen);
                $('#edit_status').val(d.status);
                $('#edit_jamkeluar').val(d.jamkeluar);
                $('#edit_jammasuk').val(d.jammasuk);
                $('#edit_nopol').val(d.nopol);
                $('#edit_keterangan').val(d.keterangan);

                $('#modalEditKary').modal('show');
            });
        });

        $('#formEditKary').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: "<?= base_url('edit_lap_Karyawan_KM') ?>",
                type: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function(res) {
                    if (res.status === true) {
                        $('#modalEditKary').modal('hide');
                        table.ajax.reload(null, false);
                    }
                },
                error: function() {
                    alert('Update gagal. Backend tidak responsif.');
                }
            });
        });


        // SHOW HAPUS
        $('#tb_lap_karyawan_masuk_keluar').on('click', '.btn-hapus', function() {
            $('#hapus_id').val($(this).data('id'));
            $('#modalHapusKary').modal('show');
        });

        // EKSEKUSI HAPUS
        $('#btnHapusKary').click(function() {
            $.post("<?= base_url('hapus_karykm') ?>", {
                id: $('#hapus_id').val()
            }, function() {
                $('#modalHapusKary').modal('hide');
                table.ajax.reload(null, false);
            }, 'json');
        });

    });
</script>