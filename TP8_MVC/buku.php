<?php
include_once("Views/Template.class.php");
include_once("Controllers/Buku.controller.php");
include_once("Models/DB.php");

$buku = new BukuController();

// Menangani aksi tambah
if (isset($_POST['add'])) {
  // Ambil data dari form dengan validasi sederhana
  $data = [
    'judul'          => htmlspecialchars($_POST['judul']),
    'pengarang'      => htmlspecialchars($_POST['pengarang']),
    'penerbit'       => htmlspecialchars($_POST['penerbit']),
    'tahun_terbit'   => intval($_POST['tahun_terbit']),
    'jumlah_halaman' => intval($_POST['jumlah_halaman']),
    'stok'           => intval($_POST['stok'])
  ];

  $buku->Add($data);

  // Redirect setelah penambahan
  header("Location: buku.php");
  exit();
}

// Menangani aksi hapus
else if (isset($_GET['action']) && $_GET['action'] == 'delete' && !empty($_GET['id'])) {
  $id = intval($_GET['id']);  // Pastikan ID berupa angka
  $buku->delete($id);         // Panggil method delete dari controller
  header("Location: buku.php");
  exit();
}

// Menangani aksi edit untuk mendapatkan data berdasarkan ID
else if (!empty($_GET['id'])) {
  // Ambil data untuk form edit
  $id = intval($_GET['id']);
  $buku->edit($id); // ini akan menampilkan form edit dengan data yang dipilih
}

// Menangani aksi update setelah form edit disubmit
else if (!empty($_GET['action']) && $_GET['action'] == 'update') {
  // Cek apakah form di-submit
  if (isset($_POST['edit'])) {
    // Ambil data dari form
    $data = [
      'id'             => intval($_POST['id']),
      'judul'          => htmlspecialchars($_POST['judul']),
      'pengarang'      => htmlspecialchars($_POST['pengarang']),
      'penerbit'       => htmlspecialchars($_POST['penerbit']),
      'tahun_terbit'   => intval($_POST['tahun_terbit']),
      'jumlah_halaman' => intval($_POST['jumlah_halaman']),
      'stok'           => intval($_POST['stok'])
    ];

    // Kirim ke controller untuk di-update
    $buku->update($data);

    // Setelah berhasil update, arahkan kembali ke buku.php
    header("location: buku.php");
    exit();
}
}
// Menampilkan daftar buku
else {
  $buku->index(); // menampilkan daftar semua buku
}

?>