<div class="modal fade" id="addexpedisi">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Laporan Expedisi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('tambah_lap_expedisi'); ?>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="id_bar">Tanggal<span class="required">*</span></label>
                        <div class="col-sm-8"><input class="form-control" type="date" id="tanggal" name="tanggal" value="" required /></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="id_bar">Jam Masuk<span class="required">*</span></label>
                        <div class="col-sm-8"><input class="form-control" type="text" id="jammasuk" name="jammasuk" value="" required /></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="id_bar">Jam Keluar<span class="required">*</span></label>
                        <div class="col-sm-8"><input class="form-control" type="text" id="jamkeluar" name="jamkeluar" value="" required /></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="id_bar">No Pol<span class="required">*</span></label>
                        <div class="col-sm-8"><input class="form-control" type="text" id="nopol" name="nopol" value="" required /></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="id_bar">Nama Driver<span class="required">*</span></label>
                        <div class="col-sm-8"><input class="form-control" type="text" id="namadriver" name="namadriver" value="" required /></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="id_bar">No Tlpn Driver<span class="required">*</span></label>
                        <div class="col-sm-8"><input class="form-control" type="text" id="notlpndriver" name="notlpndriver" value="" required /></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="id_bar">Perusahaan Pengirim<span class="required">*</span></label>
                        <div class="col-sm-8"><input class="form-control" type="text" id="perusahaanpengirim" name="perusahaanpengirim" value="" required /></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="id_bar">Nama Barang<span class="required">*</span></label>
                        <div class="col-sm-8"><input class="form-control" type="text" id="namabarang" name="namabarang" value="" required /></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="id_bar">Jumlah Barang<span class="required">*</span></label>
                        <div class="col-sm-8"><input class="form-control" type="text" id="jumlahbarang" name="jumlahbarang" value="" required /></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="id_bar">Keterangan<span class="required">*</span></label>
                        <div class="col-sm-8"><input class="form-control" type="text" id="keterangan" name="keterangan" value="" required /></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="penerima_berkas_id">Penerima Berkas<span class="required">*</span></label>
                        <div class="col-sm-8">
                            <select class="form-control" id="penerima_berkas_id" name="penerima_berkas_id" required>
                                <option value="">Pilih petugas Logistik</option>
                                <?php foreach ($penerima_berkas as $penerima) : ?>
                                    <option value="<?= (int) $penerima->id ?>"><?= html_escape($penerima->nama_user) ?> (<?= html_escape($penerima->username) ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="id_bar">Inputer<span class="required">*</span></label>
                        <div class="col-sm-8">
                            <input type="hidden" id="inputer_default" value="<?= html_escape($this->session->userdata('nama_user')) ?>" />
                            <input class="form-control" type="text" id="inputer" name="inputer" value="<?= html_escape($this->session->userdata('nama_user')) ?>" maxlength="255" required />
                            <small class="form-text text-muted">Nilai awal mengikuti pengguna login dan dapat diganti sesuai petugas Security Pos yang melakukan input.</small>
                        </div>
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
