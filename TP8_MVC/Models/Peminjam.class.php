<?php
include_once("DB.php"); 

// Models/Peminjam.php
class Peminjam extends DB 
{
    // Mengambil semua data peminjaman dengan nama mahasiswa dan judul buku
    function getPeminjam()
    {
        $query = "SELECT p.*, m.nama as nama_mahasiswa, m.nim, b.judul as judul_buku 
                  FROM peminjam p
                  JOIN mahasiswa m ON p.mahasiswa_id = m.id
                  JOIN buku b ON p.buku_id = b.id
                  ORDER BY p.tanggal_pinjam ASC";
        return $this->execute($query);
    }

    // Mengambil data peminjaman berdasarkan ID
    function getPeminjamById($id)
    {
        $query = "SELECT p.*, m.nama as nama_mahasiswa, m.nim, b.judul as judul_buku 
                  FROM peminjam p
                  JOIN mahasiswa m ON p.mahasiswa_id = m.id
                  JOIN buku b ON p.buku_id = b.id
                  WHERE p.id = '$id'";
        return $this->execute($query);
    }

    // Menambah data peminjaman baru
    function addPeminjam($data)
    {
        $mahasiswa_id = $data['mahasiswa_id'];
        $buku_id = $data['buku_id'];
        $tanggal_pinjam = $data['tanggal_pinjam'];
        $tanggal_kembali = $data['tanggal_kembali'];
        $status = $data['status'];

        // Query untuk memasukkan data peminjaman
        $query = "INSERT INTO peminjam (mahasiswa_id, buku_id, tanggal_pinjam, tanggal_kembali, status) 
                  VALUES ('$mahasiswa_id', '$buku_id', '$tanggal_pinjam', '$tanggal_kembali', '$status')";
        
        // Eksekusi query
        return $this->execute($query);
    }

    // Fungsi updatePeminjam di Model
    function updatePeminjam($data)
    {
        // Ambil data dari array
        $id = $data['id'];
        $mahasiswa_id = $data['mahasiswa_id'];
        $buku_id = $data['buku_id'];
        $tanggal_pinjam = $data['tanggal_pinjam'];
        $tanggal_kembali = $data['tanggal_kembali'];
        $status = $data['status'];

        // Query untuk mengupdate data peminjaman
        $query = "UPDATE peminjam 
                  SET mahasiswa_id = '$mahasiswa_id', buku_id = '$buku_id', 
                      tanggal_pinjam = '$tanggal_pinjam', tanggal_kembali = '$tanggal_kembali', status = '$status' 
                  WHERE id = '$id'";

        // Eksekusi query dan return hasil
        return $this->execute($query);
    }

    // Menghapus data peminjaman
    function deletePeminjam($id)
    {
        $query = "DELETE FROM peminjam WHERE id = '$id'";
        return $this->execute($query);
    }
}

?>
