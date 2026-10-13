Business Requirement Document (BRD)

Diisi oleh tim (dipimpin Database Architect) pada Sprint (Minggu) 1–2. Mendokumentasikan pemahaman bisnis sebelum desain teknis.

| `============================================================ `<br>`BUSINESS REQUIREMENT DOCUMENT (BRD) `<br>`============================================================ `<br>`Tim / Domain   : Technova  Versi: 1.1`<br>`Tanggal        : 12 Oktober 2026   `<br>1. `KONTEKS BISNIS`<br>&nbsp;&nbsp;• `Deskripsi usaha:`<br>&nbsp;&nbsp;&nbsp;&nbsp;`Platform e-commerce yang menjual produk secara online yang terintegrasi untuk mencatat transaksi, mengelola stok barang, serta memantau kinerja keungan secara real time`<br>• `Tujuan platform bagi usaha ini:`<br>&nbsp;&nbsp;&nbsp;&nbsp;`Menawarkan fitur yang lengkap serta praktis sehingga dapat memberi kemudahan bagi pemilik usaha dalam menjalankan dan mengatur usahanya`<br>2. `PEMANGKU KEPENTINGAN`<br>&nbsp;&nbsp;• `Pemilik usaha   : Memantau laporan keuangan (laba rugi), analisis produk, dan kondisi stok secara keseluruhan untuk pengambilan keputusan strategis`<br>&nbsp;&nbsp;• `Manager         : Monitoring kinerja penjualan (harian/ bulanan/ tahunan), mengelola laporan oprasional, dan mengawasi kinerja pegawai (kasir/ operator dan admin gudang)`<br>&nbsp;&nbsp;• `Admin Gudang    : Mengelola dan memperbarui stok barang monitoring stok barang, serta melakukan penyesuaian stok (stok masuk/keluar/retur)`<br>&nbsp;&nbsp;• `Kasir/operator  : Mencatat transaksi jual beli dengan cepat dan akurat, baik dalam keadaan online maupun offline`<br>&nbsp;&nbsp;• `Pelanggan       : Melakukan transaksi pembelian secara online dengan aman, lancar, dan mendapatkan informasi terkait stok barang yang akurat`<br>3. `KEBUTUHAN FUNGSIONAL  (apa yang sistem HARUS lakukan)`<br>&nbsp;&nbsp;• `FR-01: Sistem dapat mencatat setiap transaksi jual beli secara otomatis, termasuk detail produk, jumlah, harga, dan metode pembayaran. Harga satuan pada setiap item transaksi ditetapkan otomatis oleh sistem berdasarkan harga produk yang berlaku saat transaksi dibuat dan tidak dapat diubah secara manual oleh Kasir/Operator.`<br>&nbsp;&nbsp;• `FR-02: Sistem dapat menyimpan riwayat transaksi dan menampilkannya berdasarkan filter tanggal, pelanggan, atau produk`<br>&nbsp;&nbsp;• `FR-03: Sistem dapat menghasilkan laporan penjualan harian, bulanan, dan tahunan`<br>&nbsp;&nbsp;• `FR-04: Sistem dapat menampilkan laporan kondisi keuangan berupa laba rugi (profit & loss) secara otomatis berdasarkan data transaksi dan biaya operasional. Perhitungan harga pokok penjualan (HPP) menggunakan nilai modal yang tercatat pada saat transaksi terjadi, sehingga laporan periode lalu tidak berubah ketika HPP produk diperbarui di kemudian hari.`<br>&nbsp;&nbsp;• `FR-05: Sistem dapat menghitung dan menampilkan margin keuntungan per produk maupun per periode tertentu`<br>&nbsp;&nbsp;• `FR-06: Sistem dapat menganalisis dan menampilkan daftar barang paling laris (best seller) berdasarkan jumlah unit terjual dalam satu periode tertentu`<br>&nbsp;&nbsp;• `FR-07: Sistem dapat menampilkan grafik/ visualisasi tren penjualan produk dalam periode tertentu`<br>&nbsp;&nbsp;• `FR-08: Sistem dapat menampilkan informasi stok barang secara real time, termasuk stok tersedia, stok menipis, dan stok habis`<br>&nbsp;&nbsp;• `FR-09: Sistem dapat mengirimkan notifikasi otomatis kepada Admin Gudang saat stok barang mencapai batas minimum (low stock alert)`<br>&nbsp;&nbsp;• `FR-10: Sistem dapat memperbarui stok secara otomatis setiap terjadi transaksi penjualan (pengurangan stok) maupun retur (penambahan barang). Setiap perubahan stok (masuk, keluar, retur, maupun penyesuaian/opname) dicatat sebagai riwayat mutasi stok (lihat FR-14).`<br>&nbsp;&nbsp;• `FR-11: Sistem dapat dapat beroperasi dalam mode offline (tanpa koneksi internet) yang kemudian melakukan sinkronisasi secara otomatis ke server saat terhubung kembali ke jaringan. Setiap transaksi yang dibuat di perangkat offline wajib memiliki identitas unik secara global agar tidak bertabrakan dengan transaksi dari perangkat lain.`<br>&nbsp;&nbsp;• `FR-12: Sistem dapat memberikan hak akses kepada Pemilik Usaha, Manajer, Admin Gudang, dan Kasir/Operator sesuai dengan peran dan kewenangan masing-masing (role based access)`<br>&nbsp;&nbsp;• `FR-13: Sistem dapat mengekspor laporan penjualan, keuangan, dan stok ke dalam format PDF/Excel`<br>&nbsp;&nbsp;• `FR-14: Sistem dapat mencatat riwayat mutasi stok (stok masuk, stok keluar, retur, serta penyesuaian/opname) untuk setiap barang, meliputi jenis mutasi, jumlah, waktu, dan pengguna yang melakukannya, sebagai jejak audit (audit trail) dan dasar penelusuran selisih stok`<br>&nbsp;&nbsp;• `FR-15: Sistem dapat mencatat log sinkronisasi untuk setiap pengiriman data dari mode offline, meliputi perangkat/POS asal, waktu, status (berhasil/gagal/sebagian), dan jumlah data yang dikirim, sehingga kegagalan atau gangguan koneksi pada pengiriman data dalam jumlah besar (batch) dapat dilacak dan dilanjutkan`<br>4. `KEBUTUHAN NON-FUNGSIONAL  (kualitas: performa, keamanan...)`<br>&nbsp;&nbsp;• `NFR-01: Performa — Pencatatan transaksi diproses dalam waktu kurang dari 2 (dua) detik per transaksi, termasuk pada kondisi grafik tinggi`<br>&nbsp;&nbsp;• `NFR-02: Keamanan — Data Transaksi dan keuangan dienkripsi dan hanya dapat diakses oleh pihak yang memiliki wewenang sesuai perannya. Validasi harga transaksi wajib dilakukan di sisi server/basis data sehingga harga tidak dapat dimanipulasi dari sisi klien (kasir atau perangkat POS).`<br>&nbsp;&nbsp;• `NFR-03: Ketersediaan — Sistem dapat diakses minimal 90% uptime, dengan dukungan mode offline agar operasional tidak terganggu saat jaringan terputus`<br>&nbsp;&nbsp;• `NFR-04: Skalabilitas — Sistem mampu menangani pertumbuhan jumlah transaksi dan produk seiring berkembangnya bisnis`<br>&nbsp;&nbsp;• `NFR-05: Kompabilitas — Sistem dapat diakses melalui berbagai macam perangkat`<br>&nbsp;&nbsp;• `NFR-06: Sinkronisasi Data — Proses sinkronisasi antar mode offline dan online berjalan otomatis tanpa terdapat duplikasi ataupun kehilangan data. Setiap transaksi memiliki identitas unik secara global (mis. UUID) agar tidak terjadi tabrakan ID saat data dari beberapa perangkat offline disinkronkan bersamaan, dan setiap proses sinkronisasi dapat dilacak asal perangkatnya (lihat FR-15).`<br>&nbsp;&nbsp;• `NFR-07: usability — Antarmuka sistem mudah digunakan oleh kasir/operator dengan pelatihan minimal`<br>5. `ATURAN BISNIS  (batasan & kebijakan)`<br>&nbsp;&nbsp;• `BR-01: Setiap transaksi penjualan wajib mengurangi stok barang terkait secara otomatis dan real time. Setiap perubahan stok (termasuk retur dan penyesuaian manual/opname) wajib tercatat dalam riwayat mutasi stok yang tidak dapat dihapus.`<br>&nbsp;&nbsp;• `BR-02: Laporan laba rugi dihitung dari selisih total pendapatan penjualan dengan total biaya (harga pokok penjualan dan biaya oprasional) pada periode yang sama. HPP yang digunakan adalah HPP pada saat transaksi terjadi, bukan HPP terbaru.`<br>&nbsp;&nbsp;• `BR-03: Transaksi dalam mode offline wajib disinkronkan ke server pusat paling lambat 24 jam setelah jaringan kembali terhubung. Setiap sinkronisasi wajib dapat dilacak berdasarkan perangkat asal dan statusnya.`<br>&nbsp;&nbsp;• `BR-04: Barang dengan stok dibawah batas minimum akan ditandai secara otomatis “stok menipis” dan akan mengirimkan notifikasi ke Admin Gudang`<br>&nbsp;&nbsp;• `BR-05: Hanya pemilik usaha dan manajer yang memilikin akses penuh terhadap laporan keuangan`<br>&nbsp;&nbsp;• `BR-06: Harga pokok (modal) per unit pada setiap item transaksi wajib dikunci saat transaksi terjadi dan tidak berubah meskipun HPP produk diperbarui di kemudian hari`<br>&nbsp;&nbsp;• `BR-07: Harga jual pada transaksi wajib mengikuti harga produk yang berlaku saat transaksi dibuat dan tidak dapat diubah secara manual oleh Kasir/Operator`<br>6. `ASUMSI & PERTANYAAN TERBUKA`<br>&nbsp;&nbsp;• `Asumsi :`<br>&nbsp;&nbsp;&nbsp;&nbsp;• `Bisnis client sudah memiliki data produk dan harga awal yang siap di input`<br>&nbsp;&nbsp;&nbsp;&nbsp;• `Sistem akan digunakan oleh tim internal dan terintegrasi dengan platform e-commerce`<br>&nbsp;&nbsp;&nbsp;&nbsp;• `Koneksi internet tersedia secara berkala untuk keperluan sinkronisasi data pada mode offline`<br>&nbsp;&nbsp;• `Perlu klarifikasi:`<br>&nbsp;&nbsp;&nbsp;&nbsp;• `Apakah sistem perlu terintegrasi dengan payment gateway pihak ketiga untuk metode pembayaran online?`<br>&nbsp;&nbsp;&nbsp;&nbsp;• `Apakah diperlukan fitur multi-gudang/ multi-lokasi penyimpanan stok?`<br>&nbsp;&nbsp;&nbsp;&nbsp;• `Berapa estimasi jumlah maksimal produk dan volume transaksi yang perlu diakomodasi sistem?`<br>&nbsp;&nbsp;&nbsp;&nbsp;• `Apakah diperlukan integrasi dengan marketplace pihak ketiga (Tokopedia, Shopee, dll)`<br>&nbsp;&nbsp;&nbsp;&nbsp;• `Apakah Kasir/Operator diperbolehkan memberi diskon atau mengubah harga dengan persetujuan Manajer (override harga)?`<br>&nbsp;&nbsp;&nbsp;&nbsp;• `Bagaimana kebijakan jika sinkronisasi gagal (jumlah percobaan ulang dan pihak yang diberi notifikasi)?`<br>7. `CATATAN PERUBAHAN  (diisi saat requirement berubah)`<br>&nbsp;&nbsp;• `V 1.0 : Draft awal yang disusun oleh tim berdasarkan permintaan kebutuhan awal client platform      e-commerce`<br>&nbsp;&nbsp;• `V 1.1 : Revisi berdasarkan evaluasi Ahli Basis Data (12 Oktober 2026): identitas transaksi unik untuk sinkronisasi offline (FR-11, NFR-06), penguncian HPP historis (FR-04, BR-02, BR-06), riwayat mutasi stok/audit trail (FR-10, FR-14, BR-01), penguncian harga transaksi (FR-01, NFR-02, BR-07), dan log sinkronisasi per perangkat (FR-15, BR-03)`<br>&nbsp;&nbsp;`============================================================ ` |
| --- |

# 8. SKEMA ENTITAS, ATRIBUT & TIPE DATA

Bagian ini menjabarkan rancangan awal skema basis data sebagai turunan teknis dari kebutuhan fungsional pada Bagian 3. Skema dibatasi pada 10 entitas inti yang mendukung lima kebutuhan utama client (pencatatan transaksi jual beli, laporan, laba rugi, analisis barang terlaris, dan informasi stok) serta kebutuhan pendukung berupa retur, pencatatan pergerakan stok, dan sinkronisasi offline. Keterangan: PK = Primary Key, FK = Foreign Key.

## 8.1 Pengguna

| **Atribut** | **Tipe Data** | **Keterangan** |
| --- | --- | --- |
| **id_pengguna** | INT | PK, auto increment |
| **nama** | VARCHAR(100) | Nama lengkap pengguna |
| **email** | VARCHAR(100) | Unik, digunakan untuk login |
| **kata_sandi** | VARCHAR(255) | Kata sandi terenkripsi |
| **peran** | ENUM('pemilik','manajer','admin_gudang','kasir') | Menentukan hak akses (FR-12) |
| **telepon** | VARCHAR(20) | Nomor telepon |
| **status_aktif** | BOOLEAN | Status akun aktif/nonaktif |
| **dibuat_pada** | DATETIME | Waktu akun dibuat |
| **diperbarui_pada** | DATETIME | Waktu data terakhir diubah |

## 8.2 Pelanggan

| **Atribut** | **Tipe Data** | **Keterangan** |
| --- | --- | --- |
| **id_pelanggan** | INT | PK, auto increment |
| **nama** | VARCHAR(100) | Nama pelanggan |
| **email** | VARCHAR(100) | Unik, email pelanggan |
| **telepon** | VARCHAR(20) | Nomor telepon pelanggan |
| **alamat** | TEXT | Alamat pengiriman |
| **dibuat_pada** | DATETIME | Waktu pelanggan terdaftar |

## 8.3 Kategori

| **Atribut** | **Tipe Data** | **Keterangan** |
| --- | --- | --- |
| **id_kategori** | INT | PK, auto increment |
| **nama_kategori** | VARCHAR(100) | Nama kategori produk |
| **deskripsi** | TEXT | Deskripsi singkat kategori |

## 8.4 Produk

| **Atribut** | **Tipe Data** | **Keterangan** |
| --- | --- | --- |
| **id_produk** | INT | PK, auto increment |
| **id_kategori** | INT | FK -> Kategori.id_kategori |
| **kode_sku** | VARCHAR(50) | Unik, kode identifikasi produk |
| **nama_produk** | VARCHAR(150) | Nama produk |
| **deskripsi** | TEXT | Deskripsi produk |
| **harga_pokok** | DECIMAL(12,2) | Harga pokok penjualan (HPP), dasar laba rugi (FR-04, FR-05) |
| **harga_jual** | DECIMAL(12,2) | Harga jual produk |
| **satuan** | VARCHAR(20) | Satuan barang (pcs, kg, box, dsb.) |
| **jumlah_stok** | INT | Stok tersedia real-time, diperbarui otomatis dari Riwayat Stok (FR-08, FR-10) |
| **stok_minimum** | INT | Batas minimum stok, pemicu notifikasi (FR-09) |
| **status_aktif** | BOOLEAN | Status produk aktif dijual atau tidak |
| **dibuat_pada** | DATETIME | Waktu produk dibuat |
| **diperbarui_pada** | DATETIME | Waktu data terakhir diubah |

## 8.5 Transaksi

| **Atribut** | **Tipe Data** | **Keterangan** |
| --- | --- | --- |
| **id_transaksi** | CHAR(36) | PK, UUID agar tidak bentrok antar perangkat saat offline (NFR-06) |
| **kode_transaksi** | VARCHAR(30) | Unik, nomor/kode transaksi |
| **id_pelanggan** | INT | FK -> Pelanggan.id_pelanggan (boleh kosong) |
| **id_pengguna** | INT | FK -> Pengguna.id_pengguna (kasir/operator) |
| **tanggal_transaksi** | DATETIME | Tanggal & waktu transaksi (FR-01) |
| **status** | ENUM('pending','lunas','selesai','dibatalkan','diretur') | Status transaksi |
| **saluran** | ENUM('online','offline') | Saluran transaksi, mendukung mode hybrid (FR-11) |
| **status_sinkronisasi** | ENUM('tersinkron','menunggu_sinkron') | Status sinkronisasi data offline ke server |
| **subtotal** | DECIMAL(14,2) | Total sebelum diskon dan pajak |
| **diskon** | DECIMAL(14,2) | Nilai diskon |
| **pajak** | DECIMAL(14,2) | Nilai pajak |
| **total_bayar** | DECIMAL(14,2) | Total akhir yang harus dibayar |
| **waktu_sinkronisasi** | DATETIME | Waktu data tersinkron ke server, untuk cek batas 24 jam (BR-04) |
| **dibuat_pada** | DATETIME | Waktu data dibuat |

## 8.6 Detail Transaksi

| **Atribut** | **Tipe Data** | **Keterangan** |
| --- | --- | --- |
| **id_detail** | INT | PK, auto increment |
| **id_transaksi** | CHAR(36) | FK -> Transaksi.id_transaksi |
| **id_produk** | INT | FK -> Produk.id_produk |
| **jumlah** | INT | Jumlah unit produk yang dibeli |
| **harga_satuan** | DECIMAL(12,2) | Harga jual satuan saat transaksi |
| **harga_pokok** | DECIMAL(12,2) | HPP satuan saat transaksi, agar laba rugi periode lalu tidak berubah (BR-02) |
| **subtotal** | DECIMAL(14,2) | jumlah x harga_satuan, dasar analisis barang terlaris (FR-06) |

## 8.7 Pembayaran

| **Atribut** | **Tipe Data** | **Keterangan** |
| --- | --- | --- |
| **id_pembayaran** | INT | PK, auto increment |
| **id_transaksi** | CHAR(36) | FK -> Transaksi.id_transaksi |
| **metode_pembayaran** | ENUM('tunai','transfer','e-wallet','kartu') | Metode pembayaran |
| **jumlah_dibayar** | DECIMAL(14,2) | Nominal yang dibayarkan |
| **status_pembayaran** | ENUM('menunggu','berhasil','gagal') | Status pembayaran |
| **dibayar_pada** | DATETIME | Waktu pembayaran diterima |

## 8.8 Retur

| **Atribut** | **Tipe Data** | **Keterangan** |
| --- | --- | --- |
| **id_retur** | INT | PK, auto increment |
| **id_transaksi** | CHAR(36) | FK -> Transaksi.id_transaksi |
| **id_produk** | INT | FK -> Produk.id_produk |
| **jumlah** | INT | Jumlah unit yang dikembalikan |
| **alasan** | TEXT | Alasan retur |
| **tanggal_retur** | DATETIME | Tanggal retur diproses |
| **id_pengguna** | INT | FK -> Pengguna.id_pengguna (pemroses retur) |

## 8.9 Riwayat Stok

| **Atribut** | **Tipe Data** | **Keterangan** |
| --- | --- | --- |
| **id_riwayat** | INT | PK, auto increment |
| **id_produk** | INT | FK -> Produk.id_produk |
| **jenis_pergerakan** | ENUM('masuk','keluar','retur','penyesuaian') | Jenis perubahan stok (FR-10) |
| **jumlah** | INT | Jumlah unit yang bertambah/berkurang |
| **id_transaksi** | CHAR(36) | FK -> Transaksi.id_transaksi (boleh kosong) |
| **id_retur** | INT | FK -> Retur.id_retur (boleh kosong) |
| **catatan** | TEXT | Keterangan tambahan |
| **id_pengguna** | INT | FK -> Pengguna.id_pengguna (pencatat, mis. Admin Gudang) |
| **dicatat_pada** | DATETIME | Waktu pergerakan stok dicatat |

## 8.10 Biaya Operasional

| **Atribut** | **Tipe Data** | **Keterangan** |
| --- | --- | --- |
| **id_biaya** | INT | PK, auto increment |
| **kategori_biaya** | VARCHAR(100) | Jenis biaya (sewa, gaji, listrik, dsb.) |
| **deskripsi** | TEXT | Deskripsi biaya |
| **jumlah** | DECIMAL(14,2) | Nominal biaya, dasar laba rugi (FR-04, BR-02) |
| **tanggal_biaya** | DATE | Tanggal biaya terjadi |
| **id_pengguna** | INT | FK -> Pengguna.id_pengguna (pencatat) |

## 8.11 Relasi Antar Entitas

| **Entitas Asal** | **Atribut FK** | **Mengacu ke** | **Kardinalitas** |
| --- | --- | --- | --- |
| **Produk** | id_kategori | Kategori.id_kategori | banyak ke satu |
| **Transaksi** | id_pelanggan | Pelanggan.id_pelanggan | banyak ke satu |
| **Transaksi** | id_pengguna | Pengguna.id_pengguna | banyak ke satu |
| **Detail Transaksi** | id_transaksi | Transaksi.id_transaksi | banyak ke satu |
| **Detail Transaksi** | id_produk | Produk.id_produk | banyak ke satu |
| **Pembayaran** | id_transaksi | Transaksi.id_transaksi | banyak ke satu |
| **Retur** | id_transaksi | Transaksi.id_transaksi | banyak ke satu |
| **Retur** | id_produk | Produk.id_produk | banyak ke satu |
| **Retur** | id_pengguna | Pengguna.id_pengguna | banyak ke satu |
| **Riwayat Stok** | id_produk | Produk.id_produk | banyak ke satu |
| **Riwayat Stok** | id_transaksi | Transaksi.id_transaksi | banyak ke satu (opsional) |
| **Riwayat Stok** | id_retur | Retur.id_retur | banyak ke satu (opsional) |
| **Riwayat Stok** | id_pengguna | Pengguna.id_pengguna | banyak ke satu |
| **Biaya Operasional** | id_pengguna | Pengguna.id_pengguna | banyak ke satu |

Catatan: satu Transaksi dapat memiliki banyak Detail Transaksi dan satu Detail Transaksi mengacu ke satu Produk. Laporan penjualan, laba rugi, dan analisis barang terlaris diturunkan dari data Transaksi, Detail Transaksi, Produk, dan Biaya Operasional, sedangkan informasi stok dibaca dari atribut jumlah_stok pada Produk yang diperbarui otomatis setiap ada baris baru di Riwayat Stok (penjualan, retur, stok masuk, atau penyesuaian). HPP disimpan pada Detail Transaksi agar laporan laba rugi periode lalu tetap konsisten.
