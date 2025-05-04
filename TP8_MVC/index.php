<?php
include_once("Views/Template.class.php");
include_once("Controllers/Peminjam.controller.php");
include_once("Controllers/Mahasiswa.controller.php");
include_once("Controllers/Buku.controller.php");
include_once("Models/DB.php");

$peminjam = new PeminjamController();

// Menangani aksi tambah
if (isset($_POST['add'])) {
  // Ambil data dari form dengan validasi sederhana
  $data = [
    'mahasiswa_id'     => intval($_POST['nama_mhs']),       // Pastikan integer
    'buku_id'          => intval($_POST['id_buku']),        // Pastikan integer
    'tanggal_pinjam'   => $_POST['tanggal_pinjam'],         // Validasi bisa ditambah
    'tanggal_kembali'  => $_POST['tanggal_kembali'],
    'status'           => htmlspecialchars($_POST['status']) // Hindari XSS
  ];

  $peminjam->Add($data);

  // Redirect setelah penambahan
  header("Location: index.php");
  exit();
}

// Menangani aksi hapus
else if (isset($_GET['action']) && $_GET['action'] == 'delete' && !empty($_GET['id'])) {
  $id = intval($_GET['id']);  // Pastikan ID berupa angka
  $peminjam->delete($id);     // Panggil method delete dari controller
  header("Location: index.php");
  exit();
}

// Menangani aksi edit untuk mendapatkan data berdasarkan ID
else if (!empty($_GET['id'])) {
  // Ambil data dari form edit
  $id = $_GET['id'];
  $peminjam->edit($id); // ini bisa arahkan ke form edit atau update langsung
}

// Menangani aksi update setelah form edit disubmit
else if (!empty($_GET['action']) && $_GET['action'] == 'update') {
  // Cek apakah form di-submit
  if (isset($_POST['edit'])) {
    // Ambil data dari form
    $data = [
      'id'              => $_POST['id_peminjaman'],  // ID peminjaman
      'mahasiswa_id'    => $_POST['nama_mhs'],       // ID mahasiswa
      'buku_id'         => $_POST['id_buku'],        // ID buku
      'tanggal_pinjam'  => $_POST['tanggal_pinjam'], // Tanggal pinjam
      'tanggal_kembali' => $_POST['tanggal_kembali'], // Tanggal kembali
      'status'          => $_POST['status'],         // Status peminjaman
    ];

    // Kirim ke model untuk di-update
    $peminjam->update($data); // Panggil fungsi update di model

    // Setelah berhasil update, arahkan kembali ke index.php
    header("location:index.php");
    exit();
  }
}

// Menampilkan daftar peminjam
else {
  $peminjam->index(); // menampilkan daftar semua peminjam
}

?>
