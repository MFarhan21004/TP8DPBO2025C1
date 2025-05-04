<?php
include_once("Views/Template.class.php");
include_once("Controllers/Mahasiswa.controller.php");
include_once("Models/DB.php");

$mahasiswa = new MahasiswaController();

// Menangani aksi tambah
if (isset($_POST['add'])) {
  // Ambil data dari form dengan validasi sederhana
  $data = [
    'nim'      => htmlspecialchars($_POST['nim']),
    'nama'     => htmlspecialchars($_POST['nama']),
    'jurusan'  => htmlspecialchars($_POST['jurusan']),
    'angkatan' => intval($_POST['angkatan']),
    'email'    => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
    'alamat'   => htmlspecialchars($_POST['alamat']),
    'telepon'  => htmlspecialchars($_POST['telepon'])
  ];

  $mahasiswa->Add($data);

  // Redirect setelah penambahan
  header("Location: mahasiswa.php");
  exit();
}

// Menangani aksi hapus
else if (isset($_GET['action']) && $_GET['action'] == 'delete' && !empty($_GET['id'])) {
  $id = intval($_GET['id']);    // Pastikan ID berupa angka
  $mahasiswa->delete($id);      // Panggil method delete dari controller
  header("Location: mahasiswa.php");
  exit();
}

// Menangani aksi edit untuk mendapatkan data berdasarkan ID
else if (!empty($_GET['id'])) {
  // Ambil data untuk form edit
  $id = intval($_GET['id']);
  $mahasiswa->edit($id); // ini akan menampilkan form edit dengan data yang dipilih
}

// Menangani aksi update setelah form edit disubmit
else if (!empty($_GET['action']) && $_GET['action'] == 'update') {
  // Cek apakah form di-submit
  if (isset($_POST['edit'])) {
    // Ambil data dari form
    $data = [
      'id'       => intval($_POST['id']),
      'nim'      => htmlspecialchars($_POST['nim']),
      'nama'     => htmlspecialchars($_POST['nama']),
      'jurusan'  => htmlspecialchars($_POST['jurusan']),
      'angkatan' => intval($_POST['angkatan']),
      'email'    => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
      'alamat'   => htmlspecialchars($_POST['alamat']),
      'telepon'  => htmlspecialchars($_POST['telepon'])
    ];

    // Kirim ke controller untuk di-update
    $mahasiswa->update($data);

    // Setelah berhasil update, arahkan kembali ke mahasiswa.php
    header("location: mahasiswa.php");
    exit();
}
}
// Menampilkan daftar mahasiswa
else {
  $mahasiswa->index(); // menampilkan daftar semua mahasiswa
}

?>