# Janji
Saya Muhammad Farhan dengan NIM 2309323 mengerjakan Tugas Praktikum 8 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

# Desain dan Alur Program Sistem Perpustakaan

## Struktur MVC (Model-View-Controller)

![Image](https://github.com/user-attachments/assets/6652fd78-69d4-429f-937b-c1b0a8311fd4)

### 1. Controllers

**Buku.controller.php**

- Menangani semua operasi CRUD untuk buku  
- Menerima request dari view dan memanggil model yang sesuai  
- Mengarahkan hasil pemrosesan ke view yang tepat  

**Mahasiswa.controller.php**

- Mengelola operasi CRUD untuk data mahasiswa  
- Menerima request dari view dan memanggil model yang sesuai  
- Mengarahkan hasil pemrosesan ke view yang tepat  

**Peminjam.controller.php**

- Mengelola operasi CRUD untuk data peminjaman
- Menerima request dari view dan memanggil model yang sesuai  
- Mengarahkan hasil pemrosesan ke view yang tepat  

---

### 2. Database

**conf.php**

- Berisi konfigurasi koneksi database (host, username, password, nama database)  
- Menyimpan konstanta dan parameter aplikasi  

**perpustakaan.sql**

- Definisi struktur tabel (buku, mahasiswa, peminjaman)  
- Relasi antar tabel  
- Data awal/sample untuk aplikasi  

---

### 3. Models

**Buku.class.php**

- Class dengan properti buku (id, judul, pengarang, dll)  
- Method CRUD untuk entitas buku  

**DB.php**

- Class dasar untuk koneksi database  
- Method umum untuk query database  
- Penanganan error database  

**Mahasiswa.class.php**

- Properti mahasiswa (nim, nama, jurusan, dll)  
- Method CRUD untuk entitas mahasiswa  

**Peminjam.class.php**

- Mengelola data transaksi peminjaman  
- Method untuk proses pinjam dan kembali   

---

### 4. Templates

**index.html**

- Template utama yang digunakan di seluruh aplikasi  
- Berisi header, footer, navigasi, dan area konten  

---

### 5. Views

**Buku.views.php**

- Tampilan form dan tabel data buku  
- Halaman untuk menampilkan daftar buku  

**Mahasiswa.views.php**

- Tampilan form dan tabel data mahasiswa  
- Halaman untuk menampilkan daftar mahasiswa  

**Peminjam.views.php**

- Tampilan form peminjaman dan pengembalian  
- Halaman untuk menampilkan daftar peminjaman  

**Template.class.php**

- Class untuk mengelola template dan render view  
- Method untuk menyisipkan konten ke template  

**buku.php, index.php, mahasiswa.php**

- Entry point untuk halaman masing-masing modul   
- Memanggil controller yang sesuai  

---

## Alur Program

### Alur Umum

- User mengakses salah satu halaman utama (index.php, buku.php, atau mahasiswa.php)  
- File entry point memanggil controller yang sesuai  
- Controller mengambil data dari model  
- Controller menyiapkan data untuk view  
- View menampilkan data dengan menggunakan template  

---

### Alur CRUD untuk Semua Entitas (Buku, Mahasiswa, Peminjaman)

#### 1. Tambah Data

- Form tambah tersedia langsung di halaman utama setiap entitas  
- User mengisi form dan menekan tombol "Simpan"  
- Data dikirim ke controller via method POST  
- Controller memanggil model untuk menyimpan data ke database  
- Tabel data di-refresh untuk menampilkan data baru  

#### 2. Tampil Data

- Controller mengambil semua data dari model  
- Data ditampilkan dalam format tabel di halaman view  
- Tabel berisi kolom-kolom sesuai entitas dan tombol aksi (Edit, Hapus)  

#### 3. Edit Data

- User menekan tombol "Edit" pada baris data di tabel  
- Form edit muncul dengan data yang sudah terisi  
- User mengubah data dan menekan tombol "Update"  
- Controller memanggil model untuk update data di database  
- Tabel data di-refresh dengan data yang sudah diperbarui  

#### 4. Hapus Data

- User menekan tombol "Hapus" pada baris data di tabel  
- Konfirmasi hapus muncul  
- Jika dikonfirmasi, controller memanggil model untuk hapus data  
- Data dihapus dari database dan tabel di-refresh  

---

## Implementasi Form dan Tabel

### Form Input/Edit

- Form tambah data ditampilkan langsung di halaman utama  
- Form edit muncul ketika user menekan tombol "Edit" di tabel  
- Form berisi field sesuai entitas yang dikelola  
- Validasi input dilakukan di sisi client dan server  
- Tombol aksi untuk Submit dan Cancel  

### Tabel Data

- Menampilkan semua data dari database  
- Header kolom sesuai field entitas  
- Setiap baris data dilengkapi dengan tombol aksi (Edit, Hapus)  
- Kemungkinan ada fitur sorting dan filtering  
- Pagination untuk navigasi data yang banyak  

---

## Hubungan Antar Komponen

### Relasi Database

- Tabel Buku: id_buku (PK), judul, pengarang, penerbit, tahun_terbit, stok, dll  
- Tabel Mahasiswa: nim (PK), nama, jurusan, alamat, kontak, dll  
- Tabel Peminjaman: id_pinjam (PK), id_buku (FK), nim (FK), tanggal_pinjam, tanggal_kembali, status, denda  

### Interaksi Antar Komponen

- Controllers menggunakan Models untuk operasi data  
- Controllers menyiapkan data untuk Views  
- Views menampilkan data menggunakan Templates  
- Templates memberikan kerangka umum untuk semua halaman  
- Entry points (buku.php, index.php, mahasiswa.php) menginisialisasi alur program  

---

## Dokumnetasi

![Image](https://github.com/user-attachments/assets/550356b6-b335-458b-a51a-7ad5470cf7dd)

![Image](https://github.com/user-attachments/assets/1501893c-1b9a-43d0-8602-9bb9a2b48d17)

![Image](https://github.com/user-attachments/assets/ef93e566-080e-4cea-9aeb-b5941a218e26)

https://github.com/user-attachments/assets/1ef38a0c-8439-4d1b-a35e-db98ba38b6bc
