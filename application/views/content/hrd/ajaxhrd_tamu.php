<script>
    $(document).ready(function() {

        // === INIT DATATABLE LAP TAMU ===
        var tableTamu = $('#tb_lap_distribusi_tamu').DataTable({
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                url: "<?= base_url('lap_tamu_serverside') ?>",
                type: "POST"
            },
            columnDefs: [{
                targets: -1,
                orderable: false
            }]
        });

        // === EDIT TAMU ===
        $('#tb_lap_distribusi_tamu').on('click', '.btn-edit', function() {
            let id = $(this).data('id');

            $.ajax({
                url: "<?= base_url('get_tamu_by_id/') ?>" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#edit_id').val(data.id);
                    $('#edit_nama').val(data.nama);
                    $('#edit_tanggal').val(data.tanggal);
                    $('#edit_alamat').val(data.alamat);
                    $('#edit_personil').val(data.jumlahpersonil);
                    $('#edit_perusahaan').val(data.perusahaan);
                    $('#edit_tujuan').val(data.tujuan);
                    $('#edit_jmmasuk').val(data.jammasuk);
                    $('#edit_jmkeluar').val(data.jamkeluar);
                    $('#edit_keterangan').val(data.keterangan);
                    $('#edit_inputer').val(data.nm_inputer);
                    $('#modalEditTamu').modal('show');
                }
            });
        });

        // === HAPUS TAMU (SHOW MODAL) ===
        $('#tb_lap_distribusi_tamu').on('click', '.btn-hapus', function() {
            $('#hapus_id').val($(this).data('id'));
            $('#modalHapusTamu').modal('show');
        });

        // === EKSEKUSI HAPUS ===
        $('#btnHapus').click(function() {
            $.ajax({
                url: "<?= base_url('hrd/hapus_tamu') ?>",
                type: "POST",
                data: {
                    id: $('#hapus_id').val()
                },
                dataType: "JSON",
                success: function() {
                    $('#modalHapusTamu').modal('hide');
                    tableTamu.ajax.reload(null, false);
                }
            });
        });

    });
</script>