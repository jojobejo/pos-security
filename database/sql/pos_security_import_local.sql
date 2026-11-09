-- Jalankan sekali pada skema tujuan yang baru dibuat, memakai klien mysql tanpa --force.
-- Sumber: salinan lokal ERP (data POS) dan kiucoid_kpi (satu set data General Check Truck).
-- Expedisi dari salinan ERP memakai format lama, sehingga status penerimaan memakai nilai awal.
START TRANSACTION WITH CONSISTENT SNAPSHOT;

INSERT INTO `hrdga_user` SELECT * FROM `kiucoid_karismaerp_local`.`tb_user`;
INSERT INTO `hrdga_lap_distribusi` SELECT * FROM `kiucoid_karismaerp_local`.`tb_lap_distribusi`;
INSERT INTO `hrdga_tamu` SELECT * FROM `kiucoid_karismaerp_local`.`tb_tamu`;
INSERT INTO `hrdga_tamu_lby` SELECT * FROM `kiucoid_karismaerp_local`.`tb_tamu_lby`;
INSERT INTO `hrdga_service_truk` SELECT * FROM `kiucoid_karismaerp_local`.`tb_service_truk`;
INSERT INTO `hrdga_karyawan_keluarmasuk` SELECT * FROM `kiucoid_karismaerp_local`.`tb_karyawan_keluarmasuk`;
INSERT INTO `hrdga_expedisi` (`id`, `tanggal`, `jammasuk`, `jamkeluar`, `nopol`, `namadriver`, `notlpndriver`, `perusahaanpengirim`, `namabarang`, `jumlahbarang`, `keterangan`, `nm_inputer`)
SELECT `id`, `tanggal`, `jammasuk`, `jamkeluar`, `nopol`, `namadriver`, `notlpndriver`, `perusahaanpengirim`, `namabarang`, `jumlahbarang`, `keterangan`, `nm_inputer`
FROM `kiucoid_karismaerp_local`.`tb_expedisi`;
INSERT INTO `hrdga_issue` SELECT * FROM `kiucoid_karismaerp_local`.`tb_issue`;
INSERT INTO `hrdga_op_plat` SELECT * FROM `kiucoid_karismaerp_local`.`tb_op_plat`;
INSERT INTO `hrdga_op_driver` (`id`, `kd_driver`, `nama_driver`, `status`, `create_at`)
SELECT `id`, `kd_driver`, `nama_driver`, `status`, `create_at`
FROM `kiucoid_karismaerp_local`.`tb_op_driver`;
INSERT INTO `hrdga_op_helper` SELECT * FROM `kiucoid_karismaerp_local`.`tb_op_helper`;
INSERT INTO `hrdga_order_tracking_driver` SELECT * FROM `kiucoid_karismaerp_local`.`tb_order_tracking_driver`;
INSERT INTO `hrdga_det_tracking_driver` SELECT * FROM `kiucoid_karismaerp_local`.`tb_det_tracking_driver`;
INSERT INTO `hrdga_tmp_lap_distribusi` SELECT * FROM `kiucoid_karismaerp_local`.`tb_tmp_lap_distribusi`;
INSERT INTO `hrdga_checkup_mekanik` SELECT * FROM `kiucoid_kpi`.`tb_checkup_mekanik`;
INSERT INTO `hrdga_checkup_mekanik_kategori` SELECT * FROM `kiucoid_kpi`.`tb_checkup_mekanik_kategori`;
INSERT INTO `hrdga_checkup_mekanik_kategori_detail` SELECT * FROM `kiucoid_kpi`.`tb_checkup_mekanik_kategori_detail`;
INSERT INTO `hrdga_checkup_mekanik_detail` SELECT * FROM `kiucoid_kpi`.`tb_checkup_mekanik_detail`;
INSERT INTO `hrdga_checkup_mekanik_kategori_foto` SELECT * FROM `kiucoid_kpi`.`tb_checkup_mekanik_kategori_foto`;

INSERT INTO `hrdga_terima_paket` SELECT * FROM `kiucoid_karismaerp_local`.`tb_terima_paket`;
INSERT INTO `hrdga_checklist_kendaraan` SELECT * FROM `kiucoid_karismaerp_local`.`tb_checklist_kendaraan`;
INSERT INTO `hrdga_checklist_kendaraan_detail` SELECT * FROM `kiucoid_karismaerp_local`.`tb_checklist_kendaraan_detail`;
INSERT INTO `hrdga_gbrupload_cheklist` SELECT * FROM `kiucoid_karismaerp_local`.`tb_gbrupload_cheklist`;

INSERT INTO `hrdga_docsdig_access` SELECT * FROM `kiucoid_karismaerp_local`.`docsdig_access`;
INSERT INTO `hrdga_docsdig_documents` SELECT * FROM `kiucoid_karismaerp_local`.`docsdig_documents`;
INSERT INTO `hrdga_docsdig_audit` SELECT * FROM `kiucoid_karismaerp_local`.`docsdig_audit`;
INSERT INTO `hrdga_docsdig_reminder_reads` SELECT * FROM `kiucoid_karismaerp_local`.`docsdig_reminder_reads`;

COMMIT;

-- Keep newly created documents from reusing IDs still referenced in the audit history.
SET @archive_next_id = (
    SELECT GREATEST(
        COALESCE((SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES
                  WHERE TABLE_SCHEMA = 'kiucoid_karismaerp_local' AND TABLE_NAME = 'docsdig_documents'), 1),
        COALESCE(MAX(document_id), 0) + 1
    )
    FROM hrdga_docsdig_audit
);
SET @archive_sequence_sql = CONCAT('ALTER TABLE hrdga_docsdig_documents AUTO_INCREMENT = ', @archive_next_id);
PREPARE archive_sequence FROM @archive_sequence_sql;
EXECUTE archive_sequence;
DEALLOCATE PREPARE archive_sequence;
