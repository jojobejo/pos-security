<div class="modal fade" id="modalInputPaket">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4>Input Laporan Informasi Paket</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form id="formInputPaket">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Penerima</label>
                            <select name="kd_penerima" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <option value="SUPRIYANTO">SUPRI</option>
                                <option value="LADY">LADY</option>
                                <option value="IKA">IKA</option>
                                <option value="NITA">NITA</option>
                                <option value="MIA">MIA</option>
                                <option value="SHEILA">SHEILA</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md">
                            <label>Keterangan</label>
                            <input type="text" name="keterangan_1" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-3">
                            <label>Tanggal Terima POS</label>
                            <input type="date" name="tanggal_terima_1" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>Jam Terima POS</label>
                            <input type="text" name="jam_terima_1" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>Tanggal Terima</label>
                            <input type="date" name="tanggal_terima_2" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>Jam Terima</label>
                            <input type="text" name="jam_terima_2" class="form-control">
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md">
                            <label>Inputer</label>
                            <input type="text" name="inputer" class="form-control" value="" required>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div>
</div>


<div class="modal fade" id="modalKonfirmasi">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('konfirmasi_penerimaan_paket') ?>" method="post">
                <div class="modal-header bg-success">
                    <h5 class="modal-title">Konfirmasi Penerimaan Paket</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="id" id="konfirmasi_id">

                    <div class="form-group">
                        <label>Tanggal Diterima Penerima</label>
                        <input type="date" name="tanggal_terima_2" id="konfirmasi_tanggal" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label>Jam Konfirmasi</label>
                        <input type="text" name="jam_terima_2" id="konfirmasi_jam" class="form-control" readonly>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-success" type="submit">
                        Konfirmasi & Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="modalHapus">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header bg-danger">
                <h5 class="modal-title">Hapus Data Paket</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="hapus_id" name="">
                <p class="text-danger">
                    Data yang dihapus tidak bisa dikembalikan.
                </p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger" id="btnHapus">
                    Ya, Hapus
                </button>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="modalEditPaket">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formEditPaket">
                <div class="modal-header bg-warning">
                    <h5>Edit Laporan Informasi Paket</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id">

                    <div class="row">
                        <div class="col-md-6">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" id="edit_tanggal" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label>Penerima</label>
                            <select name="kd_penerima" id="edit_kd_penerima" class="form-control" required>
                                <option value="KEUANGAN">KEUANGAN</option>
                                <option value="PURCHASING">PURCHASING</option>
                                <option value="KEUANGAN1">KEUANGAN1</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-2">
                        <label>Keterangan Paket</label>
                        <input type="text" name="keterangan_1" id="edit_keterangan_1" class="form-control" required>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label>Tanggal Terima POS</label>
                            <input type="date" name="tanggal_terima_1" id="edit_tanggal_terima_1" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Jam Terima POS</label>
                            <input type="text" name="jam_terima_1" id="edit_jam_terima_1" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-warning" type="submit">Update</button>
                </div>

            </form>

        </div>
    </div>
</div>