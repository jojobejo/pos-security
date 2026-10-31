<div class="modal fade" id="addtamu">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Laporan tamu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('tambah_lap_tamu'); ?>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="id_bar">Tanggal<span class="required">*</span></label>
                        <div class="col-sm-8"><input class="form-control" type="date" id="tanggal" name="tanggal" value="" /></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="id_bar">Nama<span class="required">*</span></label>
                        <div class="col-sm-8"><input class="form-control" type="text" id="nama" name="nama" value="" /></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="id_bar">Perusahaan<span class="required">*</span></label>
                        <div class="col-sm-8"><input class="form-control" type="text" id="perusahaan" name="perusahaan" value="" /></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="id_bar">Alamat<span class="required">*</span></label>
                        <div class="col-sm-8"><input class="form-control" type="text" id="alamat" name="alamat" value="" /></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="id_bar">Jumlah Personil<span class="required">*</span></label>
                        <div class="col-sm-8"><input class="form-control" type="text" id="jumlahpersonil" name="jumlahpersonil" value="" /></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="id_bar">Tujuan<span class="required">*</span></label>
                        <div class="col-sm-8"><input class="form-control" type="text" id="tujuan" name="tujuan" value="" /></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="id_bar">Jam Masuk<span class="required">*</span></label>
                        <div class="col-sm-8"><input class="form-control" type="text" id="jammasuk" name="jammasuk" value="" /></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="id_bar">Jam Keluar<span class="required">*</span></label>
                        <div class="col-sm-8"><input class="form-control" type="text" id="jamkeluar" name="jamkeluar" value="" /></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="id_bar">Keterangan<span class="required">*</span></label>
                        <div class="col-sm-8"><input class="form-control" type="text" id="keterangan" name="keterangan" value="" /></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>