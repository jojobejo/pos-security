# Database: perbaikan penyimpanan privat arsip

Tanggal: 12 November 2026.

Tidak ada perubahan skema database (no schema change), migrasi SQL, atau perubahan data database pada perbaikan ini. Perubahan hanya pada library penyimpanan, dokumentasi, dan penyiapan direktori/ACL lokal.

Referensi `storage_name` yang sudah tersimpan tetap dipakai. Database tidak berisi isi berkas lampiran; pemulihan lampiran lama memerlukan backup direktori privat dengan nama file yang sesuai. Cadangkan dan pulihkan database serta direktori privat sebagai satu set.
